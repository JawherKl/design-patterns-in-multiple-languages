/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Shape Example
|--------------------------------------------------------------------------
| Implement the Prototype Design Pattern to clone shape objects, 
| avoiding the need for subclass-specific object creation processes.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-go
|--------------------------------------------------------------------------
*/

package main

import (
    "fmt"
)

// ShapePrototype interface defines the clone method.
type ShapePrototype interface {
    Clone() ShapePrototype
    Draw() string
    SetColor(color string)
}

// Shape struct defines common properties and the cloning interface.
type Shape struct {
    Color string
}

// SetColor sets the color of the shape.
func (s *Shape) SetColor(color string) {
    s.Color = color
}

// Circle struct represents a concrete prototype.
type Circle struct {
    Shape
    Radius int
}

// NewCircle is the constructor for Circle.
func NewCircle(radius int) *Circle {
    return &Circle{Radius: radius}
}

// Draw outputs the properties of the circle.
func (c *Circle) Draw() string {
    return fmt.Sprintf("Drawing a circle with radius %d and color %s", c.Radius, c.Color)
}

// Clone creates a copy of the circle.
func (c *Circle) Clone() ShapePrototype {
    clone := *c
    return &clone
}

// Rectangle struct represents a concrete prototype.
type Rectangle struct {
    Shape
    Width  int
    Height int
}

// NewRectangle is the constructor for Rectangle.
func NewRectangle(width, height int) *Rectangle {
    return &Rectangle{Width: width, Height: height}
}

// Draw outputs the properties of the rectangle.
func (r *Rectangle) Draw() string {
    return fmt.Sprintf("Drawing a rectangle with width %d, height %d and color %s", r.Width, r.Height, r.Color)
}

// Clone creates a copy of the rectangle.
func (r *Rectangle) Clone() ShapePrototype {
    clone := *r
    return &clone
}

// Client code demonstrating Prototype Design Pattern.
func clientCode() {
    // Create a Circle object.
    circle := NewCircle(10)
    circle.SetColor("Red")

    // Clone the Circle object.
    clonedCircle := circle.Clone().(*Circle)
    clonedCircle.SetColor("Blue")

    // Create a Rectangle object.
    rectangle := NewRectangle(20, 10)
    rectangle.SetColor("Green")

    // Clone the Rectangle object.
    clonedRectangle := rectangle.Clone().(*Rectangle)
    clonedRectangle.SetColor("Yellow")

    // Output original and cloned shapes.
    fmt.Println("Original Circle: " + circle.Draw())
    fmt.Println("Cloned Circle: " + clonedCircle.Draw())

    fmt.Println("\nOriginal Rectangle: " + rectangle.Draw())
    fmt.Println("Cloned Rectangle: " + clonedRectangle.Draw())
}

func main() {
    clientCode()
}
