<?php

use PHPUnit\Framework\TestCase;
use Lenovo\TestUnitaire\TaskManager;

class TaskManagerTest extends TestCase
{
    private TaskManager $taskManager;

    protected function setUp(): void
    {
        $this->taskManager = new TaskManager();
    }

    public function testAddTask()
    {
        $this->taskManager->addTask("Reviser les tests unitaires");
        $this->assertCount(1, $this->taskManager->getTasks());
    }
    public function testRemoveTask()
    {
        $this->taskManager->addTask("1ere tache");
        $this->taskManager->addTask("2eme tache");

        $this->taskManager->removeTask(0);

        $this->assertCount(1, $this->taskManager->getTasks());
        $this->assertSame("2eme tache", $this->taskManager->getTask(0));
    }
    public function testGetTasks()
    {
        $this->taskManager->addTask("1ere tache");
        $this->taskManager->addTask("2eme tache");

        $this->assertSame(["1ere tache", "2eme tache"], $this->taskManager->getTasks());
    }
    public function testGetTask()
    {
        $this->taskManager->addTask("Reviser PHP");
        $this->assertSame("Reviser PHP", $this->taskManager->getTask(0));
    }
    public function testRemoveInvalidIndexThrowsException()
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 0");

        $this->taskManager->removeTask(0);
    }
    public function testGetInvalidIndexThrowsException()
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 1");

        $this->taskManager->getTask(1);
    }
    public function testTaskOrderAfterRemoval()
    {
        $this->taskManager->addTask("Tache 1");
        $this->taskManager->addTask("Tache 2");
        $this->taskManager->addTask("Tache 3");

        $this->taskManager->removeTask(1); 

        $this->assertSame(["Tache 1", "Tache 3"], $this->taskManager->getTasks());
    }
    






}