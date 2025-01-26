package main

import "fmt"

// Builder Design Pattern - Computer Assembly
//
// This example demonstrates the Builder Design Pattern for assembling
// different types of computers with varying configurations (Gaming, Office).

// ComputerBuilder interface declares the product building steps that are common
// for all types of builders.
type ComputerBuilder interface {
    SetCPU(cpu string) ComputerBuilder
    SetRAM(ram string) ComputerBuilder
    SetStorage(storage string) ComputerBuilder
    SetGraphicsCard(gpu string) ComputerBuilder
    GetComputer() Computer
}

// Concrete Builder for assembling a Gaming Computer.
type GamingComputerBuilder struct {
    computer Computer
}

func (b *GamingComputerBuilder) SetCPU(cpu string) ComputerBuilder {
    b.computer.parts["CPU"] = cpu
    return b
}

func (b *GamingComputerBuilder) SetRAM(ram string) ComputerBuilder {
    b.computer.parts["RAM"] = ram
    return b
}

func (b *GamingComputerBuilder) SetStorage(storage string) ComputerBuilder {
    b.computer.parts["Storage"] = storage
    return b
}

func (b *GamingComputerBuilder) SetGraphicsCard(gpu string) ComputerBuilder {
    b.computer.parts["GraphicsCard"] = gpu
    return b
}

func (b *GamingComputerBuilder) GetComputer() Computer {
    return b.computer
}

// Concrete Builder for assembling an Office Computer.
type OfficeComputerBuilder struct {
    computer Computer
}

func (b *OfficeComputerBuilder) SetCPU(cpu string) ComputerBuilder {
    b.computer.parts["CPU"] = cpu
    return b
}

func (b *OfficeComputerBuilder) SetRAM(ram string) ComputerBuilder {
    b.computer.parts["RAM"] = ram
    return b
}

func (b *OfficeComputerBuilder) SetStorage(storage string) ComputerBuilder {
    b.computer.parts["Storage"] = storage
    return b
}

func (b *OfficeComputerBuilder) SetGraphicsCard(gpu string) ComputerBuilder {
    b.computer.parts["GraphicsCard"] = "Integrated GPU" // Office computers don't need high-end GPUs
    return b
}

func (b *OfficeComputerBuilder) GetComputer() Computer {
    return b.computer
}

// Product class representing a Computer.
type Computer struct {
    parts map[string]string
}

func NewComputer() Computer {
    return Computer{parts: make(map[string]string)}
}

func (c *Computer) ShowParts() {
    fmt.Println("Computer Configuration:")
    for key, value := range c.parts {
        fmt.Printf("%s: %s\n", key, value)
    }
}

// Director class guides the building process.
type Director struct{}

func (d *Director) BuildGamingComputer(builder ComputerBuilder) Computer {
    return builder.SetCPU("Intel i9").
        SetRAM("32GB").
        SetStorage("1TB SSD").
        SetGraphicsCard("NVIDIA RTX 3090").
        GetComputer()
}

func (d *Director) BuildOfficeComputer(builder ComputerBuilder) Computer {
    return builder.SetCPU("Intel i5").
        SetRAM("16GB").
        SetStorage("500GB SSD").
        SetGraphicsCard("Integrated GPU").
        GetComputer()
}

// Client code.
func main() {
    director := &Director{}
    gamingBuilder := &GamingComputerBuilder{computer: NewComputer()}
    officeBuilder := &OfficeComputerBuilder{computer: NewComputer()}

    fmt.Println("Building Gaming Computer:")
    gamingComputer := director.BuildGamingComputer(gamingBuilder)
    gamingComputer.ShowParts()

    fmt.Println("\nBuilding Office Computer:")
    officeComputer := director.BuildOfficeComputer(officeBuilder)
    officeComputer.ShowParts()
}
