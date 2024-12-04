<?php

namespace patterns\Behavioral\Iterator\PHP\RealWorldExample;

/**
 * User Iterator for iterating over a collection of users.
 */
class UserIterator implements \Iterator
{
    protected $users = [];
    protected $currentIndex = 0;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function current(): mixed
    {
        return $this->users[$this->currentIndex];
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
        return isset($this->users[$this->currentIndex]);
    }
}

/**
 * The client code.
 */
$users = [
    ['id' => 1, 'name' => 'John Doe'],
    ['id' => 2, 'name' => 'Jane Smith'],
    ['id' => 3, 'name' => 'Emily Johnson']
];

$userIterator = new UserIterator($users);

foreach ($userIterator as $index => $user) {
    echo "User {$index}: ID: {$user['id']}, Name: {$user['name']}\n";
}
