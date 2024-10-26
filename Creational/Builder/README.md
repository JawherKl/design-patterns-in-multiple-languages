Builder is a creational design pattern, which allows constructing complex objects step by step.

Unlike other creational patterns, Builder doesn’t require products to have a common interface. That makes it possible to produce different products using the same construction process.

# Conceptual Example
This example illustrates the structure of the Builder design pattern and focuses on the following questions:

* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.

# Real World Example:
## SQL Query Builder:
The builder interface defines the common steps required to build a generic SQL query. On the other hand, concrete builders, corresponding to different SQL dialects, implement these steps by returning parts of SQL queries that can be executed in a particular database engine.

## Meal Plan:
The idea is to have a flexible builder that can create either a vegetarian meal plan or a standard meal plan by combining various components like main course, side dish, and dessert.

### Explanation:
* MealPlan: The complex object we are building.
* MealPlanBuilder: An interface defining the steps to create a meal.
* StandardMealPlanBuilder and VegetarianMealPlanBuilder: Concrete builders that follow the interface to assemble different meal plans.
* MealPlanDirector: A director class that encapsulates the construction logic, ensuring the builder methods are called in the correct sequence.

This example demonstrates how the Builder pattern can be used to create different meal plans with a common construction process. You can add more customization (e.g., drinks or appetizers) by extending the builder interface.

## Computer Assembly
### Explanation:
* Builder Interface (ComputerBuilder): Declares methods to set computer components.
* Concrete Builders (GamingComputerBuilder, OfficeComputerBuilder): Assemble computers with specific configurations (gaming or office).
* Product Class (Computer): Represents the computer and holds its parts.
* Director (Director): Guides the assembly process by deciding how to configure the computer (gaming or office).
* Client Code: Calls the director to create different types of computers.

This shows how the Builder pattern is useful when creating complex objects step-by-step, with various configurations.
