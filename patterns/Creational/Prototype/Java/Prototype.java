package patterns.Creational.Prototype.Java;

/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Prototype Design Pattern, which allows 
| copying objects without depending on their classes, instead relying on a 
| cloning interface.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational.Prototype
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-java
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Prototype Class**: Implements the `clone()` method for deep cloning.
| 2. **ComponentWithBackReference**: Demonstrates cloning complex objects with
|    back references to the original Prototype instance.
| 3. **Client Code**: Shows how cloning works and validates deep vs shallow 
|    copies.
|
| Use Case:
| Use the Prototype pattern when object creation is expensive or when an 
| object’s state is complex and you'd like to avoid recomputing or reconstructing it.
*/

import java.util.Date;

/**
 * The example class that has cloning ability. We'll see how the values of field
 * with different types will be cloned.
 */
class Prototype implements Cloneable {
    public int primitive;
    public Date component;
    public ComponentWithBackReference circularReference;

    /**
     * Java has built-in cloning support. You can `clone` an object without
     * defining any special methods as long as it has fields of primitive types.
     * Fields containing objects retain their references in a cloned object.
     * Therefore, in some cases, you might want to clone those referenced
     * objects as well. You can do this in a special `clone()` method.
     */
    @Override
    protected Object clone() throws CloneNotSupportedException {
        Prototype clone = (Prototype) super.clone();
        clone.component = (Date) component.clone();

        // Cloning an object that has a nested object with backreference
        // requires special treatment. After the cloning is completed, the
        // nested object should point to the cloned object, instead of the
        // original object.
        clone.circularReference = (ComponentWithBackReference) circularReference.clone();
        clone.circularReference.prototype = clone;
        return clone;
    }
}

class ComponentWithBackReference implements Cloneable {
    public Prototype prototype;

    /**
     * Note that the constructor won't be executed during cloning. If you have
     * complex logic inside the constructor, you may need to execute it in the
     * `clone` method as well.
     */
    public ComponentWithBackReference(Prototype prototype) {
        this.prototype = prototype;
    }

    @Override
    protected Object clone() throws CloneNotSupportedException {
        return super.clone();
    }
}

/**
 * The client code.
 */
public class Main {
    public static void main(String[] args) {
        try {
            Prototype p1 = new Prototype();
            p1.primitive = 245;
            p1.component = new Date();
            p1.circularReference = new ComponentWithBackReference(p1);

            Prototype p2 = (Prototype) p1.clone();
            if (p1.primitive == p2.primitive) {
                System.out.println("Primitive field values have been carried over to a clone. Yay!");
            } else {
                System.out.println("Primitive field values have not been copied. Booo!");
            }
            if (p1.component == p2.component) {
                System.out.println("Simple component has not been cloned. Booo!");
            } else {
                System.out.println("Simple component has been cloned. Yay!");
            }

            if (p1.circularReference == p2.circularReference) {
                System.out.println("Component with back reference has not been cloned. Booo!");
            } else {
                System.out.println("Component with back reference has been cloned. Yay!");
            }

            if (p1.circularReference.prototype == p2.circularReference.prototype) {
                System.out.println("Component with back reference is linked to original object. Booo!");
            } else {
                System.out.println("Component with back reference is linked to the clone. Yay!");
            }

        } catch (CloneNotSupportedException e) {
            e.printStackTrace();
        }
    }
}
