<?php

namespace App\tests\Entity;

use App\Entity\Task;
use PHPUnit\Framework\TestCase;




class TaskTest extends TestCase{

    public function testTask () {

        $task = new Task(); 

        $task->setTitle('name');
        $task->setContent('content');

        $this->assertEquals("name", $task->getTitle());
        $this->assertEquals("content", $task->getContent());

    }

    public function testCreatedAt() {

        $task = new Task();
        $this->assertTrue($task->getCreatedAt() instanceof \DateTimeImmutable);

    }





}