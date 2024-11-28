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

## MessageTransformation
In this case, we'll decorate a basic Message class to add various text transformations like encryption, reversing, and uppercasing.

### Explanation:
* Component Interface (Message): Declares getText() method for processing text.
* Concrete Component (SimpleMessage): Implements the interface to return the original message.
* Base Decorator (MessageDecorator):
Implements the same interface and holds a reference to a Message object.
* Concrete Decorators:
-ReverseTextDecorator: Reverses the text.
-UppercaseDecorator: Converts text to uppercase.
-EncryptionDecorator: Applies ROT13 encryption.
* Client Code: 
Demonstrates the dynamic composition of decorators to modify the message.
