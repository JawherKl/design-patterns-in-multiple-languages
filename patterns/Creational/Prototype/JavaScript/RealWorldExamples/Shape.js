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
| @link      https://github.com/JawherKl/design-patterns-in-js
|--------------------------------------------------------------------------
*/

/**
 * Prototype Interface
 */
class ShapePrototype {
    clone() {
        throw new Error("You must implement the clone method.");
    }
}

/**
 * Abstract Shape Class
 * Defines common properties and the cloning interface.
 */
class Shape extends ShapePrototype {
    constructor() {
        super();
        this.color = null;
    }

    setColor(color) {
        this.color = color;
    }

    draw() {
        throw new Error("You must implement the draw method.");
    }

    /**
     * This method is required by the prototype pattern.
     */
    clone() {
        throw new Error("You must implement the clone method.");
    }
}

/**
 * Concrete Prototype: Circle
 */
class Circle extends Shape {
    constructor(radius) {
        super();
        this.radius = radius;
    }

    draw() {
        return `Drawing a circle with radius ${this.radius} and color ${this.color}`;
    }

    clone() {
        // Optionally customize the behavior of cloned objects.
        return Object.create(Object.getPrototypeOf(this), Object.getOwnPropertyDescriptors(this));
    }
}

/**
 * Concrete Prototype: Rectangle
 */
class Rectangle extends Shape {
    constructor(width, height) {
        super();
        this.width = width;
        this.height = height;
    }

    draw() {
        return `Drawing a rectangle with width ${this.width}, height ${this.height} and color ${this.color}`;
    }

    clone() {
        // Optionally customize the behavior of cloned objects.
        return Object.create(Object.getPrototypeOf(this), Object.getOwnPropertyDescriptors(this));
    }
}

/**
 * Client Code demonstrating Prototype Design Pattern.
 */
function clientCode() {
    // Create a Circle object.
    const circle = new Circle(10);
    circle.setColor("Red");

    // Clone the Circle object.
    const clonedCircle = circle.clone();
    clonedCircle.setColor("Blue");

    // Create a Rectangle object.
    const rectangle = new Rectangle(20, 10);
    rectangle.setColor("Green");

    // Clone the Rectangle object.
    const clonedRectangle = rectangle.clone();
    clonedRectangle.setColor("Yellow");

    // Output original and cloned shapes.
    console.log("Original Circle: " + circle.draw());
    console.log("Cloned Circle: " + clonedCircle.draw());

    console.log("\nOriginal Rectangle: " + rectangle.draw());
    console.log("Cloned Rectangle: " + clonedRectangle.draw());
}

clientCode();
