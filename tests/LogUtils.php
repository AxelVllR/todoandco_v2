<?php

namespace App\Tests;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;

class LogUtils
{
	private $client;

	public function __construct($client)
	{
		$this->client = $client;
	}

	public function getUser($email, $password)
	{
		$credentials = ['email' => $email, 'password' => $password];

		// get doctrine
		$entityManager = $this->client->getContainer()
			->get('doctrine')
			->getManager();

		// get a user from database
		$user = $entityManager
			->getRepository(User::class)
			->findOneBy([
				'email' => $credentials['email']
			]);

		return $user;
	}
}