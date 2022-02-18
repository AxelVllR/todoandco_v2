<?php

namespace App\Tests\Unit\Controller;

use App\Entity\User;
use App\Tests\LogUtils;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @covers \App\Controller\DefaultController
 * @covers \App\Controller\UserController
 * @covers \App\Entity\User
 */
class UserControllerTest extends WebTestCase
{
	private $client;
	private $logUtils;
	private $entityManager;

	public function setUp(): void
	{
		$this->client = static::createClient();
		$this->logUtils = new LogUtils($this->client);

		$this->entityManager = $this->client->getContainer()
			->get('doctrine')
			->getManager();
	}

	/**
	 * Test access list user
	 * 
	 * @return void
	 */
	public function testAccessListUser()
	{
		// access with user account
		$user = $this->logUtils->getUser('test@gmail.com', 'test');
        $this->client->loginUser($user);
		$this->client->request('GET', "/users");

		$this->assertEquals('403', $this->client->getResponse()->getStatusCode());
		//$crawler = $this->client->followRedirect();

		//$this->assertStringContainsString("Vous ne pouvez pas accéder à cette partie du site", $crawler->text());

		// access with admin account
		$user = $this->logUtils->getUser('testadmin@gmail.com', 'test');
        $this->client->loginUser($user);
		$crawler = $this->client->request('GET', "/users");

		$this->assertEquals('200', $this->client->getResponse()->getStatusCode());

		$this->assertStringContainsString("Liste des utilisateurs", $crawler->text());
	}

	/**
	 * Test create user
	 * 
	 * @return void
	 */
	public function testCreateUser()
	{
		$user = $this->logUtils->getUser('testadmin@gmail.com', 'test');
        $this->client->loginUser($user);

		$username = 'Test create user';
		$password = "Test";
		$email = 'test-create-user@test.fr';

		$crawler = $this->client->request('GET', "/users/create");
		$this->assertStringContainsString("Roles", $crawler->text());

		$crawler = $this->client->request('POST', "/users/create", [
			'user' => [
				'username' => $username,
				'password' => [
					'first' => $password,
					'second' => $password
				],
				'email' => $email,
				'roles' => ['ROLE_USER'],
			]
		]);

		// check if task is created
		$this->assertEquals(302, $this->client->getResponse()->getStatusCode());

		// check in db
		$userCreated = $this->entityManager
			->getRepository(User::class)
			->findOneBy(['username' => $username]);

		$this->assertNotEquals(null, $userCreated);
	}

	/**
	 * Test update user
	 * 
	 * @return void
	 */
	public function testUpdateUser()
	{
		$user = $this->logUtils->getUser('testadmin@gmail.com', 'test');
        $this->client->loginUser($user);

		$allUsers = $this->entityManager
			->getRepository(User::class)
			->findAll();

		$users = [];

		foreach ($allUsers as $user) {
			if ($user->getUsername() !== "test" && $user->getUsername() !== "testAdmin") {
				array_push($users, $user);
			}
		}

		$randomNumber = random_int(0, count($users) - 1);
		$user = $users[$randomNumber];
		$urlUpdateUser = '/users/' . $user->getId() . '/edit';

		$crawler = $this->client->request('GET', $urlUpdateUser);

		$username = $crawler->filter('input[name="user[username]"]')->extract(array('value'))[0];
		$email = $crawler->filter('input[name="user[email]"]')->extract(array('value'))[0];
		$role = $crawler->filter('select[name="user[roles][]"] option[selected]')->extract(array('value'))[0];
		$crawler = $this->client->request('POST', $urlUpdateUser, [
			'user' => [
				'username' => $username . ' update', // update username
				'password' => [
					'first' => $username,
					'second' => $username
				],
				'email' => $email,
				'roles' => [$role],
			]
		]);

		// check if task is updated
		$this->assertEquals(302, $this->client->getResponse()->getStatusCode());

		$crawler = $this->client->followRedirect();

		$this->assertStringContainsString("L'utilisateur a bien été modifié", $crawler->text());
	}
}