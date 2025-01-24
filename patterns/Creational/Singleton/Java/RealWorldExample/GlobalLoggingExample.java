package patterns.Creational.Singleton.Java.RealWorldExample;

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Global Logging Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern, applied to a 
| logging system. It ensures that only one instance of the Logger class 
| is used throughout the application, providing a global access point 
| for logging.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method to ensure 
|    only one instance of the Logger class is created.
| 2. **Logger Class**: Provides the logging functionality and ensures 
|    that the log file is managed by a single instance.
| 3. **Config Class**: Demonstrates another application of the Singleton 
|    pattern, storing application configuration settings globally.
|
| Use Case:
| Use the Singleton pattern when you need a single, global point of access 
| to an object, such as logging or configuration management, ensuring that 
| only one instance exists to manage resources like file handles or 
| settings.
*/

import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.text.SimpleDateFormat;
import java.util.Date;
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
 * The Logger class is the most known and praised use of the Singleton pattern.
 * In most cases, you need a single logging object that writes to a single log
 * file (control over shared resource). You also need a convenient way to access
 * that instance from any context of your app (global access point).
 */
class Logger extends Singleton {
    /**
     * A PrintWriter object to write logs to a file.
     */
    private PrintWriter fileHandle;

    /**
     * Since the Singleton's constructor is called only once, just a single file
     * resource is opened at all times.
     */
    protected Logger() {
        try {
            // Open a file for logging (or use System.out for console logging)
            this.fileHandle = new PrintWriter(new FileWriter("application.log", true), true);
        } catch (IOException e) {
            throw new RuntimeException("Failed to open log file.", e);
        }
    }

    /**
     * Write a log entry to the opened file resource.
     */
    public void writeLog(String message) {
        String date = new SimpleDateFormat("yyyy-MM-dd").format(new Date());
        fileHandle.println(date + ": " + message);
    }

    /**
     * Just a handy shortcut to reduce the amount of code needed to log messages
     * from the client code.
     */
    public static void log(String message) {
        Logger logger = Singleton.getInstance(Logger.class);
        logger.writeLog(message);
    }
}

/**
 * Applying the Singleton pattern to the configuration storage is also a common
 * practice. Often you need to access application configurations from a lot of
 * different places of the program. Singleton gives you that comfort.
 */
class Config extends Singleton {
    private Map<String, String> hashmap = new HashMap<>();

    public String getValue(String key) {
        return hashmap.get(key);
    }

    public void setValue(String key, String value) {
        hashmap.put(key, value);
    }
}

/**
 * The client code.
 */
public class GlobalLoggingExample {
    public static void main(String[] args) {
        // Log the start of the application
        Logger.log("Started!");

        // Compare values of Logger singleton
        Logger l1 = Singleton.getInstance(Logger.class);
        Logger l2 = Singleton.getInstance(Logger.class);
        if (l1 == l2) {
            Logger.log("Logger has a single instance.");
        } else {
            Logger.log("Loggers are different.");
        }

        // Check how Config singleton saves data...
        Config config1 = Singleton.getInstance(Config.class);
        String login = "test_login";
        String password = "test_password";
        config1.setValue("login", login);
        config1.setValue("password", password);

        // ...and restores it.
        Config config2 = Singleton.getInstance(Config.class);
        if (login.equals(config2.getValue("login")) &&
            password.equals(config2.getValue("password"))) {
            Logger.log("Config singleton also works fine.");
        }

        // Log the end of the application
        Logger.log("Finished!");
    }
}