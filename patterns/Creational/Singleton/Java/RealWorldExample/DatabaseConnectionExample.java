package patterns.Creational.Singleton.Java.RealWorldExample;

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Database Connection Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing a 
| database connection, ensuring that only one instance of the connection 
| is created and used throughout the application.
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
|    only one instance of the database connection is created.
| 2. **Static Instance Storage**: Ensures that the same instance of the 
|    database connection is used throughout the application.
| 3. **Client Code**: Demonstrates using the Singleton to retrieve the 
|    database connection, ensuring that only one connection instance exists.
|
| Use Case:
| Use the Singleton pattern to manage a global database connection in an 
| application, ensuring that all parts of the application use the same 
| connection instance, optimizing resource management.
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
 * Database Connection Singleton
 */
class DatabaseConnection extends Singleton {
    private String connection;

    /**
     * Protected constructor to simulate a database connection.
     */
    protected DatabaseConnection() {
        this.connection = "Database Connection Established";
    }

    /**
     * Get the database connection.
     */
    public String getConnection() {
        return this.connection;
    }
}

/**
 * The client code.
 */
public class DatabaseConnectionExample {
    public static void main(String[] args) {
        // Get the singleton instance of DatabaseConnection
        DatabaseConnection db1 = Singleton.getInstance(DatabaseConnection.class);
        System.out.println(db1.getConnection());

        // Verify that only one instance exists
        DatabaseConnection db2 = Singleton.getInstance(DatabaseConnection.class);
        if (db1 == db2) {
            System.out.println("Only one instance of DatabaseConnection exists.");
        }
    }
}