<?php

/*
|--------------------------------------------------------------------------
| Structural Design Pattern - Decorator
|--------------------------------------------------------------------------
| Implement Decorator Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Decorator\RalWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Structural\Decorator\RealWorldExample;

/**
 * The Component interface declares a method for transforming the message.
 */
interface Message
{
    public function getText(string $text): string;
}

/**
 * Concrete Component that implements the basic message behavior.
 */
class SimpleMessage implements Message
{
    public function getText(string $text): string
    {
        return $text;
    }
}

/**
 * Base Decorator class that holds a reference to a Message object and delegates
 * all work to the wrapped object.
 */
class MessageDecorator implements Message
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getText(string $text): string
    {
        return $this->message->getText($text);
    }
}

/**
 * Concrete Decorator that reverses the message text.
 */
class ReverseTextDecorator extends MessageDecorator
{
    public function getText(string $text): string
    {
        $text = parent::getText($text);
        return strrev($text);
    }
}

/**
 * Concrete Decorator that converts the message text to uppercase.
 */
class UppercaseDecorator extends MessageDecorator
{
    public function getText(string $text): string
    {
        $text = parent::getText($text);
        return strtoupper($text);
    }
}

/**
 * Concrete Decorator that simulates basic encryption by shifting characters.
 */
class EncryptionDecorator extends MessageDecorator
{
    public function getText(string $text): string
    {
        $text = parent::getText($text);
        return str_rot13($text);  // Simple ROT13 encryption
    }
}

/**
 * Client code demonstrates applying multiple decorators to a simple message.
 */
function displayMessage(Message $message, string $text)
{
    echo $message->getText($text) . PHP_EOL;
}

// Example usage
$message = new SimpleMessage();
echo "Original Message:\n";
displayMessage($message, "Hello, World!");

$reversed = new ReverseTextDecorator($message);
echo "\nReversed Message:\n";
displayMessage($reversed, "Hello, World!");

$uppercase = new UppercaseDecorator($reversed);
echo "\nReversed and Uppercase Message:\n";
displayMessage($uppercase, "Hello, World!");

$encrypted = new EncryptionDecorator($uppercase);
echo "\nReversed, Uppercase, and Encrypted Message:\n";
displayMessage($encrypted, "Hello, World!");
