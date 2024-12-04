<?php

/*
|--------------------------------------------------------------------------
| Bridge Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Bridge Design Pattern, which decouples an 
| abstraction from its implementation, allowing the two to vary independently.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Structural/Bridge
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Abstraction**: Defines the interface for the abstraction's control 
|    and maintains a reference to an object of the Implementation hierarchy.
|
| 2. **Extended Abstraction**: Adds more functionality without modifying 
|    the implementation classes.
|
| 3. **Implementation Interface**: Defines the interface for all implementation 
|    classes, typically providing primitive operations that are used by the 
|    abstraction.
|
| 4. **Concrete Implementations**: Provide platform-specific behavior by 
|    implementing the Implementation interface.
|
| 5. **Client Code**: Interacts with the abstraction and can work with any 
|    combination of abstraction and implementation.
|
| Benefits:
| - **Decoupling**: Separates abstraction from implementation, promoting loose 
|   coupling.
| - **Flexibility**: Enables new abstractions and implementations to be added 
|   independently.
| - **Scalability**: Supports different combinations of abstractions and 
|   implementations without changing the client code.
*/

namespace Structural\Bridge;

/**
 * The Abstraction defines the interface for the "control" part of the two class
 * hierarchies. It maintains a reference to an object of the Implementation
 * hierarchy and delegates all of the real work to this object.
 */
class Abstraction
{
    /**
     * @var Implementation
     */
    protected $implementation;

    public function __construct(Implementation $implementation)
    {
        $this->implementation = $implementation;
    }

    public function operation(): string
    {
        return "Abstraction: Base operation with:\n" .
            $this->implementation->operationImplementation();
    }
}

/**
 * You can extend the Abstraction without changing the Implementation classes.
 */
class ExtendedAbstraction extends Abstraction
{
    public function operation(): string
    {
        return "ExtendedAbstraction: Extended operation with:\n" .
            $this->implementation->operationImplementation();
    }
}

/**
 * The Implementation defines the interface for all implementation classes. It
 * doesn't have to match the Abstraction's interface. In fact, the two
 * interfaces can be entirely different. Typically the Implementation interface
 * provides only primitive operations, while the Abstraction defines higher-
 * level operations based on those primitives.
 */
interface Implementation
{
    public function operationImplementation(): string;
}

/**
 * Each Concrete Implementation corresponds to a specific platform and
 * implements the Implementation interface using that platform's API.
 */
class ConcreteImplementationA implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationA: Here's the result on the platform A.\n";
    }
}

class ConcreteImplementationB implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationB: Here's the result on the platform B.\n";
    }
}

/**
 * Except for the initialization phase, where an Abstraction object gets linked
 * with a specific Implementation object, the client code should only depend on
 * the Abstraction class. This way the client code can support any abstraction-
 * implementation combination.
 */
function clientCode(Abstraction $abstraction)
{
    // ...

    echo $abstraction->operation();

    // ...
}

/**
 * The client code should be able to work with any pre-configured abstraction-
 * implementation combination.
 */
$implementation = new ConcreteImplementationA();
$abstraction = new Abstraction($implementation);
clientCode($abstraction);

echo "\n";

$implementation = new ConcreteImplementationB();
$abstraction = new ExtendedAbstraction($implementation);
clientCode($abstraction);