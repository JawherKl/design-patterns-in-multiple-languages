<?php

namespace patterns\Behavioral\Memento\PHP\RealWorldExample;

/**
 * The Memento class stores the state of the GameCharacter at a particular point in time.
 */
class Memento
{
    private $health;
    private $level;
    private $position;

    public function __construct(int $health, int $level, string $position)
    {
        $this->health = $health;
        $this->level = $level;
        $this->position = $position;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}

/**
 * The GameCharacter class holds the state of the character and can create and restore Mementos.
 */
class GameCharacter
{
    private $health;
    private $level;
    private $position;

    public function __construct(int $health, int $level, string $position)
    {
        $this->health = $health;
        $this->level = $level;
        $this->position = $position;
    }

    public function setState(int $health, int $level, string $position): void
    {
        $this->health = $health;
        $this->level = $level;
        $this->position = $position;
    }

    public function getState(): string
    {
        return "Health: {$this->health}, Level: {$this->level}, Position: {$this->position}";
    }

    // Create a Memento to save the current state
    public function save(): Memento
    {
        echo "GameCharacter: Saving current state to Memento.\n";
        return new Memento($this->health, $this->level, $this->position);
    }

    // Restore state from a Memento
    public function restore(Memento $memento): void
    {
        $this->health = $memento->getHealth();
        $this->level = $memento->getLevel();
        $this->position = $memento->getPosition();
        echo "GameCharacter: Restoring state from Memento: " . $this->getState() . "\n";
    }
}

/**
 * The Caretaker class stores a history of Mementos.
 */
class Caretaker
{
    private $mementos = [];

    public function addMemento(Memento $memento): void
    {
        $this->mementos[] = $memento;
    }

    public function getMemento(int $index): Memento
    {
        return $this->mementos[$index];
    }
}

// Client code
$character = new GameCharacter(100, 1, "Town");

$caretaker = new Caretaker();

// Save the current state of the character
$caretaker->addMemento($character->save());

// Modify the character's state
$character->setState(80, 2, "Dungeon");

// Save the new state
$caretaker->addMemento($character->save());

// Modify the character's state again
$character->setState(50, 3, "Boss Room");

// Print current state
echo "Current state: " . $character->getState() . "\n";

// Restore to the previous state (Dungeon)
$character->restore($caretaker->getMemento(1));

// Print the restored state
echo "Restored state: " . $character->getState() . "\n";

// Restore to the initial state (Town)
$character->restore($caretaker->getMemento(0));

// Print the initial restored state
echo "Initial state: " . $character->getState() . "\n";

