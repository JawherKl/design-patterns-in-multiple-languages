<?php

/*
|--------------------------------------------------------------------------
| Facade Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Facade Design Pattern, which provides a 
| simplified interface to a complex subsystem, shielding clients from 
| the subsystem's complexity and helping to organize and manage the 
| interaction with multiple subsystems.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Structural/Facade
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Facade Class**: Provides a simple interface for interacting with 
|    multiple subsystems. The facade delegates requests from the client 
|    to the appropriate subsystem objects and simplifies their interaction.
|
| 2. **Subsystem Classes**: Represent the complex components that perform 
|    specific tasks. They contain detailed logic that is abstracted by the 
|    facade to make client interactions easier.
|
| 3. **Client Code**: Interacts only with the Facade, not with individual 
|    subsystems. This keeps the client code clean and simple while still 
|    allowing access to complex functionality through the facade.
|
| Benefits:
| - **Simplification**: Provides a high-level interface that hides the 
|   complexity of the subsystems.
| - **Loose Coupling**: The client is decoupled from the subsystems, only 
|   interacting with the Facade.
| - **Centralized Control**: The Facade centralizes and manages the 
|   interaction between subsystems, making the system easier to maintain.
|
| Drawbacks:
| - **Limited Flexibility**: The Facade can only expose the functionality 
|   that is defined in the facade methods. If more detailed control is needed 
|   over the subsystems, the client would need to interact with them directly.
*/

namespace Structural\Facade;

/**
 * The Facade class provides a simple interface to the complex logic of one or
 * several subsystems. The Facade delegates the client requests to the
 * appropriate objects within the subsystem. The Facade is also responsible for
 * managing their lifecycle. All of this shields the client from the undesired
 * complexity of the subsystem.
 */
class Facade
{
    protected $subsystem1;

    protected $subsystem2;

    /**
     * Depending on your application's needs, you can provide the Facade with
     * existing subsystem objects or force the Facade to create them on its own.
     */
    public function __construct(
        Subsystem1 $subsystem1 = null,
        Subsystem2 $subsystem2 = null
    ) {
        $this->subsystem1 = $subsystem1 ?: new Subsystem1();
        $this->subsystem2 = $subsystem2 ?: new Subsystem2();
    }

    /**
     * The Facade's methods are convenient shortcuts to the sophisticated
     * functionality of the subsystems. However, clients get only to a fraction
     * of a subsystem's capabilities.
     */
    public function operation(): string
    {
        $result = "Facade initializes subsystems:\n";
        $result .= $this->subsystem1->operation1();
        $result .= $this->subsystem2->operation1();
        $result .= "Facade orders subsystems to perform the action:\n";
        $result .= $this->subsystem1->operationN();
        $result .= $this->subsystem2->operationZ();

        return $result;
    }
}

/**
 * The Subsystem can accept requests either from the facade or client directly.
 * In any case, to the Subsystem, the Facade is yet another client, and it's not
 * a part of the Subsystem.
 */
class Subsystem1
{
    public function operation1(): string
    {
        return "Subsystem1: Ready!\n";
    }

    // ...

    public function operationN(): string
    {
        return "Subsystem1: Go!\n";
    }
}

/**
 * Some facades can work with multiple subsystems at the same time.
 */
class Subsystem2
{
    public function operation1(): string
    {
        return "Subsystem2: Get ready!\n";
    }

    // ...

    public function operationZ(): string
    {
        return "Subsystem2: Fire!\n";
    }
}

/**
 * The client code works with complex subsystems through a simple interface
 * provided by the Facade. When a facade manages the lifecycle of the subsystem,
 * the client might not even know about the existence of the subsystem. This
 * approach lets you keep the complexity under control.
 */
function clientCode(Facade $facade)
{
    // ...

    echo $facade->operation();

    // ...
}

/**
 * The client code may have some of the subsystem's objects already created. In
 * this case, it might be worthwhile to initialize the Facade with these objects
 * instead of letting the Facade create new instances.
 */
$subsystem1 = new Subsystem1();
$subsystem2 = new Subsystem2();
$facade = new Facade($subsystem1, $subsystem2);
clientCode($facade);