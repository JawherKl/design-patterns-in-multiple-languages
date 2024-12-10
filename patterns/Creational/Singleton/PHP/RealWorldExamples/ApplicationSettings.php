<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Application Settings Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing 
| application settings, ensuring that only one instance of the settings 
| is created and accessed globally.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method to manage 
|    the single instance of the settings.
| 2. **Static Instance Storage**: Ensures only one instance of the class 
|    is created.
| 3. **Client Code**: Demonstrates accessing and modifying the singleton 
|    instance to manage application settings.
|
| Use Case:
| Use the Singleton pattern to manage a global instance that holds 
| application-wide settings, ensuring that all parts of the application 
| work with the same configuration.
*/

namespace Creational\Singleton\RealWorldExamples;

use Creational\Singleton\PHP\Singleton;

/**
 * Application Settings Singleton
 */
class AppSettings extends Singleton
{
    private $settings = [];

    protected function __construct()
    {
        // Load default settings
        $this->settings = [
            'appName' => 'My Application',
            'version' => '1.0.0',
        ];
    }

    public function getSetting(string $key)
    {
        return $this->settings[$key] ?? null;
    }

    public function setSetting(string $key, $value): void
    {
        $this->settings[$key] = $value;
    }
}

// Client code
$appSettings = AppSettings::getInstance();
echo "App Name: " . $appSettings->getSetting('appName') . "\n";

$appSettings->setSetting('version', '1.0.1');
echo "Updated Version: " . $appSettings->getSetting('version') . "\n";
