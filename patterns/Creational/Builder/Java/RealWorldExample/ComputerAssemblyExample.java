package patterns.Creational.Builder.Java.RealWorldExample;

import java.util.HashMap;
import java.util.Map;

// Builder Design Pattern - Computer Assembly
//
// This example demonstrates the Builder Design Pattern for assembling
// different types of computers with varying configurations (Gaming, Office).

// The Builder interface declares the product-building steps that are common
// for all types of builders.
interface ComputerBuilder {
    ComputerBuilder setCPU(String cpu);
    ComputerBuilder setRAM(String ram);
    ComputerBuilder setStorage(String storage);
    ComputerBuilder setGraphicsCard(String gpu);
    Computer getComputer();
}

// The Concrete Builder class for assembling a Gaming Computer.
class GamingComputerBuilder implements ComputerBuilder {
    private Computer computer;

    public GamingComputerBuilder() {
        this.computer = new Computer();
    }

    @Override
    public ComputerBuilder setCPU(String cpu) {
        computer.setPart("CPU", cpu);
        return this;
    }

    @Override
    public ComputerBuilder setRAM(String ram) {
        computer.setPart("RAM", ram);
        return this;
    }

    @Override
    public ComputerBuilder setStorage(String storage) {
        computer.setPart("Storage", storage);
        return this;
    }

    @Override
    public ComputerBuilder setGraphicsCard(String gpu) {
        computer.setPart("GraphicsCard", gpu);
        return this;
    }

    @Override
    public Computer getComputer() {
        return computer;
    }
}

// The Concrete Builder class for assembling an Office Computer.
class OfficeComputerBuilder implements ComputerBuilder {
    private Computer computer;

    public OfficeComputerBuilder() {
        this.computer = new Computer();
    }

    @Override
    public ComputerBuilder setCPU(String cpu) {
        computer.setPart("CPU", cpu);
        return this;
    }

    @Override
    public ComputerBuilder setRAM(String ram) {
        computer.setPart("RAM", ram);
        return this;
    }

    @Override
    public ComputerBuilder setStorage(String storage) {
        computer.setPart("Storage", storage);
        return this;
    }

    @Override
    public ComputerBuilder setGraphicsCard(String gpu) {
        computer.setPart("GraphicsCard", "Integrated GPU"); // Office computers don't need high-end GPUs
        return this;
    }

    @Override
    public Computer getComputer() {
        return computer;
    }
}

// The product class representing a Computer.
class Computer {
    private Map<String, String> parts = new HashMap<>();

    public void setPart(String key, String value) {
        parts.put(key, value);
    }

    public void showParts() {
        System.out.println("Computer Configuration:");
        parts.forEach((key, value) -> System.out.println(key + ": " + value));
    }
}

// The Director class guides the building process.
class Director {
    public Computer buildGamingComputer(ComputerBuilder builder) {
        return builder.setCPU("Intel i9")
                .setRAM("32GB")
                .setStorage("1TB SSD")
                .setGraphicsCard("NVIDIA RTX 3090")
                .getComputer();
    }

    public Computer buildOfficeComputer(ComputerBuilder builder) {
        return builder.setCPU("Intel i5")
                .setRAM("16GB")
                .setStorage("500GB SSD")
                .setGraphicsCard("Integrated GPU")
                .getComputer();
    }
}

// Client code.
public class ComputerAssemblyExample {
    public static void main(String[] args) {
        Director director = new Director();

        GamingComputerBuilder gamingBuilder = new GamingComputerBuilder();
        OfficeComputerBuilder officeBuilder = new OfficeComputerBuilder();

        System.out.println("Building Gaming Computer:");
        Computer gamingComputer = director.buildGamingComputer(gamingBuilder);
        gamingComputer.showParts();

        System.out.println("\nBuilding Office Computer:");
        Computer officeComputer = director.buildOfficeComputer(officeBuilder);
        officeComputer.showParts();
    }
}
