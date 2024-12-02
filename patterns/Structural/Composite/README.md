Composite is a structural design pattern that lets you compose objects into tree structures and then work with these structures as if they were individual objects.

Composite became a pretty popular solution for the most problems that require building a tree structure. Composite’s great feature is the ability to run methods recursively over the whole tree structure and sum up the results.

# Conceptual Example:
This example illustrates the structure of the Bridge design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:
## HTMLDOMTree
The HTML DOM tree is an example of such a structure. For instance, while the various input elements can act as leaves, the complex elements like forms and fieldsets play the role of composites.

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