/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Shape Example
|--------------------------------------------------------------------------
| Implement the Prototype Design Pattern to clone shape objects, 
| avoiding the need for subclass-specific object creation processes.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational.Prototype
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-java
|--------------------------------------------------------------------------
*/

import java.util.ArrayList;
import java.util.List;

// Prototype Interface
interface ShapePrototype extends Cloneable {
    ShapePrototype clone();
}

// Abstract Shape Class
// Defines common properties and the cloning interface.
abstract class Shape implements ShapePrototype {
    protected String color;

    public void setColor(String color) {
        this.color = color;
    }

    public abstract String draw();

    // This method is required by the prototype pattern.
    @Override
    public abstract ShapePrototype clone();
}

// Concrete Prototype: Circle
class Circle extends Shape {
    private int radius;

    public Circle(int radius) {
        this.radius = radius;
    }

    @Override
    public String draw() {
        return "Drawing a circle with radius " + radius + " and color " + color;
    }

    @Override
    public ShapePrototype clone() {
        try {
            return (Circle) super.clone();
        } catch (CloneNotSupportedException e) {
            throw new AssertionError();
        }
    }
}

// Concrete Prototype: Rectangle
class Rectangle extends Shape {
    private int width;
    private int height;

    public Rectangle(int width, int height) {
        this.width = width;
        this.height = height;
    }

    @Override
    public String draw() {
        return "Drawing a rectangle with width " + width + ", height " + height + " and color " + color;
    }

    @Override
    public ShapePrototype clone() {
        try {
            return (Rectangle) super.clone();
        } catch (CloneNotSupportedException e) {
            throw new AssertionError();
        }
    }
}

// Client Code demonstrating Prototype Design Pattern.
public class Main {
    public static void main(String[] args) {
        // Create a Circle object.
        Circle circle = new Circle(10);
        circle.setColor("Red");

        // Clone the Circle object.
        Circle clonedCircle = (Circle) circle.clone();
        clonedCircle.setColor("Blue");

        // Create a Rectangle object.
        Rectangle rectangle = new Rectangle(20, 10);
        rectangle.setColor("Green");

        // Clone the Rectangle object.
        Rectangle clonedRectangle = (Rectangle) rectangle.clone();
        clonedRectangle.setColor("Yellow");

        // Output original and cloned shapes.
        System.out.println("Original Circle: " + circle.draw());
        System.out.println("Cloned Circle: " + clonedCircle.draw());

        System.out.println("\nOriginal Rectangle: " + rectangle.draw());
        System.out.println("Cloned Rectangle: " + clonedRectangle.draw());
    }
}
