Prototype is a creational design pattern that lets you copy existing objects without making your code dependent on their classes.

# Conceptual Example:
This example illustrates the structure of the Prototype design pattern and focuses on the following questions:

* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.


# Real World Example:
## Social Network:
The Prototype pattern provides a convenient way of replicating existing objects instead of trying to reconstruct the objects by copying all of their fields directly. The direct approach not only couples you to the classes of the objects being cloned, but also doesn’t allow you to copy the contents of the private fields. The Prototype pattern lets you perform the cloning within the context of the cloned class, where the access to the class’ private fields isn’t restricted.

This example shows you how to clone a complex Page object using the Prototype pattern. The Page class has lots of private fields, which will be carried over to the cloned object thanks to the Prototype pattern.