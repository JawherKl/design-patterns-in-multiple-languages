package patterns.Creational.Singleton.Java.RealWorldExample;

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

import java.util.HashMap;
import java.util.Map;

/**
 * The Singleton class defines the `getInstance` method that serves as an
 * alternative to constructor and lets clients access the same instance of this
 * class over and over.
 */
class Singleton {
    /**
     * The Singleton's instance is stored in a static field. This field is a
     * map because we'll allow our Singleton to have subclasses. Each key in
     * this map will be the class name, and the value will be an instance of
     * that specific Singleton subclass.
     */
    private static Map<String, Singleton> instances = new HashMap<>();

    /**
     * The Singleton's constructor should always be protected to prevent direct
     * construction calls with the `new` operator, while still allowing subclassing.
     */
    protected Singleton() { }

    /**
     * Singletons should not be cloneable.
     */
    @Override
    protected Object clone() throws CloneNotSupportedException {
        throw new CloneNotSupportedException("Cannot clone a singleton.");
    }

    /**
     * Singletons should not be restorable from serialization.
     */
    protected Object readResolve() {
        throw new UnsupportedOperationException("Cannot deserialize a singleton.");
    }

    /**
     * This is the static method that controls the access to the singleton
     * instance. On the first run, it creates a singleton object and places it
     * into the static map. On subsequent runs, it returns the existing
     * object stored in the map.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static <T extends Singleton> T getInstance(Class<T> cls) {
        String clsName = cls.getName();
        if (!instances.containsKey(clsName)) {
            try {
                instances.put(clsName, cls.getDeclaredConstructor().newInstance());
            } catch (Exception e) {
                throw new RuntimeException("Failed to create singleton instance.", e);
            }
        }
        return cls.cast(instances.get(clsName));
    }
}

/**
 * Application Settings Singleton
 */
class AppSettings extends Singleton {
    private Map<String, Object> settings;

    /**
     * Protected constructor to initialize default settings.
     */
    protected AppSettings() {
        settings = new HashMap<>();
        // Load default settings
        settings.put("appName", "My Application");
        settings.put("version", "1.0.0");
    }

    /**
     * Get a setting by key.
     */
    public Object getSetting(String key) {
        return settings.get(key);
    }

    /**
     * Set a setting by key and value.
     */
    public void setSetting(String key, Object value) {
        settings.put(key, value);
    }
}

/**
 * The client code.
 */
public class ApplicationSettingsExample {
    public static void main(String[] args) {
        // Get the singleton instance of AppSettings
        AppSettings appSettings = Singleton.getInstance(AppSettings.class);

        // Access and print default settings
        System.out.println("App Name: " + appSettings.getSetting("appName"));

        // Update and print a setting
        appSettings.setSetting("version", "1.0.1");
        System.out.println("Updated Version: " + appSettings.getSetting("version"));
    }
}