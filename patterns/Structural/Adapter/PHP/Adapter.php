<?php

/*
|--------------------------------------------------------------------------
| Adapter Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Adapter Design Pattern, which allows 
| incompatible interfaces to work together by creating an intermediary 
| class (Adapter) that translates the interface of one class (Adaptee) 
| into another (Target).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Structural/Adapter
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Target Interface**: Defines the interface expected by client code.
| 2. **Adaptee Class**: Contains the existing interface with incompatible methods.
| 3. **Adapter Class**: Converts the Adaptee's interface into the Target interface.
| 4. **Client Code**: Works with objects that follow the Target interface.
*/

namespace Structural\Adapter;

/**
 * The Target defines the domain-specific interface used by the client code.
 */
class Target
{
    public function request(): string
    {
        return "Target: The default target's behavior.";
    }
}

/**
 * The Adaptee contains some useful behavior, but its interface is incompatible
 * with the existing client code. The Adaptee needs some adaptation before the
 * client code can use it.
 */
class Adaptee
{
    public function specificRequest(): string
    {
        return ".eetpadA eht fo roivaheb laicepS";
    }
}

/**
 * The Adapter makes the Adaptee's interface compatible with the Target's
 * interface.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Adapter: (TRANSLATED) " . strrev($this->adaptee->specificRequest());
    }
}

/**
 * The client code supports all classes that follow the Target interface.
 */
function clientCode(Target $target)
{
    echo $target->request();
}

echo "Client: I can work just fine with the Target objects:\n";
$target = new Target();
clientCode($target);
echo "\n\n";

$adaptee = new Adaptee();
echo "Client: The Adaptee class has a weird interface. See, I don't understand it:\n";
echo "Adaptee: " . $adaptee->specificRequest();
echo "\n\n";

echo "Client: But I can work with it via the Adapter:\n";
$adapter = new Adapter($adaptee);
clientCode($adapter);