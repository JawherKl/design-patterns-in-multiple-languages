<?php

/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Example
|--------------------------------------------------------------------------
| Implement the Prototype Design Pattern to create new instances by cloning 
| existing objects, which can avoid costly initialization steps.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype/RealWorldExamples
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Prototype\Example;

/**
 * Prototype Interface.
 * Defines the `__clone()` method that all prototypes must implement.
 */
interface Prototype
{
    public function __clone();
}

/**
 * Concrete Prototype: Document
 */
class Document implements Prototype
{
    private $title;

    private $content;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var Author
     */
    private $author;

    public function __construct(string $title, string $content, Author $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = new \DateTime();
        $this->author->addDocument($this);
    }

    /**
     * Control what data to copy when cloning.
     * Example:
     * - The cloned document will have "Copy of ..." title.
     * - The author reference remains the same.
     * - The creation date is updated to the current date.
     */
    public function __clone()
    {
        $this->title = "Copy of " . $this->title;
        $this->createdAt = new \DateTime();
        // Add the cloned document to the author's list of documents.
        $this->author->addDocument($this);
    }

    public function getDetails()
    {
        return [
            'Title' => $this->title,
            'Content' => $this->content,
            'Author' => $this->author->getName(),
            'CreatedAt' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }
}

/**
 * The Author class, which has a collection of documents.
 */
class Author
{
    private $name;

    /**
     * @var Document[]
     */
    private $documents = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addDocument(Document $document): void
    {
        $this->documents[] = $document;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }
}

/**
 * Client code that demonstrates the Prototype Design Pattern.
 */
function clientCode()
{
    // Create an author and a document.
    $author = new Author("Jane Doe");
    $originalDocument = new Document("Design Patterns", "Learning the Prototype Pattern.", $author);

    // Clone the original document.
    $clonedDocument = clone $originalDocument;

    // Display details of both documents.
    echo "Original Document:\n";
    print_r($originalDocument->getDetails());

    echo "\nCloned Document:\n";
    print_r($clonedDocument->getDetails());
}

clientCode();
