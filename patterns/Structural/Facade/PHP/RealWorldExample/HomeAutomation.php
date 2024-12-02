<?php

/*
|--------------------------------------------------------------------------
| Facade Design Pattern - Home Automation Example
|--------------------------------------------------------------------------
| This example demonstrates controlling a complex home automation system 
| through a simple interface using the Facade pattern.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Facade
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace HomeAutomation;

/**
 * Facade class providing a simplified interface to control the home automation system.
 */
class SmartHomeFacade
{
    protected $lights;
    protected $thermostat;
    protected $securitySystem;

    public function __construct()
    {
        $this->lights = new SmartLights();
        $this->thermostat = new Thermostat();
        $this->securitySystem = new SecuritySystem();
    }

    public function startMorningRoutine(): void
    {
        echo "Starting morning routine...\n";
        $this->lights->turnOn();
        $this->thermostat->setTemperature(22);
        $this->securitySystem->deactivate();
        echo "Morning routine complete!\n";
    }

    public function startNightRoutine(): void
    {
        echo "Starting night routine...\n";
        $this->lights->dim();
        $this->thermostat->setTemperature(18);
        $this->securitySystem->activate();
        echo "Night routine complete!\n";
    }
}

/**
 * Subsystem class for controlling the lights.
 */
class SmartLights
{
    public function turnOn(): void
    {
        echo "Turning on the lights...\n";
    }

    public function dim(): void
    {
        echo "Dimming the lights...\n";
    }
}

/**
 * Subsystem class for controlling the thermostat.
 */
class Thermostat
{
    public function setTemperature(int $temperature): void
    {
        echo "Setting temperature to $temperature °C...\n";
    }
}

/**
 * Subsystem class for managing the security system.
 */
class SecuritySystem
{
    public function activate(): void
    {
        echo "Activating the security system...\n";
    }

    public function deactivate(): void
    {
        echo "Deactivating the security system...\n";
    }
}

/**
 * Client code using the Facade to control the smart home system.
 */
function clientCode(SmartHomeFacade $facade)
{
    echo "\n--- Morning Routine ---\n";
    $facade->startMorningRoutine();

    echo "\n--- Night Routine ---\n";
    $facade->startNightRoutine();
}

$facade = new SmartHomeFacade();
clientCode($facade);
