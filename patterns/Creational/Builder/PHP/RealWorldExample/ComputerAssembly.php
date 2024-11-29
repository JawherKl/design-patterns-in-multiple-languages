<?php

/*
|--------------------------------------------------------------------------
| Builder Design Pattern - Computer Assembly
|--------------------------------------------------------------------------
| This example demonstrates the Builder Design Pattern for assembling
| different types of computers with varying configurations (Gaming, Office).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Builder/RealWorldExample
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Builder\RealWorldExample;

/**
 * The Builder interface declares the product building steps that are common
 * for all types of builders.
 */
interface ComputerBuilder
{
    public function setCPU(string $cpu): ComputerBuilder;
    public function setRAM(string $ram): ComputerBuilder;
    public function setStorage(string $storage): ComputerBuilder;
    public function setGraphicsCard(string $gpu): ComputerBuilder;
    public function getComputer(): Computer;
}

/**
 * The Concrete Builder class for assembling a Gaming Computer.
 */
class GamingComputerBuilder implements ComputerBuilder
{
    protected $computer;

    public function __construct()
    {
        $this->computer = new Computer();
    }

    public function setCPU(string $cpu): ComputerBuilder
    {
        $this->computer->setPart('CPU', $cpu);
        return $this;
    }

    public function setRAM(string $ram): ComputerBuilder
    {
        $this->computer->setPart('RAM', $ram);
        return $this;
    }

    public function setStorage(string $storage): ComputerBuilder
    {
        $this->computer->setPart('Storage', $storage);
        return $this;
    }

    public function setGraphicsCard(string $gpu): ComputerBuilder
    {
        $this->computer->setPart('GraphicsCard', $gpu);
        return $this;
    }

    public function getComputer(): Computer
    {
        return $this->computer;
    }
}

/**
 * The Concrete Builder class for assembling an Office Computer.
 */
class OfficeComputerBuilder implements ComputerBuilder
{
    protected $computer;

    public function __construct()
    {
        $this->computer = new Computer();
    }

    public function setCPU(string $cpu): ComputerBuilder
    {
        $this->computer->setPart('CPU', $cpu);
        return $this;
    }

    public function setRAM(string $ram): ComputerBuilder
    {
        $this->computer->setPart('RAM', $ram);
        return $this;
    }

    public function setStorage(string $storage): ComputerBuilder
    {
        $this->computer->setPart('Storage', $storage);
        return $this;
    }

    public function setGraphicsCard(string $gpu): ComputerBuilder
    {
        $this->computer->setPart('GraphicsCard', 'Integrated GPU'); // Office computers don't need high-end GPUs
        return $this;
    }

    public function getComputer(): Computer
    {
        return $this->computer;
    }
}

/**
 * The product class representing a Computer.
 */
class Computer
{
    private $parts = [];

    public function setPart(string $key, string $value): void
    {
        $this->parts[$key] = $value;
    }

    public function showParts(): void
    {
        echo "Computer Configuration: \n";
        foreach ($this->parts as $key => $value) {
            echo "$key: $value\n";
        }
    }
}

/**
 * The Director class guides the building process.
 */
class Director
{
    public function buildGamingComputer(ComputerBuilder $builder): Computer
    {
        return $builder
            ->setCPU('Intel i9')
            ->setRAM('32GB')
            ->setStorage('1TB SSD')
            ->setGraphicsCard('NVIDIA RTX 3090')
            ->getComputer();
    }

    public function buildOfficeComputer(ComputerBuilder $builder): Computer
    {
        return $builder
            ->setCPU('Intel i5')
            ->setRAM('16GB')
            ->setStorage('500GB SSD')
            ->setGraphicsCard('Integrated GPU')
            ->getComputer();
    }
}

/**
 * Client code.
 */
function clientCode(Director $director)
{
    $gamingBuilder = new GamingComputerBuilder();
    $officeBuilder = new OfficeComputerBuilder();

    echo "Building Gaming Computer:\n";
    $gamingComputer = $director->buildGamingComputer($gamingBuilder);
    $gamingComputer->showParts();

    echo "\nBuilding Office Computer:\n";
    $officeComputer = $director->buildOfficeComputer($officeBuilder);
    $officeComputer->showParts();
}

// Testing the Builder Design Pattern
$director = new Director();

echo "Testing Builder Pattern:\n\n";
clientCode($director);

