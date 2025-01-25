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
| @link      https://github.com/JawherKl/design-patterns-in-go
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Prototype Struct**: Implements the `Clone` method for deep cloning.
| 2. **ComponentWithBackReference**: Demonstrates cloning complex objects with
|    back references to the original Prototype instance.
| 3. **Client Code**: Shows how cloning works and validates deep vs shallow 
|    copies.
|
| Use Case:
| Use the Prototype pattern when object creation is expensive or when an 
| object’s state is complex and you'd like to avoid recomputing or reconstructing it.
*/

package main

import (
    "fmt"
    "time"
)

// Prototype is the example struct that has cloning ability.
// We'll see how the values of fields with different types will be cloned.
type Prototype struct {
    Primitive         int
    Component         time.Time
    CircularReference *ComponentWithBackReference
}

// Clone provides a deep copy of the Prototype struct.
func (p *Prototype) Clone() *Prototype {
    clone := *p
    clone.Component = p.Component

    // Cloning an object that has a nested object with backreference
    // requires special treatment. After the cloning is completed, the
    // nested object should point to the cloned object, instead of the
    // original object.
    clone.CircularReference = &ComponentWithBackReference{Prototype: &clone}
    return &clone
}

// ComponentWithBackReference demonstrates cloning complex objects with
// back references to the original Prototype instance.
type ComponentWithBackReference struct {
    Prototype *Prototype
}

// Client code demonstrating the Prototype Design Pattern.
func clientCode() {
    p1 := &Prototype{
        Primitive: 245,
        Component: time.Now(),
        CircularReference: &ComponentWithBackReference{
            Prototype: &Prototype{},
        },
    }

    p2 := p1.Clone()

    if p1.Primitive == p2.Primitive {
        fmt.Println("Primitive field values have been carried over to a clone. Yay!")
    } else {
        fmt.Println("Primitive field values have not been copied. Booo!")
    }

    if p1.Component == p2.Component {
        fmt.Println("Simple component has not been cloned. Booo!")
    } else {
        fmt.Println("Simple component has been cloned. Yay!")
    }

    if p1.CircularReference == p2.CircularReference {
        fmt.Println("Component with back reference has not been cloned. Booo!")
    } else {
        fmt.Println("Component with back reference has been cloned. Yay!")
    }

    if p1.CircularReference.Prototype == p2.CircularReference.Prototype {
        fmt.Println("Component with back reference is linked to original object. Booo!")
    } else {
        fmt.Println("Component with back reference is linked to the clone. Yay!")
    }
}

func main() {
    clientCode()
}
