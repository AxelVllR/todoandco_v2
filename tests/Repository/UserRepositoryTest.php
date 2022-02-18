<?php

namespace App\Tests\Repository;

use App\DataFixtures\AppFixtures;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class UserRepositoryTest extends KernelTestCase 
{
    use FixturesTrait;
    
     public function setUp(): void
     {
         parent::setUp();
 
         self::bootKernel();
 
     }

    public function testCount() {
        $this->loadFixtures([AppFixtures::class]);
        $users = self::getContainer()->get(UserRepository::class)->count([]);
        $this->assertEquals(2, $users);
    }

}