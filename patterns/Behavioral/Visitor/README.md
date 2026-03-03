<table>
  <tr>
    <td align="center">
      <a href="README_fr.md">🇫🇷 Switch to French</a>
    </td>
    <td align="center">
      <a href="README_de.md">🇩🇪 Switch to German</a>
    </td>
  </tr>
</table>

**Visitor** is a behavioral design pattern that lets you add further operations to objects without having to modify them. It separates an algorithm from an object structure on which it operates.

# Conceptual Example:
This example illustrates the structure of the Visitor design pattern. It focuses on answering these questions:
- What classes does it consist of?
- What roles do these classes play?
- In what way the elements of the pattern are related?

After understanding the pattern’s structure it’ll be easier for you to grasp the following example, based on the PHP implementation included in this folder.

# Real World Example:

## VisitorInfra
In this PHP example the Visitor pattern is used to run different operations over the same set of objects (components) without changing their classes.

The implementation is available in [Visitor.php](patterns/Behavioral/Visitor/PHP/Visitor.php).

## Component (Element)
Declares an `accept(Visitor $visitor)` method that takes a visitor and forwards the call to the appropriate visitor method.

## Concrete Components
- `ConcreteComponentA`: Implements `accept()` and exposes an exclusive method `exclusiveMethodOfConcreteComponentA()`.
- `ConcreteComponentB`: Implements `accept()` and exposes `specialMethodOfConcreteComponentB()`.

## Visitor (Operation)
Declares visiting methods for each concrete component type (`visitConcreteComponentA`, `visitConcreteComponentB`).

## Concrete Visitors (Concrete Operations)
- `ConcreteVisitor1`: Implements the visitor operations and processes components in one way.
- `ConcreteVisitor2`: Implements the visitor operations and processes components in another way.

## Client Code
The client iterates over a collection of components and calls `accept()` on each, passing a visitor. The `accept()` method dispatches the call to the visitor method that matches the component's concrete type.

### Explanation:

1. **Component Interface**: Declares `accept(Visitor $visitor)`.
2. **ConcreteComponentA / ConcreteComponentB**: Implement `accept()` and provide class-specific methods used by visitors.
3. **Visitor Interface**: Declares visit methods for each concrete component class.
4. **ConcreteVisitor1 / ConcreteVisitor2**: Implement the visiting logic for each component.
5. **Client Code**: Works with components via the `Component` interface and visitors via the `Visitor` interface.

### Output:

Running the PHP example prints the following to stdout:

```
The client code works with all visitors via the base Visitor interface:
A + ConcreteVisitor1
B + ConcreteVisitor1

It allows the same client code to work with different types of visitors:
A + ConcreteVisitor2
B + ConcreteVisitor2
```

### Files:
- Implementation: [patterns/Behavioral/Visitor/PHP/Visitor.php](patterns/Behavioral/Visitor/PHP/Visitor.php)

If you'd like, I can add quick run instructions or extract key code snippets into this README for easier browsing.
Visitor is a behavioral design pattern that allows adding new behaviors to existing class hierarchy without altering any existing code.


# RealWorldExample
## VistorInfra
In this example, the Visitor pattern helps to introduce a reporting feature into an existing class hierarchy: Company > Department > Employee

Once the Visitor infrastructure is added to the app, you can easily add other similar behaviors to the app, without changing the existing classes.

