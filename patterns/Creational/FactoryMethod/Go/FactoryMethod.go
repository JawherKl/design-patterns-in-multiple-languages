package main

import (
	"fmt"
)

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern, which defines 
| an interface for creating an object but allows subclasses to alter the type 
| of objects that will be created.
|--------------------------------------------------------------------------
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

type Product interface {
	Operation() string
}

// Creator declares the factory method.
type Creator interface {
	FactoryMethod() Product
	SomeOperation() string
}

// ConcreteCreator1 implements the Creator and overrides the FactoryMethod.
type ConcreteCreator1 struct{}

func (c *ConcreteCreator1) FactoryMethod() Product {
	return &ConcreteProduct1{}
}

func (c *ConcreteCreator1) SomeOperation() string {
	product := c.FactoryMethod()
	return "Creator: The same creator's code has just worked with " + product.Operation()
}

// ConcreteCreator2 implements the Creator and overrides the FactoryMethod.
type ConcreteCreator2 struct{}

func (c *ConcreteCreator2) FactoryMethod() Product {
	return &ConcreteProduct2{}
}

func (c *ConcreteCreator2) SomeOperation() string {
	product := c.FactoryMethod()
	return "Creator: The same creator's code has just worked with " + product.Operation()
}

// ConcreteProduct1 implements the Product interface.
type ConcreteProduct1 struct{}

func (p *ConcreteProduct1) Operation() string {
	return "{Result of the ConcreteProduct1}"
}

// ConcreteProduct2 implements the Product interface.
type ConcreteProduct2 struct{}

func (p *ConcreteProduct2) Operation() string {
	return "{Result of the ConcreteProduct2}"
}

// Client code.
func clientCode(creator Creator) {
	fmt.Println("Client: I'm not aware of the creator's class, but it still works.")
	fmt.Println(creator.SomeOperation())
}

func main() {
	// Application picks a creator's type depending on the configuration or environment.
	fmt.Println("App: Launched with the ConcreteCreator1.")
	clientCode(&ConcreteCreator1{})

	fmt.Println("\nApp: Launched with the ConcreteCreator2.")
	clientCode(&ConcreteCreator2{})
}
