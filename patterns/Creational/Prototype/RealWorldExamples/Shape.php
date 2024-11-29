<?php

/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Example
|--------------------------------------------------------------------------
| Implement the Prototype Design Pattern to clone shape objects, 
| avoiding the need for subclass-specific object creation processes.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Prototype\Example;

/**
 * Prototype Interface
 */
interface ShapePrototype
{
    public function __clone();
}

/**
 * Abstract Shape Class
 * Defines common properties and the cloning interface.
 */
abstract class Shape implements ShapePrototype
{
    public $color;

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    abstract public function draw(): string;

    /**
     * This method is required by the prototype pattern.
     */
    abstract public function __clone();
}

/**
 * Concrete Prototype: Circle
 */
class Circle extends Shape
{
    private $radius;

    public function __construct(int $radius)
    {
        $this->radius = $radius;
    }

    public function draw(): string
    {
        return "Drawing a circle with radius " . $this->radius . " and color " . $this->color;
    }

    public function __clone()
    {
        // Optionally customize the behavior of cloned objects.
    }
}

/**
 * Concrete Prototype: Rectangle
 */
class Rectangle extends Shape
{
    private $width;
    private $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(): string
    {
        return "Drawing a rectangle with width " . $this->width . ", height " . $this->height . " and color " . $this->color;
    }

    public function __clone()
    {
        // Optionally customize the behavior of cloned objects.
    }
}

/**
 * Client Code demonstrating Prototype Design Pattern.
 */
function clientCode()
{
    // Create a Circle object.
    $circle = new Circle(10);
    $circle->setColor("Red");

    // Clone the Circle object.
    $clonedCircle = clone $circle;
    $clonedCircle->setColor("Blue");

    // Create a Rectangle object.
    $rectangle = new Rectangle(20, 10);
    $rectangle->setColor("Green");

    // Clone the Rectangle object.
    $clonedRectangle = clone $rectangle;
    $clonedRectangle->setColor("Yellow");

    // Output original and cloned shapes.
    echo "Original Circle: " . $circle->draw() . "\n";
    echo "Cloned Circle: " . $clonedCircle->draw() . "\n";

    echo "\nOriginal Rectangle: " . $rectangle->draw() . "\n";
    echo "Cloned Rectangle: " . $clonedRectangle->draw() . "\n";
}

clientCode();

