Prototype is a creational design pattern that lets you copy existing objects without making your code dependent on their classes.

# Conceptual Example:
This example illustrates the structure of the Prototype design pattern and focuses on the following questions:

* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.


# Real World Example:
## Complex Page:
The Prototype pattern provides a convenient way of replicating existing objects instead of trying to reconstruct the objects by copying all of their fields directly. The direct approach not only couples you to the classes of the objects being cloned, but also doesn’t allow you to copy the contents of the private fields. The Prototype pattern lets you perform the cloning within the context of the cloned class, where the access to the class’ private fields isn’t restricted.

This example shows you how to clone a complex Page object using the Prototype pattern. The Page class has lots of private fields, which will be carried over to the cloned object thanks to the Prototype pattern.

## Document
### Explanation:
* Purpose: The Prototype Design Pattern allows creating new objects by cloning existing ones rather than instantiating them from scratch. This can save time, especially when object creation is complex.

* Classes:
    * Prototype Interface: Defines a __clone() method that must be implemented by concrete prototypes.
    * Document: A concrete implementation of the prototype, where we specify which fields to carry over or modify during cloning.
    * Author: Contains a reference to multiple documents, shared across cloned documents.

Client Code: It demonstrates creating a document and then cloning it. The cloned document has its title updated but retains a reference to the same author.

## Shape
### Explanation:
* Purpose: This example demonstrates how to clone shapes (like circles and rectangles) using the Prototype Design Pattern. Each shape can be duplicated without the need for recalculating or recreating it from scratch.

* Classes:

    * ShapePrototype: The interface that declares the __clone() method for all shapes.
    * Shape: An abstract class that implements basic shape behavior, including color handling.
    * Circle: A concrete shape that holds a radius and implements the __clone() method.
    * Rectangle: A concrete shape with width and height, also supporting cloning.
* Client Code: It creates and clones a circle and a rectangle, altering properties (e.g., color) in the cloned versions while keeping the originals intact.

This pattern is useful when you have expensive or complex initialization processes that you want to avoid by simply copying existing objects.