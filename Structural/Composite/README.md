Composite is a structural design pattern that lets you compose objects into tree structures and then work with these structures as if they were individual objects.

Composite became a pretty popular solution for the most problems that require building a tree structure. Composite’s great feature is the ability to run methods recursively over the whole tree structure and sum up the results.

# Conceptual Example:
This example illustrates the structure of the Bridge design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.

# Real World Example:
## HTMLDOMTree
The HTML DOM tree is an example of such a structure. For instance, while the various input elements can act as leaves, the complex elements like forms and fieldsets play the role of composites.
<!--
## Page
In this example, the `Page` hierarchy acts as the Abstraction, and the `Renderer` hierarchy acts as the Implementation. Objects of the `Page` class can assemble web pages of a particular kind using basic elements provided by a `Renderer` object attached to that page. Since both of the class hierarchies are separate, you can add a new `Renderer` class without changing any of the `Page` classes and vice versa.

## PaymentSystem
This example demonstrates how the Bridge Design Pattern allows separating the abstraction (Payment) from the implementation (PaymentGateway), enabling flexibility to add new payment types or gateways without affecting existing code.

### Explanation:
* Abstraction (Payment): 
-Represents the main operations of the payment system.
-Delegates the processing of payments to the PaymentGateway implementation.
* Refined Abstractions (OnlinePayment, InStorePayment): 
-Provide specific implementations for payment types (online or in-store).
* Implementation (PaymentGateway Interface): 
-Represents the interface for payment gateways like PayPal or Stripe.
* Concrete Implementations (PayPalGateway, StripeGateway): 
-Specific implementations for different payment gateways.
* Client Code: 
-Works only with the abstraction, not caring about the specific implementation.

## CurrencyConverter:
In this scenario, we'll implement a drawing tool where the abstraction represents different shapes (like circles and rectangles), and the implementation focuses on different rendering methods (like vector rendering and raster rendering).
### Explanation:
* Abstraction (Shape): 
-Represents the concept of a shape.
-Delegates the rendering logic to the Renderer implementation.
* Refined Abstractions  (Circle, Rectangle): 
-Extend the abstraction to include specific shapes.
* Implementation (Renderer Interface):
-Represents the interface for payment gateways like PayPal or Stripe.
* Concrete Implementations (VectorRenderer, RasterRenderer): 
-Implement rendering logic for vector graphics and raster graphics, respectively.
* Client Code: 
-Works with any combination of shapes and renderers.
-->