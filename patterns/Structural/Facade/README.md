Facade is a structural design pattern that provides a simplified (but limited) interface to a complex system of classes, library or framework.

While Facade decreases the overall complexity of the application, it also helps to move unwanted dependencies to one place.

# Conceptual Example:
This example illustrates the structure of the Bridge design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:
## SubSystem
In this example, the Facade hides the complexity of the YouTube API and FFmpeg library from the client code. Instead of working with dozens of classes, the client uses a simple method on the Facade.

## MealOrder
This example demonstrates how to simplify complex subsystem interactions by creating a unified interface (Facade) that provides easy access to the subsystem's functionality.

### Explanation:


### Explanation:
1. **Subsystems:**
   - `Restaurant` handles meal preparation.
   - `DeliveryService` manages meal delivery.
   - `PaymentProcessor` processes payments.
   
2. **Facade Class:**
   - `MealOrderFacade` provides a single method `placeOrder` to encapsulate interactions with the subsystems.

3. **Client Code:**
   - The client interacts only with the `MealOrderFacade`, simplifying the process of placing an order.


## HomeAutomation
This example demonstrates controlling a complex home automation system through a simple interface using the Facade pattern.

### Explanation:
1. **Subsystems:**
   - `SmartLights` controls the lights (turn on/dim).
   - `Thermostat` controls the home temperature.
   - `SecuritySystem` manages security (activate/deactivate).

2. **Facade Class:**
   - `SmartHomeFacade` provides methods like `startMorningRoutine` and `startNightRoutine` that combine subsystem operations into simple routines.

3. **Client Code:**
   - The client calls high-level methods on the `SmartHomeFacade` instead of interacting directly with individual subsystems.
