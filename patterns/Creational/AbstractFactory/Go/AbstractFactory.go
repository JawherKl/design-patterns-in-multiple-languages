package main

import "fmt"

// Abstract Factory interface declares methods to create abstract products
type AbstractFactory interface {
	CreateProductA() AbstractProductA
	CreateProductB() AbstractProductB
}

// Concrete Factory 1 produces ProductA1 and ProductB1
type ConcreteFactory1 struct{}

func (f *ConcreteFactory1) CreateProductA() AbstractProductA {
	return &ConcreteProductA1{}
}

func (f *ConcreteFactory1) CreateProductB() AbstractProductB {
	return &ConcreteProductB1{}
}

// Concrete Factory 2 produces ProductA2 and ProductB2
type ConcreteFactory2 struct{}

func (f *ConcreteFactory2) CreateProductA() AbstractProductA {
	return &ConcreteProductA2{}
}

func (f *ConcreteFactory2) CreateProductB() AbstractProductB {
	return &ConcreteProductB2{}
}

// Abstract ProductA interface defines methods that ProductA must implement
type AbstractProductA interface {
	UsefulFunctionA() string
}

// Concrete ProductA1 implements the AbstractProductA interface
type ConcreteProductA1 struct{}

func (p *ConcreteProductA1) UsefulFunctionA() string {
	return "The result of the product A1."
}

// Concrete ProductA2 implements the AbstractProductA interface
type ConcreteProductA2 struct{}

func (p *ConcreteProductA2) UsefulFunctionA() string {
	return "The result of the product A2."
}

// Abstract ProductB interface defines methods that ProductB must implement
type AbstractProductB interface {
	UsefulFunctionB() string
	AnotherUsefulFunctionB(collaborator AbstractProductA) string
}

// Concrete ProductB1 implements the AbstractProductB interface
type ConcreteProductB1 struct{}

func (p *ConcreteProductB1) UsefulFunctionB() string {
	return "The result of the product B1."
}

func (p *ConcreteProductB1) AnotherUsefulFunctionB(collaborator AbstractProductA) string {
	result := collaborator.UsefulFunctionA()
	return fmt.Sprintf("The result of B1 collaborating with the (%s)", result)
}

// Concrete ProductB2 implements the AbstractProductB interface
type ConcreteProductB2 struct{}

func (p *ConcreteProductB2) UsefulFunctionB() string {
	return "The result of the product B2."
}

func (p *ConcreteProductB2) AnotherUsefulFunctionB(collaborator AbstractProductA) string {
	result := collaborator.UsefulFunctionA()
	return fmt.Sprintf("The result of B2 collaborating with the (%s)", result)
}

// Client code that works with the abstract factory and products
func clientCode(factory AbstractFactory) {
	productA := factory.CreateProductA()
	productB := factory.CreateProductB()

	fmt.Println(productB.UsefulFunctionB())
	fmt.Println(productB.AnotherUsefulFunctionB(productA))
}

func main() {
	fmt.Println("Client: Testing client code with the first factory type:")
	clientCode(&ConcreteFactory1{})

	fmt.Println("\nClient: Testing the same client code with the second factory type:")
	clientCode(&ConcreteFactory2{})
}
