<?php

/*
|--------------------------------------------------------------------------
| Decorator Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Decorator Design Pattern, which allows 
| behavior to be added to an individual object, without affecting the 
| behavior of other objects from the same class.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Structural/Decorator
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Component Interface**: Defines the common interface for both simple 
|    components and decorators, ensuring that they can be used interchangeably.
|
| 2. **ConcreteComponent**: Implements the `Component` interface and provides 
|    the default behavior for the operation.
|
| 3. **Decorator Class**: Implements the `Component` interface and wraps a 
|    `Component` object. It delegates the work to the wrapped component while 
|    allowing additional behavior to be added.
|
| 4. **ConcreteDecorators**: Extend the `Decorator` class and add additional 
|    functionality or modify the behavior of the wrapped component.
|
| 5. **Client Code**: Interacts with the `Component` interface, allowing 
|    the client to work with simple components or decorated components without 
|    being aware of the specific implementation.
|
| Benefits:
| - **Extensibility**: New functionality can be added to an object without 
|   changing its class.
| - **Flexibility**: Multiple decorators can be combined to compose new behaviors.
| - **Separation of Concerns**: The decoration logic is isolated in separate 
|   decorator classes, keeping the original component simple and focused.
*/

namespace Structural\Decorator;

/**
 * The base Component interface defines operations that can be altered by
 * decorators.
 */
interface Component
{
    public function operation(): string;
}

/**
 * Concrete Components provide default implementations of the operations. There
 * might be several variations of these classes.
 */
class ConcreteComponent implements Component
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}

/**
 * The base Decorator class follows the same interface as the other components.
 * The primary purpose of this class is to define the wrapping interface for all
 * concrete decorators. The default implementation of the wrapping code might
 * include a field for storing a wrapped component and the means to initialize
 * it.
 */
class Decorator implements Component
{
    /**
     * @var Component
     */
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * The Decorator delegates all work to the wrapped component.
     */
    public function operation(): string
    {
        return $this->component->operation();
    }
}

/**
 * Concrete Decorators call the wrapped object and alter its result in some way.
 */
class ConcreteDecoratorA extends Decorator
{
    /**
     * Decorators may call parent implementation of the operation, instead of
     * calling the wrapped object directly. This approach simplifies extension
     * of decorator classes.
     */
    public function operation(): string
    {
        return "ConcreteDecoratorA(" . parent::operation() . ")";
    }
}

/**
 * Decorators can execute their behavior either before or after the call to a
 * wrapped object.
 */
class ConcreteDecoratorB extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorB(" . parent::operation() . ")";
    }
}

/**
 * The client code works with all objects using the Component interface. This
 * way it can stay independent of the concrete classes of components it works
 * with.
 */
function clientCode(Component $component)
{
    // ...

    echo "RESULT: " . $component->operation();

    // ...
}

/**
 * This way the client code can support both simple components...
 */
$simple = new ConcreteComponent();
echo "Client: I've got a simple component:\n";
clientCode($simple);
echo "\n\n";

/**
 * ...as well as decorated ones.
 *
 * Note how decorators can wrap not only simple components but the other
 * decorators as well.
 */
$decorator1 = new ConcreteDecoratorA($simple);
$decorator2 = new ConcreteDecoratorB($decorator1);
echo "Client: Now I've got a decorated component:\n";
clientCode($decorator2);