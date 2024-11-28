Decorator is a structural design pattern that lets you attach new behaviors to objects by placing these objects inside special wrapper objects that contain the behaviors.

Wearing clothes is an example of using decorators. When you’re cold, you wrap yourself in a sweater. If you’re still cold with a sweater, you can wear a jacket on top. If it’s raining, you can put on a raincoat. All of these garments “extend” your basic behavior but aren’t part of you, and you can easily take off any piece of clothing whenever you don’t need it.

# Conceptual Example:
This example illustrates the structure of the Bridge design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.

# Real World Example:
## TextFilering
In this example, the Decorator pattern helps you to construct complex text filtering rules to clean up content before rendering it on a web page. Different types of content, such as comments, forum posts or private messages require different sets of filters.

## FileSystem
example of the Composite Design Pattern similar to the provided one. It demonstrates the structure and functionality of a filesystem (files and folders) using the pattern.

### Explanation:
* Base Component (FilesystemItem):: 
-Provides a common interface for both `File` and `Folder`.
-Declares methods for getting size and rendering.
* Leaf Component (File):
-Represents individual files.
-Implements the size calculation and rendering logic for files.
* Composite Component (Folder):
-Represents folders that can contain other FilesystemItem objects.
-Implements logic for adding, removing, and calculating size for all children.
-Combines rendering output from its children.
* Concrete Implementations (PayPalGateway, StripeGateway): 
-Specific implementations for different payment gateways.
* Client Code: 
-Builds a hierarchical structure of files and folders.
-Works with the structure using the abstract FilesystemItem interface.

<!--
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