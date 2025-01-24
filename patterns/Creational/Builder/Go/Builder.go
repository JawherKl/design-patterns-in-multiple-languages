package main

import (
	"fmt"
	"strings"
)

// Builder interface defines the steps to build the product.
type Builder interface {
	ProducePartA()
	ProducePartB()
	ProducePartC()
	GetProduct() *Product
}

// ConcreteBuilder1 implements the Builder interface.
type ConcreteBuilder1 struct {
	product *Product
}

func NewConcreteBuilder1() *ConcreteBuilder1 {
	return &ConcreteBuilder1{product: &Product{}}
}

func (b *ConcreteBuilder1) Reset() {
	b.product = &Product{}
}

func (b *ConcreteBuilder1) ProducePartA() {
	b.product.parts = append(b.product.parts, "PartA1")
}

func (b *ConcreteBuilder1) ProducePartB() {
	b.product.parts = append(b.product.parts, "PartB1")
}

func (b *ConcreteBuilder1) ProducePartC() {
	b.product.parts = append(b.product.parts, "PartC1")
}

func (b *ConcreteBuilder1) GetProduct() *Product {
	result := b.product
	b.Reset()
	return result
}

// Product represents the complex object being constructed.
type Product struct {
	parts []string
}

func (p *Product) ListParts() {
	fmt.Println("Product parts:", strings.Join(p.parts, ", "))
}

// Director orchestrates the construction process.
type Director struct {
	builder Builder
}

func (d *Director) SetBuilder(builder Builder) {
	d.builder = builder
}

func (d *Director) BuildMinimalViableProduct() {
	d.builder.ProducePartA()
}

func (d *Director) BuildFullFeaturedProduct() {
	d.builder.ProducePartA()
	d.builder.ProducePartB()
	d.builder.ProducePartC()
}

// Client code
func main() {
	director := &Director{}
	builder := NewConcreteBuilder1()
	director.SetBuilder(builder)

	fmt.Println("Standard basic product:")
	director.BuildMinimalViableProduct()
	builder.GetProduct().ListParts()

	fmt.Println("Standard full featured product:")
	director.BuildFullFeaturedProduct()
	builder.GetProduct().ListParts()

	fmt.Println("Custom product:")
	builder.ProducePartA()
	builder.ProducePartC()
	builder.GetProduct().ListParts()
}