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

**Template Method** is a behavioral design pattern that defines the skeleton of an algorithm in a base class and lets subclasses override specific steps without changing the algorithm's structure.

# Conceptual Example:
This example illustrates the structure of the Template Method design pattern. It focuses on answering these questions:
- What classes does it consist of?
- What roles do these classes play?
- In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on the PHP implementation included in this folder.

# Real World Example:

In this example the Template Method pattern defines a template algorithm in an abstract base class and two concrete subclasses that implement the required steps. The PHP example is implemented in [TemplateMethod.php](patterns/Behavioral/TemplateMethod/PHP/TemplateMethod.php).

## AbstractClass (Template)
This abstract class defines the `templateMethod()` which contains the fixed algorithm skeleton. The skeleton calls:
- concrete "base" operations with default implementations,
- abstract primitive operations that concrete subclasses must implement,
- hook methods that subclasses may override optionally.

## ConcreteClass1 (Concrete Implementation)
Implements the required primitive operations. Uses the default hooks.

## ConcreteClass2 (Concrete Implementation)
Implements the required primitive operations and overrides one hook to extend behavior.

## Client Code
The client code works with objects through the abstract base type and triggers the algorithm by calling `templateMethod()`.

### Explanation:

1. **AbstractClass (Template)**: Defines `templateMethod()` that sequences calls to `baseOperation1()`, `requiredOperations1()`, `baseOperation2()`, `hook1()`, `requiredOperation2()`, `baseOperation3()`, and `hook2()`.
2. **ConcreteClass1**: Implements `requiredOperations1()` and `requiredOperation2()`.
3. **ConcreteClass2**: Implements the required operations and overrides `hook1()` to add custom behavior.
4. **Client Code**: Instantiates concrete classes and calls the template method. The algorithm's structure remains the same while the concrete steps vary.

### Output:

Running the PHP example prints the following to stdout:

```
Same client code can work with different subclasses:
AbstractClass says: I am doing the bulk of the work
ConcreteClass1 says: Implemented Operation1
AbstractClass says: But I let subclasses override some operations
ConcreteClass1 says: Implemented Operation2
AbstractClass says: But I am doing the bulk of the work anyway

Same client code can work with different subclasses:
AbstractClass says: I am doing the bulk of the work
ConcreteClass2 says: Implemented Operation1
AbstractClass says: But I let subclasses override some operations
ConcreteClass2 says: Overridden Hook1
ConcreteClass2 says: Implemented Operation2
AbstractClass says: But I am doing the bulk of the work anyway
```

### Files:
- Implementation: [patterns/Behavioral/TemplateMethod/PHP/TemplateMethod.php](patterns/Behavioral/TemplateMethod/PHP/TemplateMethod.php)

If you want, I can also extract small snippets from the PHP example into the README for quick reference or add instructions to run it locally.
Template Method is a behavioral design pattern that allows you to define a skeleton of an algorithm in a base class and let subclasses override the steps without changing the overall algorithm’s structure.


In this example, the Template Method pattern defines a skeleton of the algorithm of message posting to social networks. Each subclass represents a separate social network and implements all the steps differently, but reuses the base algorithm.