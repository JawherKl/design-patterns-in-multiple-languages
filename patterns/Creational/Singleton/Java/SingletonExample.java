package patterns.Creational.Singleton.Java;

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern, which ensures a 
| class has only one instance and provides a global point of access to it.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method for managing 
|    the single instance.
| 2. **Static Instance Storage**: Ensures only one instance per subclass.
| 3. **Client Code**: Demonstrates that the same instance is returned.
|
| Use Case:
| Use the Singleton pattern when only one instance of a class should exist, 
| such as in managing database connections or configuration settings.
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
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
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
    public static Singleton getInstance() {
        String clsName = Singleton.class.getName();
        if (!instances.containsKey(clsName)) {
            instances.put(clsName, new Singleton());
        }
        return instances.get(clsName);
    }

    /**
     * Finally, any singleton should define some business logic, which can be
     * executed on its instance.
     */
    public void someBusinessLogic() {
        // Business logic goes here...
    }
}

/**
 * The client code.
 */
public class SingletonExample {
    public static void clientCode() {
        Singleton s1 = Singleton.getInstance();
        Singleton s2 = Singleton.getInstance();
        if (s1 == s2) {
            System.out.println("Singleton works, both variables contain the same instance.");
        } else {
            System.out.println("Singleton failed, variables contain different instances.");
        }
    }

    public static void main(String[] args) {
        clientCode();
    }
}
