Flyweight is a structural design pattern that allows programs to support vast quantities of objects by keeping their memory consumption low.

The pattern achieves it by sharing parts of object state between multiple objects. In other words, the Flyweight saves RAM by caching the same data used by different objects.

# Conceptual Example:
This example illustrates the structure of the Bridge design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:
## CatsFeatures
In this example, the Flyweight pattern is used to minimize the RAM usage of objects in an animal database of a cat-only veterinary clinic. Each record in the database is represented by a Cat object. Its data consists of two parts:

1. Unique (extrinsic) data such as a pet’s name, age, and owner info.
2. Shared (intrinsic) data such as breed name, color, texture, etc.

The first part is stored directly inside the Cat class, which acts as a context. The second part, however, is stored separately and can be shared by multiple cats. This shareable data resides inside the CatVariation class. All cats that have similar features are linked to the same CatVariation class, instead of storing the duplicate data in each of their objects.

## ForestSimulation
Tree objects in a forest simulation. This example highlights how intrinsic data (shared state like type and texture) is separated from extrinsic data (unique data like position).

### Explanation:

1. **TreeType (Flyweight)**: Stores intrinsic data like `name`, `color`, and `texture`.
2. **Tree (Context)**: Stores extrinsic data such as `x` and `y` (position).
3. **TreeFactory (Flyweight Factory)**: Manages shared `TreeType` instances to avoid redundant objects.
4. **Forest**: Acts as the client managing the collection of trees.
5. **Singleton TreeFactory**: Ensures only one instance of the factory exists.

