<?php

namespace patterns\Behavioral\Iterator\PHP\RealWorldExample;

/**
 * Book Iterator for iterating over a collection of books.
 */
class BookIterator implements \Iterator
{
    protected $books = [];
    protected $currentIndex = 0;

    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function current(): mixed
    {
        return $this->books[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next(): void
    {
        ++$this->currentIndex;
    }

    public function valid(): bool
    {
        return isset($this->books[$this->currentIndex]);
    }
}

/**
 * The client code.
 */
$books = [
    'The Catcher in the Rye',
    'To Kill a Mockingbird',
    '1984',
    'Pride and Prejudice'
];

$bookIterator = new BookIterator($books);

foreach ($bookIterator as $index => $book) {
    echo "Book {$index}: {$book}\n";
}
