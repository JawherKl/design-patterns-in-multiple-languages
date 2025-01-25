/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Prototype Design Pattern, which allows 
| copying objects without depending on their classes, instead relying on a 
| cloning interface.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-js
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Prototype Class**: Implements the `clone` method for deep cloning.
| 2. **ComponentWithBackReference**: Demonstrates cloning complex objects with
|    back references to the original Prototype instance.
| 3. **Client Code**: Shows how cloning works and validates deep vs shallow 
|    copies.
|
| Use Case:
| Use the Prototype pattern when object creation is expensive or when an 
| object’s state is complex and you'd like to avoid recomputing or reconstructing it.
*/

class Prototype {
    constructor() {
        this.primitive = null;
        this.component = null;
        this.circularReference = null;
    }

    /**
     * JavaScript has built-in cloning support using Object.assign for shallow cloning 
     * and structuredClone for deep cloning. However, for custom deep cloning, you can
     * define a specific `clone` method.
     */
    clone() {
        const clone = Object.create(Object.getPrototypeOf(this));
        clone.primitive = this.primitive;
        clone.component = structuredClone(this.component);

        // Cloning an object that has a nested object with backreference
        // requires special treatment. After the cloning is completed, the
        // nested object should point to the cloned object, instead of the
        // original object.
        clone.circularReference = structuredClone(this.circularReference);
        clone.circularReference.prototype = clone;

        return clone;
    }
}

class ComponentWithBackReference {
    constructor(prototype) {
        this.prototype = prototype;
    }
}

/**
 * The client code.
 */
function clientCode() {
    const p1 = new Prototype();
    p1.primitive = 245;
    p1.component = new Date();
    p1.circularReference = new ComponentWithBackReference(p1);

    const p2 = p1.clone();
    
    if (p1.primitive === p2.primitive) {
        console.log("Primitive field values have been carried over to a clone. Yay!");
    } else {
        console.log("Primitive field values have not been copied. Booo!");
    }

    if (p1.component === p2.component) {
        console.log("Simple component has not been cloned. Booo!");
    } else {
        console.log("Simple component has been cloned. Yay!");
    }

    if (p1.circularReference === p2.circularReference) {
        console.log("Component with back reference has not been cloned. Booo!");
    } else {
        console.log("Component with back reference has been cloned. Yay!");
    }

    if (p1.circularReference.prototype === p2.circularReference.prototype) {
        console.log("Component with back reference is linked to original object. Booo!");
    } else {
        console.log("Component with back reference is linked to the clone. Yay!");
    }
}

clientCode();
