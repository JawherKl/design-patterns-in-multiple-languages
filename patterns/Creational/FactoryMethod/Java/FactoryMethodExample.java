package patterns.Creational.FactoryMethod.Java;

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern, which defines 
| an interface for creating an object but allows subclasses to alter the type 
| of objects that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-multiple-languages
|--------------------------------------------------------------------------
|
| Key Components:
| 1. Creator (Abstract Class): Declares the factory method that returns 
|    Product objects. It may contain core business logic that relies on the 
|    Product objects.
| 2. Concrete Creators: Override the factory method to create specific 
|    ConcreteProduct instances.
| 3. Product (Interface): Defines the common interface that all products must 
|    implement.
| 4. Concrete Products: Implement the Product interface, providing different 
|    implementations of the `operation` method.
| 5. Client Code: Works with the Creator and Product via their abstract 
|    interfaces, ensuring flexibility and decoupling.
|--------------------------------------------------------------------------
| Use Case:
| Use the Factory Method pattern when a class cannot anticipate the type of 
| objects it must create or when a class wants its subclasses to specify the 
| objects it creates.
*/

// Product interface
interface Product {
    String operation();
}

// Concrete Product 1
class ConcreteProduct1 implements Product {
    @Override
    public String operation() {
        return "{Result of the ConcreteProduct1}";
    }
}

// Concrete Product 2
class ConcreteProduct2 implements Product {
    @Override
    public String operation() {
        return "{Result of the ConcreteProduct2}";
    }
}

// Abstract Creator class
abstract class Creator {
    // Factory method to be implemented by subclasses
    public abstract Product factoryMethod();

    // Core business logic that relies on the Product objects
    public String someOperation() {
        Product product = factoryMethod();
        return "Creator: The same creator's code has just worked with " + product.operation();
    }
}

// Concrete Creator 1
class ConcreteCreator1 extends Creator {
    @Override
    public Product factoryMethod() {
        return new ConcreteProduct1();
    }
}

// Concrete Creator 2
class ConcreteCreator2 extends Creator {
    @Override
    public Product factoryMethod() {
        return new ConcreteProduct2();
    }
}

// Client code
public class FactoryMethodExample {
    public static void clientCode(Creator creator) {
        System.out.println("Client: I'm not aware of the creator's class, but it still works.");
        System.out.println(creator.someOperation());
    }

    public static void main(String[] args) {
        System.out.println("App: Launched with the ConcreteCreator1.");
        clientCode(new ConcreteCreator1());
        System.out.println();

        System.out.println("App: Launched with the ConcreteCreator2.");
        clientCode(new ConcreteCreator2());
        System.out.println();
    }
}
