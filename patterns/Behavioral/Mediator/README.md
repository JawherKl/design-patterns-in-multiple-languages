Mediator is a behavioral design pattern that reduces coupling between components of a program by making them communicate indirectly, through a special mediator object.

The Mediator makes it easy to modify, extend and reuse individual components because they’re no longer dependent on the dozens of other classes.

# Conceptual Example:
This example illustrates the structure of the Abstract Factory design pattern. It focuses on answering these questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:
## TrackTriggerEvent
In this example, the Mediator pattern expands the idea of the Observer pattern by providing a centralized event dispatcher. It allows any object to track & trigger events in other objects without depending on their classes.

## UserAccountManagement
System that dispatches events for various user-related actions similar to the EventDispatcher example

### Explanation:
- **EventDispatcher**: The Mediator component. It handles the subscription of observers (components) and broadcasts events to the relevant subscribers.
- **Observer Interface**: Each component that wants to listen for events must implement this interface.
- **UserRepository**: A component that manages user records, subscribing to events such as "users:created", "users:updated", and "users:deleted".
- **Logger**: A concrete observer that logs event details to a file.
- **OnboardingNotification**: A concrete observer that sends notifications when a user is created.

### Output:
```
UserRepository: Creating a user.
EventDispatcher: Broadcasting the 'users:created' event.
Logger: I've written 'users:created' entry to the log.
OnboardingNotification: The notification has been emailed!
User: I can now delete myself without worrying about the repository.
EventDispatcher: Broadcasting the 'users:deleted' event.
Logger: I've written 'users:deleted' entry to the log.
``` 