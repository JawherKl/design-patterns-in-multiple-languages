<?php

namespace patterns\Behavioral\Command\PHP\RealWorldExample;

/**
 * Command Interface
 */
interface Command
{
    public function execute(): void;
    public function getId(): int;
    public function getStatus(): int;
}

/**
 * Abstract Command Class
 */
abstract class DocumentCommand implements Command
{
    public $id;
    public $status = 0;
    public $document;

    public function __construct(string $document)
    {
        $this->document = $document;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function execute(): void
    {
        $this->process();
        $this->complete();
    }

    abstract public function process(): void;

    public function complete(): void
    {
        $this->status = 1;
        Queue::get()->completeCommand($this);
    }
}

/**
 * Print Document Command
 */
class PrintDocumentCommand extends DocumentCommand
{
    public function process(): void
    {
        echo "PrintDocumentCommand: Printing document '{$this->document}'.\n";
    }
}

/**
 * Save Document Command
 */
class SaveDocumentCommand extends DocumentCommand
{
    public function process(): void
    {
        echo "SaveDocumentCommand: Saving document '{$this->document}'.\n";
    }
}

/**
 * Convert Document Command
 */
class ConvertDocumentCommand extends DocumentCommand
{
    public function process(): void
    {
        echo "ConvertDocumentCommand: Converting document '{$this->document}'.\n";
    }
}

/**
 * Queue to manage commands
 */
class Queue
{
    private $db;

    public function __construct()
    {
        $this->db = new \SQLite3(__DIR__ . '/commands.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $this->db->query('CREATE TABLE IF NOT EXISTS "commands" (
            "id" INTEGER PRIMARY KEY NOT NULL,
            "command" TEXT,
            "status" INTEGER
        )');
    }

    public function isEmpty(): bool
    {
        $query = 'SELECT COUNT("id") FROM "commands" WHERE status = 0';
        return $this->db->querySingle($query) === 0;
    }

    public function add(Command $command): void
    {
        $query = 'INSERT INTO commands (command, status) VALUES (:command, :status)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':command', base64_encode(serialize($command)));
        $statement->bindValue(':status', $command->getStatus());
        $statement->execute();
    }

    public function getCommand(): Command
    {
        $query = 'SELECT * FROM "commands" WHERE "status" = 0 LIMIT 1';
        $record = $this->db->querySingle($query, true);
        
        if ($record === false) {
            return null; // Handle no results
        }

        $command = unserialize(base64_decode($record["command"]));
        $command->id = $record['id'];

        return $command;
    }

    public function completeCommand(Command $command): void
    {
        $query = 'UPDATE commands SET status = :status WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':status', $command->getStatus());
        $statement->bindValue(':id', $command->getId());
        $statement->execute();
    }

    public function work(): void
    {
        while (!$this->isEmpty()) {
            $command = $this->getCommand();
            if ($command === null) {
                break;
            }
            $command->execute();
        }
    }

    public static function get(): Queue
    {
        static $instance;
        if (!$instance) {
            $instance = new Queue();
        }
        return $instance;
    }
}

// Client Code
$queue = Queue::get();

// Adding commands to the queue
if ($queue->isEmpty()) {
    $queue->add(new PrintDocumentCommand("Document1.pdf"));
    $queue->add(new SaveDocumentCommand("Document1.pdf"));
    $queue->add(new ConvertDocumentCommand("Document1.pdf"));
}

// Processing the commands in the queue
$queue->work();
