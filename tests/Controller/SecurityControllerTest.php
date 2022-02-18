<?php

namespace App\Tests\Unit\Controller;

use App\Tests\LogUtils;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @covers \App\Controller\DefaultController
 * @covers \App\Controller\SecurityController
 * @covers \App\Controller\UserController
 * @covers \App\Controller\TaskController
 * @covers \App\Entity\User
 * @covers \App\Entity\Task
 */
class SecurityControllerTest extends WebTestCase
{
	private $client;
	private $logUtils;

	public function setUp(): void
	{
		$this->client = static::createClient();
		$this->logUtils = new LogUtils($this->client);
	}

	/**
	 * Test access route when unauthenticated
	 * 
	 * @return void
	 */
	public function testAccessRouteWhenUnauthenticated()
	{
		$this->client->request('GET', "/tasks");
		$this->assertEquals('302', $this->client->getResponse()->getStatusCode());
	}

	/**
	 * Test access route when authenticated with admin role
	 * 
	 * @return void
	 */
	public function testAccessRouteWhenAuthenticatedWithAdminRole()
	{
		$admin = $this->logUtils->getUser('testadmin@gmail.com', 'test');
        $this->client->loginUser($admin);
		$this->client->request('GET', "/tasks");
		$this->assertEquals('200', $this->client->getResponse()->getStatusCode());
	}

	/**
	 * Test access route when authenticated with user role
	 * 
	 * @return void
	 */
	public function testAccessRouteWhenAuthenticatedWithUserRole()
	{
		$user = $this->logUtils->getUser('test@gmail.com', 'test');
        $this->client->loginUser($user);
		$this->client->request('GET', "/tasks");
		$this->assertEquals('200', $this->client->getResponse()->getStatusCode());
	}

	/**
	 * Test create user
	 * 
	 * @return void
	 */
	public function testRegistration()
	{
		$username = 'User_register';
		$password = "Test";
		$email = 'test-registered-user@test.fr';
		$crawler = $this->client->request('GET', "/register");

		$crawler = $this->client->request('POST', "/register", [
			'user' => [
				'username' => $username,
				'password' => [
					'first' => $password,
					'second' => $password
				],
				'email' => $email
			]
		]);

		// check if task is created
		$this->assertEquals(302, $this->client->getResponse()->getStatusCode());
	}


	/**
	 * Test wrong credentials when login
	 * 
	 * @return void
	 */
	public function testWrongCredientialsWhenLogin()
	{
		$crawler = $this->client->request('GET', "/login");
        $csrf = $crawler->filter('input[name="_csrf_token"]')->attr('value');
        $this->client->request('POST', "/login", [
            'email' => "testet@eded.ed",
            'password' => 'ettete',
            '_csrf_token' => $csrf
		]);
		$crawler = $this->client->followRedirect();
		$this->assertStringContainsString('Invalid credentials.', $crawler->text());
	}

	/**
	 * Test login with correct params (eq. admin)
	 * 
	 * @return void
	 */
	public function testLoginWithCorrectParams()
	{
		$crawler = $this->client->request('GET', "/login");
        $csrf = $crawler->filter('input[name="_csrf_token"]')->attr('value');
        $this->client->request('POST', "/login", [
            'email' => "test@gmail.com",
            'password' => 'test',
            '_csrf_token' => $csrf
		]);
		$crawler = $this->client->followRedirect();
		$this->assertStringContainsString('Créer une nouvelle tâche', $crawler->text());
	}


	public function testAccessLoginOnLogged() {
		$user = $this->logUtils->getUser('test@gmail.com', 'test');
        $this->client->loginUser($user);
		$crawler = $this->client->request('GET', "/login");
		$this->assertEquals('302', $this->client->getResponse()->getStatusCode());
	}

	/**
	 * Test access user management with user role
	 * 
	 * @return void
	 */
	public function testAccessUserManagementWithUserRole()
	{
		$user = $this->logUtils->getUser('test@gmail.com', 'test');
        $this->client->loginUser($user);
		$this->client->request('GET', "/users");
		$this->assertEquals('403', $this->client->getResponse()->getStatusCode());
	}

	/**
	 * Test access user management with admin role
	 * 
	 * @return void
	 */
	public function testAccessUserManagementWithAdminRole()
	{
		$admin = $this->logUtils->getUser('testadmin@gmail.com', 'test');
        $this->client->loginUser($admin);
		$this->client->request('GET', "/users");
		$this->assertEquals('200', $this->client->getResponse()->getStatusCode());
	}

	/**
	 * Test logout
	 * 
	 * @return void
	 */
	public function testLogout()
	{
		$admin = $this->logUtils->getUser('testadmin@gmail.com', 'test');
        $this->client->loginUser($admin);
		$this->client->request('GET', "/logout");
		$this->client->request('GET', "/tasks");
		$this->assertEquals('302', $this->client->getResponse()->getStatusCode());
	}
}