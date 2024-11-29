<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Application Settings
|--------------------------------------------------------------------------
| Implement Singleton Design Pattern for managing application settings.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Singleton\RealWorldExamples;

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
