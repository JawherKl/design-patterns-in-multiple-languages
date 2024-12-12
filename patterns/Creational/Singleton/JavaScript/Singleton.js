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
| @link      https://github.com/JawherKl/design-patterns-in-js
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

class Singleton {
    // Static field to store the instance of the Singleton
    static instances = {};

    // Private constructor to prevent direct instantiation
    constructor() {
        if (Singleton.instances[this.constructor.name]) {
            throw new Error("Cannot instantiate Singleton class directly.");
        }
    }

    // Static method to get the instance of the Singleton
    static getInstance() {
        const className = this.name;

        if (!Singleton.instances[className]) {
            Singleton.instances[className] = new this();
        }

        return Singleton.instances[className];
    }

    // Singleton class business logic can be implemented here
    someBusinessLogic() {
        // ...
    }
}

// Client code
function clientCode() {
    const s1 = Singleton.getInstance();
    const s2 = Singleton.getInstance();

    if (s1 === s2) {
        console.log("Singleton works, both variables contain the same instance.");
    } else {
        console.log("Singleton failed, variables contain different instances.");
    }
}

clientCode();
