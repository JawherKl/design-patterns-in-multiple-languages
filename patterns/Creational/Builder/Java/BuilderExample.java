package patterns.Creational.Builder.Java;

import java.util.ArrayList;
import java.util.List;

// Builder Design Pattern - Implementation Example
//
// This example demonstrates the Builder Design Pattern, which is used to 
// construct complex objects step by step. It separates the construction 
// process from the representation, allowing the same construction process 
// to create different representations.
//
// @category  Design Pattern
// @package   Creational/Builder
// @version   1.0.0
// @license   MIT License
// @author    JawherKl
// @link      https://github.com/JawherKl/design-patterns-in-multiple-languages
//
// Key Components:
// 1. Builder Interface: Defines the construction steps for creating parts of 
//    the Product.
// 2. Concrete Builder: Implements the steps defined in the Builder interface 
//    to create specific product parts.
// 3. Product: Represents the complex object being constructed.
// 4. Director: Orchestrates the construction steps to build the product in a 
//    specific sequence.
// 5. Client Code: Uses the Director and Builder to create products.
//
// Use Case:
// This pattern is useful when creating objects that require multiple steps 
// or configurations. In this example, it demonstrates assembling a product 
// with multiple parts (PartA, PartB, PartC), either minimally or fully 
// featured.

// The Builder interface specifies methods for creating the different parts of
// the Product objects.
interface Builder {
    void producePartA();
    void producePartB();
    void producePartC();
}

// The Concrete Builder classes follow the Builder interface and provide
// specific implementations of the building steps. Your program may have several
// variations of Builders, implemented differently.
class ConcreteBuilder1 implements Builder {
    private Product1 product;

    // A fresh builder instance should contain a blank product object, which is
    // used in further assembly.
    public ConcreteBuilder1() {
        this.reset();
    }

    public void reset() {
        this.product = new Product1();
    }

    // All production steps work with the same product instance.
    @Override
    public void producePartA() {
        this.product.addPart("PartA1");
    }

    @Override
    public void producePartB() {
        this.product.addPart("PartB1");
    }

    @Override
    public void producePartC() {
        this.product.addPart("PartC1");
    }

    // Concrete Builders are supposed to provide their own methods for
    // retrieving results. That's because various types of builders may create
    // entirely different products that don't follow the same interface.
    // Usually, after returning the end result to the client, a builder instance
    // is expected to be ready to start producing another product. That's why
    // it's a usual practice to call the reset method at the end of the
    // `getProduct` method body. However, this behavior is not mandatory, and
    // you can make your builders wait for an explicit reset call from the
    // client code before disposing of the previous result.
    public Product1 getProduct() {
        Product1 result = this.product;
        this.reset();
        return result;
    }
}

// It makes sense to use the Builder pattern only when your products are quite
// complex and require extensive configuration.
// Unlike in other creational patterns, different concrete builders can produce
// unrelated products. In other words, results of various builders may not
// always follow the same interface.
class Product1 {
    private List<String> parts = new ArrayList<>();

    public void addPart(String part) {
        parts.add(part);
    }

    public void listParts() {
        System.out.println("Product parts: " + String.join(", ", parts));
    }
}

// The Director is only responsible for executing the building steps in a
// particular sequence. It is helpful when producing products according to a
// specific order or configuration. Strictly speaking, the Director class is
// optional, since the client can control builders directly.
class Director {
    private Builder builder;

    // The Director works with any builder instance that the client code passes
    // to it. This way, the client code may alter the final type of the newly
    // assembled product.
    public void setBuilder(Builder builder) {
        this.builder = builder;
    }

    // The Director can construct several product variations using the same
    // building steps.
    public void buildMinimalViableProduct() {
        this.builder.producePartA();
    }

    public void buildFullFeaturedProduct() {
        this.builder.producePartA();
        this.builder.producePartB();
        this.builder.producePartC();
    }
}

// The client code creates a builder object, passes it to the director and then
// initiates the construction process. The end result is retrieved from the
// builder object.
public class BuilderExample {
    public static void main(String[] args) {
        Director director = new Director();
        ConcreteBuilder1 builder = new ConcreteBuilder1();
        director.setBuilder(builder);

        System.out.println("Standard basic product:");
        director.buildMinimalViableProduct();
        builder.getProduct().listParts();

        System.out.println("Standard full featured product:");
        director.buildFullFeaturedProduct();
        builder.getProduct().listParts();

        // Remember, the Builder pattern can be used without a Director class.
        System.out.println("Custom product:");
        builder.producePartA();
        builder.producePartC();
        builder.getProduct().listParts();
    }
}