<?php

namespace App\Tests\Repository;

use App\DataFixtures\AppFixtures;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class TaskRepositoryTest extends KernelTestCase 
{
    use FixturesTrait;
    
     public function setUp(): void
     {
         parent::setUp();
 
         self::bootKernel();
 
     }

    public function testCount() {
        $this->loadFixtures([AppFixtures::class]);
        $tasks = self::getContainer()->get(TaskRepository::class)->count([]);
        $this->assertEquals(20, $tasks);
        $tasksDone = self::getContainer()->get(TaskRepository::class)->findByIsDone(true);
        $this->assertEquals(0, count($tasksDone));
    }

}