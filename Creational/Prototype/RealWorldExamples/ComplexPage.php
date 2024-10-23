<?php

/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Prototype
|--------------------------------------------------------------------------
| Implement Prototype Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Prototype\RealWorldExamples;

/**
 * Prototype.
 */
class Page
{
    private $title;

    private $body;

    /**
     * @var Author
     */
    private $author;

    private $comments = [];

    /**
     * @var \DateTime
     */
    private $date;

    // +100 private fields.

    public function __construct(string $title, string $body, Author $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->author->addToPage($this);
        $this->date = new \DateTime();
    }

    public function addComment(string $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * You can control what data you want to carry over to the cloned object.
     *
     * For instance, when a page is cloned:
     * - It gets a new "Copy of ..." title.
     * - The author of the page remains the same. Therefore we leave the
     * reference to the existing object while adding the cloned page to the list
     * of the author's pages.
     * - We don't carry over the comments from the old page.
     * - We also attach a new date object to the page.
     */
    public function __clone()
    {
        $this->title = "Copy of " . $this->title;
        $this->author->addToPage($this);
        $this->comments = [];
        $this->date = new \DateTime();
    }
}

class Author
{
    private $name;

    /**
     * @var Page[]
     */
    private $pages = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addToPage(Page $page): void
    {
        $this->pages[] = $page;
    }
}

/**
 * The client code.
 */
function clientCode()
{
    $author = new Author("John Smith");
    $page = new Page("Tip of the day", "Keep calm and carry on.", $author);

    // ...

    $page->addComment("Nice tip, thanks!");

    // ...

    $draft = clone $page;
    echo "Dump of the clone. Note that the author is now referencing two objects.\n\n";
    print_r($draft);
}

clientCode();
