// Builder Design Pattern - Computer Assembly
//
// This example demonstrates the Builder Design Pattern for assembling
// different types of computers with varying configurations (Gaming, Office).

// ComputerBuilder interface declares the product building steps that are common
// for all types of builders.
class ComputerBuilder {
    setCPU(cpu) {}
    setRAM(ram) {}
    setStorage(storage) {}
    setGraphicsCard(gpu) {}
    getComputer() {}
}

// Concrete Builder for assembling a Gaming Computer.
class GamingComputerBuilder extends ComputerBuilder {
    constructor() {
        super();
        this.computer = new Computer();
    }

    setCPU(cpu) {
        this.computer.parts['CPU'] = cpu;
        return this;
    }

    setRAM(ram) {
        this.computer.parts['RAM'] = ram;
        return this;
    }

    setStorage(storage) {
        this.computer.parts['Storage'] = storage;
        return this;
    }

    setGraphicsCard(gpu) {
        this.computer.parts['GraphicsCard'] = gpu;
        return this;
    }

    getComputer() {
        return this.computer;
    }
}

// Concrete Builder for assembling an Office Computer.
class OfficeComputerBuilder extends ComputerBuilder {
    constructor() {
        super();
        this.computer = new Computer();
    }

    setCPU(cpu) {
        this.computer.parts['CPU'] = cpu;
        return this;
    }

    setRAM(ram) {
        this.computer.parts['RAM'] = ram;
        return this;
    }

    setStorage(storage) {
        this.computer.parts['Storage'] = storage;
        return this;
    }

    setGraphicsCard(gpu) {
        this.computer.parts['GraphicsCard'] = 'Integrated GPU'; // Office computers don't need high-end GPUs
        return this;
    }

    getComputer() {
        return this.computer;
    }
}

// Product class representing a Computer.
class Computer {
    constructor() {
        this.parts = {};
    }

    showParts() {
        console.log('Computer Configuration:');
        for (const [key, value] of Object.entries(this.parts)) {
            console.log(`${key}: ${value}`);
        }
    }
}

// Director class guides the building process.
class Director {
    buildGamingComputer(builder) {
        return builder.setCPU('Intel i9')
            .setRAM('32GB')
            .setStorage('1TB SSD')
            .setGraphicsCard('NVIDIA RTX 3090')
            .getComputer();
    }

    buildOfficeComputer(builder) {
        return builder.setCPU('Intel i5')
            .setRAM('16GB')
            .setStorage('500GB SSD')
            .setGraphicsCard('Integrated GPU')
            .getComputer();
    }
}

// Client code.
function clientCode(director) {
    const gamingBuilder = new GamingComputerBuilder();
    const officeBuilder = new OfficeComputerBuilder();

    console.log('Building Gaming Computer:');
    const gamingComputer = director.buildGamingComputer(gamingBuilder);
    gamingComputer.showParts();

    console.log('\nBuilding Office Computer:');
    const officeComputer = director.buildOfficeComputer(officeBuilder);
    officeComputer.showParts();
}

// Testing the Builder Design Pattern
const director = new Director();

console.log('Testing Builder Pattern:\n');
clientCode(director);
