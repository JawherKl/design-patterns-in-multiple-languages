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
| @link      https://github.com/JawherKl/design-patterns-in-js
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

class AppSettings {
    static instance;

    constructor() {
        if (AppSettings.instance) {
            throw new Error("AppSettings is a singleton and cannot be instantiated directly.");
        }
        // Initialize default settings
        this.settings = {
            appName: "My Application",
            version: "1.0.0"
        };
        AppSettings.instance = this;
    }

    // Accessor for the singleton instance
    static getInstance() {
        if (!AppSettings.instance) {
            new AppSettings(); // Initialize the instance
        }
        return AppSettings.instance;
    }

    // Get setting by key
    getSetting(key) {
        return this.settings[key] || null;
    }

    // Set setting by key
    setSetting(key, value) {
        this.settings[key] = value;
    }
}

// Client code
const appSettings = AppSettings.getInstance();
console.log("App Name: " + appSettings.getSetting("appName"));

appSettings.setSetting("version", "1.0.1");
console.log("Updated Version: " + appSettings.getSetting("version"));
