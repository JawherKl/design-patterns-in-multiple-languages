<?php

namespace patterns\Behavioral\Command\PHP\RealWorldExample;

/**
 * Command Interface
 */
interface Command
{
    public function execute(): void;
    public function undo(): void;
}

/**
 * Receiver: Smart Light
 */
class Light
{
    public function turnOn(): void
    {
        echo "Light: Turned on\n";
    }

    public function turnOff(): void
    {
        echo "Light: Turned off\n";
    }
}

/**
 * Receiver: Thermostat
 */
class Thermostat
{
    public function setTemperature(int $temperature): void
    {
        echo "Thermostat: Set temperature to {$temperature}°C\n";
    }

    public function reset(): void
    {
        echo "Thermostat: Reset to default temperature\n";
    }
}

/**
 * Receiver: Security System
 */
class SecuritySystem
{
    public function activate(): void
    {
        echo "SecuritySystem: Activated\n";
    }

    public function deactivate(): void
    {
        echo "SecuritySystem: Deactivated\n";
    }
}

/**
 * Concrete Command: Light On Command
 */
class LightOnCommand implements Command
{
    private $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->turnOn();
    }

    public function undo(): void
    {
        $this->light->turnOff();
    }
}

/**
 * Concrete Command: Thermostat Set Command
 */
class ThermostatSetCommand implements Command
{
    private $thermostat;
    private $temperature;

    public function __construct(Thermostat $thermostat, int $temperature)
    {
        $this->thermostat = $thermostat;
        $this->temperature = $temperature;
    }

    public function execute(): void
    {
        $this->thermostat->setTemperature($this->temperature);
    }

    public function undo(): void
    {
        $this->thermostat->reset();
    }
}

/**
 * Concrete Command: Security System Activate Command
 */
class SecuritySystemActivateCommand implements Command
{
    private $securitySystem;

    public function __construct(SecuritySystem $securitySystem)
    {
        $this->securitySystem = $securitySystem;
    }

    public function execute(): void
    {
        $this->securitySystem->activate();
    }

    public function undo(): void
    {
        $this->securitySystem->deactivate();
    }
}

/**
 * Invoker: Home Automation Controller
 */
class HomeAutomationController
{
    private $commandHistory = [];

    public function executeCommand(Command $command): void
    {
        $command->execute();
        $this->commandHistory[] = $command;
    }

    public function undoLastCommand(): void
    {
        if (count($this->commandHistory) > 0) {
            $command = array_pop($this->commandHistory);
            $command->undo();
        }
    }
}

// Client Code
$light = new Light();
$thermostat = new Thermostat();
$securitySystem = new SecuritySystem();

$lightOn = new LightOnCommand($light);
$thermostatSet = new ThermostatSetCommand($thermostat, 22);
$securityActivate = new SecuritySystemActivateCommand($securitySystem);

$controller = new HomeAutomationController();

// Execute commands
$controller->executeCommand($lightOn); // Turn on the light
$controller->executeCommand($thermostatSet); // Set thermostat to 22°C
$controller->executeCommand($securityActivate); // Activate security system

echo "\n--- Undo Last Command ---\n";

// Undo the last command (deactivate security system)
$controller->undoLastCommand();

echo "\n--- Undo Another Command ---\n";

// Undo the second last command (reset thermostat)
$controller->undoLastCommand();

echo "\n--- Undo Last Command ---\n";

// Undo the last command (turn off the light)
$controller->undoLastCommand();
