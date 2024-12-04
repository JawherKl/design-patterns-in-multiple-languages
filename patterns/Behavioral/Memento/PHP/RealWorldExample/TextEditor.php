<?php

namespace patterns\Behavioral\Memento\PHP\RealWorldExample;

/**
 * The Memento class stores the state of the TextEditor at a particular point in time.
 */
class Memento
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

/**
 * The TextEditor class holds the state (content of the text) and can create and restore Mementos.
 */
class TextEditor
{
    private $content;

    public function __construct(string $content = "")
    {
        $this->content = $content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    // Create a Memento with the current content
    public function save(): Memento
    {
        echo "TextEditor: Saving current content to Memento.\n";
        return new Memento($this->content);
    }

    // Restore content from a Memento
    public function restore(Memento $memento): void
    {
        $this->content = $memento->getContent();
        echo "TextEditor: Restoring content from Memento: " . $this->content . "\n";
    }
}

/**
 * The History class acts as a caretaker for saving and retrieving Mementos.
 */
class History
{
    private $mementos = [];

    // Add a Memento to the history
    public function addMemento(Memento $memento): void
    {
        $this->mementos[] = $memento;
    }

    // Retrieve a Memento from the history
    public function getMemento(int $index): Memento
    {
        return $this->mementos[$index];
    }
}

// Client code
$editor = new TextEditor("Hello World!");
$history = new History();

// Save the current state of the editor
$history->addMemento($editor->save());

// Modify the text
$editor->setContent("Hello, PHP World!");

// Save the new state
$history->addMemento($editor->save());

// Modify the text again
$editor->setContent("Hello, Memento Pattern!");

// Print current content
echo "Current content: " . $editor->getContent() . "\n";

// Restore to the previous state (Hello, PHP World!)
$editor->restore($history->getMemento(1));

// Print the restored content
echo "Restored content: " . $editor->getContent() . "\n";

// Restore to the initial state (Hello World!)
$editor->restore($history->getMemento(0));

// Print the initial restored content
echo "Initial content: " . $editor->getContent() . "\n";

