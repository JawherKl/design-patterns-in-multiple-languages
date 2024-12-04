<?php

/*
|--------------------------------------------------------------------------
| Abstract Factory Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Abstract Factory Design Pattern to create 
| different types of related objects (Product A and Product B) that are part 
| of a family. The Abstract Factory provides an interface for creating families 
| of related or dependent objects without specifying their concrete classes.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/AbstractFactory
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-multiple-languages
|--------------------------------------------------------------------------
|
| Key Components:
| 1. AbstractFactory: Declares the methods for creating abstract products.
| 2. ConcreteFactory: Implements the creation methods for specific product variants.
| 3. AbstractProduct: Declares interfaces for a type of product.
| 4. ConcreteProduct: Implements the abstract product interfaces with specific variants.
| 5. Client Code: Uses the Abstract Factory to work with products through abstract types.
|
| This example includes two concrete factories (ConcreteFactory1 and ConcreteFactory2)
| that produce two families of products (ProductA and ProductB) in two variants.
| The client code interacts only with interfaces, promoting flexibility and extensibility.
|
*/

namespace Creational\AbstractFactory\PHP;


/**
 * The Abstract Factory interface declares a set of methods that return
 * different abstract products. These products are called a family and are
 * related by a high-level theme or concept. Products of one family are usually
 * able to collaborate among themselves. A family of products may have several
 * variants, but the products of one variant are incompatible with products of
 * another.
 */
interface AbstractFactory
{
    public function createProductA(): AbstractProductA;

    public function createProductB(): AbstractProductB;
}

/**
 * Concrete Factories produce a family of products that belong to a single
 * variant. The factory guarantees that resulting products are compatible. Note
 * that signatures of the Concrete Factory's methods return an abstract product,
 * while inside the method a concrete product is instantiated.
 */
class ConcreteFactory1 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA1();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB1();
    }
}

/**
 * Each Concrete Factory has a corresponding product variant.
 */
class ConcreteFactory2 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA2();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB2();
    }
}

/**
 * Each distinct product of a product family should have a base interface. All
 * variants of the product must implement this interface.
 */
interface AbstractProductA
{
    public function usefulFunctionA(): string;
}

/**
 * Concrete Products are created by corresponding Concrete Factories.
 */
class ConcreteProductA1 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "The result of the product A1.";
    }
}

class ConcreteProductA2 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "The result of the product A2.";
    }
}

/**
 * Here's the the base interface of another product. All products can interact
 * with each other, but proper interaction is possible only between products of
 * the same concrete variant.
 */
interface AbstractProductB
{
    /**
     * Product B is able to do its own thing...
     */
    public function usefulFunctionB(): string;

    /**
     * ...but it also can collaborate with the ProductA.
     *
     * The Abstract Factory makes sure that all products it creates are of the
     * same variant and thus, compatible.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string;
}

/**
 * Concrete Products are created by corresponding Concrete Factories.
 */
class ConcreteProductB1 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "The result of the product B1.";
    }

    /**
     * The variant, Product B1, is only able to work correctly with the variant,
     * Product A1. Nevertheless, it accepts any instance of AbstractProductA as
     * an argument.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "The result of the B1 collaborating with the ({$result})";
    }
}

class ConcreteProductB2 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "The result of the product B2.";
    }

    /**
     * The variant, Product B2, is only able to work correctly with the variant,
     * Product A2. Nevertheless, it accepts any instance of AbstractProductA as
     * an argument.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "The result of the B2 collaborating with the ({$result})";
    }
}

/**
 * The client code works with factories and products only through abstract
 * types: AbstractFactory and AbstractProduct. This lets you pass any factory or
 * product subclass to the client code without breaking it.
 */
function clientCode(AbstractFactory $factory)
{
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB() . "\n";
    echo $productB->anotherUsefulFunctionB($productA) . "\n";
}

/**
 * The client code can work with any concrete factory class.
 */
echo "Client: Testing client code with the first factory type:\n";
clientCode(new ConcreteFactory1());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new ConcreteFactory2());