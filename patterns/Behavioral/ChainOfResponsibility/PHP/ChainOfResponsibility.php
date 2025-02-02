<?php

/*
|--------------------------------------------------------------------------
| Chain of Responsibility Design Pattern - Chain of Responsibility
|--------------------------------------------------------------------------
| This example demonstrates the Chain of Responsibility Design Pattern, which
| allows passing a request along a chain of handlers, giving each handler a
| chance to process the request or pass it to the next handler in the chain.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Behavioral/ChainOfResponsibility
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Handler Interface**: Declares a method for setting the next handler in
|    the chain and a method for processing the request.
|
| 2. **AbstractHandler Class**: Provides default behavior for chaining and
|    passing the request along the chain.
|
| 3. **Concrete Handlers**: These classes implement the handling logic. Each
|    concrete handler either processes a specific request or passes it to the
|    next handler in the chain. In this case, we have handlers for the monkey,
|    squirrel, and dog.
|
| 4. **Client Code**: Sends a request to the first handler in the chain, and
|    each handler decides whether to handle it or pass it along to the next
|    handler.
|
| Benefits:
| - **Decoupling**: The client doesn't need to know which handler will
|   process the request, making it easier to add new handlers without
|   affecting the client.
| - **Flexible Handling**: Multiple handlers can be added or removed without
|   changing the client code.
| - **Improved Maintainability**: Each handler can focus on a single task,
|   making the system easier to maintain.
|
| Drawbacks:
| - **Performance**: In chains with many handlers, it could take longer to
|   find the appropriate handler for a request.
| - **Complexity**: Managing long chains or subchains can introduce
|   complexity if not carefully structured.
|
| When to Use:
| - When you need to pass a request to multiple handlers, but you're unsure
|   which one will be able to handle it.
| - When you want to avoid coupling between the sender of the request and
|   the receivers.
| - When you want to add or remove handlers dynamically without modifying the
|   client code.
|
| Example Use Cases:
| - Event handling in user interfaces, where different handlers process
|   events based on type or source.
| - Request processing pipelines, such as HTTP request handling in web
|   servers.
| - Workflow systems, where tasks are passed along a chain of steps.
*/

namespace patterns\Behavioral\ChainOfResponsibility\PHP;

/**
 * The Handler interface declares a method for building the chain of handlers.
 * It also declares a method for executing a request.
 */
interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $request): ?string;
}

/**
 * The default chaining behavior can be implemented inside a base handler class.
 */
abstract class AbstractHandler implements Handler
{
    /**
     * @var Handler
     */
    private $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        // Returning a handler from here will let us link handlers in a
        // convenient way like this:
        // $monkey->setNext($squirrel)->setNext($dog);
        return $handler;
    }

    public function handle(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}

/**
 * All Concrete Handlers either handle a request or pass it to the next handler
 * in the chain.
 */
class MonkeyHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "Banana") {
            return "Monkey: I'll eat the " . $request . ".\n";
        } else {
            return parent::handle($request);
        }
    }
}

class SquirrelHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "Nut") {
            return "Squirrel: I'll eat the " . $request . ".\n";
        } else {
            return parent::handle($request);
        }
    }
}

class DogHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "MeatBall") {
            return "Dog: I'll eat the " . $request . ".\n";
        } else {
            return parent::handle($request);
        }
    }
}

/**
 * The client code is usually suited to work with a single handler. In most
 * cases, it is not even aware that the handler is part of a chain.
 */
function clientCode(Handler $handler)
{
    foreach (["Nut", "Banana", "Cup of coffee"] as $food) {
        echo "Client: Who wants a " . $food . "?\n";
        $result = $handler->handle($food);
        if ($result) {
            echo "  " . $result;
        } else {
            echo "  " . $food . " was left untouched.\n";
        }
    }
}

/**
 * The other part of the client code constructs the actual chain.
 */
$monkey = new MonkeyHandler();
$squirrel = new SquirrelHandler();
$dog = new DogHandler();

$monkey->setNext($squirrel)->setNext($dog);

/**
 * The client should be able to send a request to any handler, not just the
 * first one in the chain.
 */
echo "Chain: Monkey > Squirrel > Dog\n\n";
clientCode($monkey);
echo "\n";

echo "Subchain: Squirrel > Dog\n\n";
clientCode($squirrel);
