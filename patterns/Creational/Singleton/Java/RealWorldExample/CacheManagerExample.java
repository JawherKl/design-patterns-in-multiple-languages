package patterns.Creational.Singleton.Java.RealWorldExample;

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Cache Manager Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing a 
| cache system, ensuring that only one instance of the cache manager 
| exists and is used throughout the application.
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
|    the single instance of the cache manager.
| 2. **Static Instance Storage**: Ensures only one instance of the cache 
|    manager is created.
| 3. **Client Code**: Demonstrates caching data using the singleton cache 
|    manager instance.
|
| Use Case:
| Use the Singleton pattern to manage a global cache system, ensuring that 
| all parts of the application access and modify the cache through the 
| same instance, optimizing memory and performance.
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
 * Cache Manager Singleton
 */
class CacheManager extends Singleton {
    private Map<String, Object> cache;

    /**
     * Protected constructor to initialize the cache.
     */
    protected CacheManager() {
        cache = new HashMap<>();
    }

    /**
     * Add or update a value in the cache.
     */
    public void set(String key, Object value) {
        cache.put(key, value);
    }

    /**
     * Retrieve a value from the cache.
     */
    public Object get(String key) {
        return cache.get(key);
    }
}

/**
 * The client code.
 */
public class CacheManagerExample {
    public static void main(String[] args) {
        // Get the singleton instance of CacheManager
        CacheManager cache = Singleton.getInstance(CacheManager.class);

        // Cache user data
        Map<String, String> user = new HashMap<>();
        user.put("name", "John Doe");
        user.put("email", "john@example.com");
        cache.set("user_1", user);

        // Retrieve and print cached user data
        Map<String, String> cachedUser = (Map<String, String>) cache.get("user_1");
        System.out.println("Cached User: " + cachedUser);
    }
}