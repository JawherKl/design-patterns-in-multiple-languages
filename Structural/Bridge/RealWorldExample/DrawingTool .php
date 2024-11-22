<?php

/*
|--------------------------------------------------------------------------
| Bridge Design Pattern - Bridge
|--------------------------------------------------------------------------
| Implement Bridge Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Bridge/RealWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace DesignPatterns\Bridge;

/**
 * The Abstraction defines the interface for shapes.
 */
abstract class Shape
{
    /**
     * @var Renderer
     */
    protected $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    abstract public function draw(): string;
    abstract public function resize(float $factor): string;
}

/**
 * Refined Abstraction: Represents a Circle shape.
 */
class Circle extends Shape
{
    private $radius;

    public function __construct(Renderer $renderer, float $radius)
    {
        parent::__construct($renderer);
        $this->radius = $radius;
    }

    public function draw(): string
    {
        return $this->renderer->renderCircle($this->radius);
    }

    public function resize(float $factor): string
    {
        $this->radius *= $factor;
        return "Circle resized to new radius: {$this->radius}\n";
    }
}

/**
 * Refined Abstraction: Represents a Rectangle shape.
 */
class Rectangle extends Shape
{
    private $width;
    private $height;

    public function __construct(Renderer $renderer, float $width, float $height)
    {
        parent::__construct($renderer);
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(): string
    {
        return $this->renderer->renderRectangle($this->width, $this->height);
    }

    public function resize(float $factor): string
    {
        $this->width *= $factor;
        $this->height *= $factor;
        return "Rectangle resized to new dimensions: {$this->width}x{$this->height}\n";
    }
}

/**
 * The Implementation defines the interface for rendering methods.
 */
interface Renderer
{
    public function renderCircle(float $radius): string;
    public function renderRectangle(float $width, float $height): string;
}

/**
 * Concrete Implementation: Renders shapes using vector graphics.
 */
class VectorRenderer implements Renderer
{
    public function renderCircle(float $radius): string
    {
        return "VectorRenderer: Drawing a circle with radius {$radius}.\n";
    }

    public function renderRectangle(float $width, float $height): string
    {
        return "VectorRenderer: Drawing a rectangle with dimensions {$width}x{$height}.\n";
    }
}

/**
 * Concrete Implementation: Renders shapes using raster graphics.
 */
class RasterRenderer implements Renderer
{
    public function renderCircle(float $radius): string
    {
        return "RasterRenderer: Drawing pixels for a circle with radius {$radius}.\n";
    }

    public function renderRectangle(float $width, float $height): string
    {
        return "RasterRenderer: Drawing pixels for a rectangle with dimensions {$width}x{$height}.\n";
    }
}

/**
 * Client Code
 */
function clientCode(Shape $shape)
{
    echo $shape->draw();
    echo $shape->resize(2);
    echo $shape->draw();
}

// Client: Drawing a circle with vector graphics
$vectorRenderer = new VectorRenderer();
$circle = new Circle($vectorRenderer, 5);
clientCode($circle);

echo "\n\n";

// Client: Drawing a rectangle with raster graphics
$rasterRenderer = new RasterRenderer();
$rectangle = new Rectangle($rasterRenderer, 4, 6);
clientCode($rectangle);
