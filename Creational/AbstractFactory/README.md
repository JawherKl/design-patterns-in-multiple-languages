Abstract Factory is a creational design pattern, which solves the problem of creating entire product families without specifying their concrete classes.

# Conceptual Example:
This example illustrates the structure of the Abstract Factory design pattern. It focuses on answering these questions:

* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.


# Real World Example:
## Web Template:
In this example, the Abstract Factory pattern provides an infrastructure for creating various types of templates for different elements of a web page.

A web application can support different rendering engines at the same time, but only if its classes are independent of the concrete classes of rendering engines. Hence, the application’s objects must communicate with template objects only via their abstract interfaces. Your code shouldn’t create the template objects directly, but delegate their creation to special factory objects. Finally, your code shouldn’t depend on the factory objects either but, instead, should work with them via the abstract factory interface.
