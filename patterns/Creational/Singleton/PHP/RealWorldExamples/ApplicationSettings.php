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

/**
 * Application Settings Singleton
 */
class Singleton
{
    /**
     * The actual singleton's instance almost always resides inside a static
     * field. In this case, the static field is an array, where each subclass of
     * the Singleton stores its own instance.
     */
    private static $instances = [];

    /**
     * Singleton's constructor should not be public. However, it can't be
     * private either if we want to allow subclassing.
     */
    protected function __construct() { }

    /**
     * Cloning and unserialization are not permitted for singletons.
     */
    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * The method you use to get the Singleton's instance.
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            // Note that here we use the "static" keyword instead of the actual
            // class name. In this context, the "static" keyword means "the name
            // of the current class". That detail is important because when the
            // method is called on the subclass, we want an instance of that
            // subclass to be created here.

            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }
}
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
