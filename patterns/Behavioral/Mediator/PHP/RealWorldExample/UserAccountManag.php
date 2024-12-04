<?php

namespace patterns\Behavioral\Mediator\PHP\RealWorldExample;

/**
 * The Event Dispatcher class acts as a Mediator and handles the subscription
 * and notification logic. It provides methods to attach, detach, and trigger events.
 */
class EventDispatcher
{
    private $observers = [];

    public function __construct()
    {
        // Special event group for observers that want to listen to all events.
        $this->observers["*"] = [];
    }

    private function initEventGroup(string &$event = "*"): void
    {
        if (!isset($this->observers[$event])) {
            $this->observers[$event] = [];
        }
    }

    private function getEventObservers(string $event = "*"): array
    {
        $this->initEventGroup($event);
        $group = $this->observers[$event];
        $all = $this->observers["*"];

        return array_merge($group, $all);
    }

    public function attach(Observer $observer, string $event = "*"): void
    {
        $this->initEventGroup($event);
        $this->observers[$event][] = $observer;
    }

    public function detach(Observer $observer, string $event = "*"): void
    {
        foreach ($this->getEventObservers($event) as $key => $s) {
            if ($s === $observer) {
                unset($this->observers[$event][$key]);
            }
        }
    }

    public function trigger(string $event, object $emitter, $data = null): void
    {
        echo "EventDispatcher: Broadcasting the '$event' event.\n";
        foreach ($this->getEventObservers($event) as $observer) {
            $observer->update($event, $emitter, $data);
        }
    }
}

/**
 * A simple helper function to provide global access to the event dispatcher.
 */
function events(): EventDispatcher
{
    static $eventDispatcher;
    if (!$eventDispatcher) {
        $eventDispatcher = new EventDispatcher();
    }
    return $eventDispatcher;
}

/**
 * The Observer interface defines how components receive event notifications.
 */
interface Observer
{
    public function update(string $event, object $emitter, $data = null);
}

/**
 * The UserRepository class is a component that performs user-related operations.
 * It subscribes to specific events like user creation and deletion.
 */
class UserRepository implements Observer
{
    private $users = [];

    public function __construct()
    {
        events()->attach($this, "users:deleted");
    }

    public function update(string $event, object $emitter, $data = null): void
    {
        switch ($event) {
            case "users:deleted":
                $this->deleteUser($data, true);
                break;
        }
    }

    public function initialize(string $filename): void
    {
        echo "UserRepository: Loading user records from a file.\n";
        // Simulate file loading logic.
        events()->trigger("users:init", $this, $filename);
    }

    public function createUser(array $data, bool $silent = false): User
    {
        echo "UserRepository: Creating a user.\n";
        $user = new User();
        $user->update($data);

        $id = bin2hex(openssl_random_pseudo_bytes(16));
        $user->update(["id" => $id]);
        $this->users[$id] = $user;

        if (!$silent) {
            events()->trigger("users:created", $this, $user);
        }

        return $user;
    }

    public function updateUser(User $user, array $data, bool $silent = false): ?User
    {
        echo "UserRepository: Updating a user.\n";
        $id = $user->attributes["id"];
        if (!isset($this->users[$id])) {
            return null;
        }

        $user = $this->users[$id];
        $user->update($data);

        if (!$silent) {
            events()->trigger("users:updated", $this, $user);
        }

        return $user;
    }

    public function deleteUser(User $user, bool $silent = false): void
    {
        echo "UserRepository: Deleting a user.\n";
        $id = $user->attributes["id"];
        if (!isset($this->users[$id])) {
            return;
        }

        unset($this->users[$id]);

        if (!$silent) {
            events()->trigger("users:deleted", $this, $user);
        }
    }
}

/**
 * The User class represents a user with an ID and attributes.
 * It has methods for updating and deleting user records.
 */
class User
{
    public $attributes = [];

    public function update($data): void
    {
        $this->attributes = array_merge($this->attributes, $data);
    }

    public function delete(): void
    {
        echo "User: I can now delete myself without worrying about the repository.\n";
        events()->trigger("users:deleted", $this, $this);
    }
}

/**
 * Logger is a concrete component that logs all events it's subscribed to.
 */
class Logger implements Observer
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    public function update(string $event, object $emitter, $data = null): void
    {
        $entry = date("Y-m-d H:i:s") . ": '$event' with data '" . json_encode($data) . "'\n";
        file_put_contents($this->filename, $entry, FILE_APPEND);
        echo "Logger: I've written '$event' entry to the log.\n";
    }
}

/**
 * OnboardingNotification sends a notification to the admin when a new user is created.
 */
class OnboardingNotification implements Observer
{
    private $adminEmail;

    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function update(string $event, object $emitter, $data = null): void
    {
        echo "OnboardingNotification: The notification has been emailed!\n";
    }
}

/**
 * The client code.
 */
$repository = new UserRepository();
events()->attach($repository, "facebook:update");

$logger = new Logger(__DIR__ . "/log.txt");
events()->attach($logger, "*");

$onboarding = new OnboardingNotification("1@example.com");
events()->attach($onboarding, "users:created");

$repository->initialize(__DIR__ . "users.csv");

$user = $repository->createUser([
    "name" => "John Smith",
    "email" => "john99@example.com",
]);

$user->delete();
