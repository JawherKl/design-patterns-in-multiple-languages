/**
 * Factory Method Design Pattern - Implementation Example
 * 
 * This example demonstrates the Factory Method Design Pattern, which defines 
 * an interface for creating an object but allows subclasses to alter the type 
 * of objects that will be created.
 * 
 * Key Components:
 * 1. Creator (Abstract Class): Declares the factory method that returns Product objects. 
 *    It may contain core business logic that relies on the Product objects.
 * 2. Concrete Creators: Override the factory method to create specific ConcreteProduct instances.
 * 3. Product (Interface): Defines the common interface that all products must implement.
 * 4. Concrete Products: Implement the Product interface, providing different implementations of the `operation` method.
 * 5. Client Code: Works with the Creator and Product via their abstract interfaces, ensuring flexibility and decoupling.
 * 
 * Use Case:
 * Use the Factory Method pattern when a class cannot anticipate the type of objects 
 * it must create or when a class wants its subclasses to specify the objects it creates.
 */

// Abstract Creator
class Creator {
    /**
     * The factory method, which must be implemented by subclasses.
     */
    factoryMethod() {
        throw new Error("You must override this method in a subclass.");
    }

    /**
     * Contains business logic that relies on Product objects created by the factory method.
     */
    someOperation() {
        // Call the factory method to create a Product object.
        const product = this.factoryMethod();

        // Use the product.
        return `Creator: The same creator's code has just worked with ${product.operation()}`;
    }
}

// Concrete Creator 1
class ConcreteCreator1 extends Creator {
    /**
     * Overrides the factory method to create a specific product.
     */
    factoryMethod() {
        return new ConcreteProduct1();
    }
}

// Concrete Creator 2
class ConcreteCreator2 extends Creator {
    /**
     * Overrides the factory method to create a specific product.
     */
    factoryMethod() {
        return new ConcreteProduct2();
    }
}

// Abstract Product
class Product {
    /**
     * The operation method that all concrete products must implement.
     */
    operation() {
        throw new Error("You must override this method in a subclass.");
    }
}

// Concrete Product 1
class ConcreteProduct1 extends Product {
    operation() {
        return "{Result of the ConcreteProduct1}";
    }
}

// Concrete Product 2
class ConcreteProduct2 extends Product {
    operation() {
        return "{Result of the ConcreteProduct2}";
    }
}

// Client Code
function clientCode(creator) {
    console.log(`Client: I'm not aware of the creator's class, but it still works.\n${creator.someOperation()}`);
}

// Application
console.log("App: Launched with the ConcreteCreator1.");
clientCode(new ConcreteCreator1());
console.log("\n");

console.log("App: Launched with the ConcreteCreator2.");
clientCode(new ConcreteCreator2());
