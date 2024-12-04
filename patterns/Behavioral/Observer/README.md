Observer is a behavioral design pattern that allows some objects to notify other objects about changes in their state.

The Observer pattern provides a way to subscribe and unsubscribe to and from these events for any object that implements a subscriber interface.

# Conceptual Example:
This example illustrates the structure of the Abstract Factory design pattern. It focuses on answering these questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:

## ObserveEvents
In this example the Observer pattern allows various objects to observe events that are happening inside a user repository of an app.

The repository emits various types of events and allows observers to listen to all of them, as well as only individual ones.

## UserRepository
The scenario involves a UserRepository class that manages users and notifies various observers whenever certain actions are performed (e.g., creating or deleting users).

### Explanation:

1. **UserRepository (Subject)**: This class manages the users and provides methods to add, update, and delete users. It implements `\SplSubject` to manage the observer pattern.
2. **User (Concrete Object)**: Represents a user in the system. It stores the user's data (e.g., name, email, id).
3. **Logger (Concrete Observer)**: Logs all events to a log file when a user is created, updated, or deleted.
4. **OnboardingNotification (Concrete Observer)**: Sends an onboarding notification when a user is created. This could be used for sending emails or other notifications.

### Output:

```
UserRepository: Broadcasting the 'users:init' event.
UserRepository: Creating a user.
Logger: I've written 'users:created' entry to the log.
OnboardingNotification: The notification has been emailed to admin@example.com!
UserRepository: Deleting a user.
Logger: I've written 'users:deleted' entry to the log.
```

## WeatherStation
this time in a more dynamic scenario where a WeatherStation serves as the Subject, and multiple observers (e.g., Display units) receive updates about the weather conditions.

### Explanation:

1. **WeatherStation (Subject)**: 
   - This class holds the weather data (temperature and humidity) and notifies all registered observers whenever the weather changes.
   - It implements `\SplSubject`, so it can attach, detach, and notify observers.

2. **DisplayInterface**:
   - This interface ensures that every display class implements the `update()` method that will be called when the weather data is updated.

3. **CurrentConditionsDisplay (Observer)**:
   - This observer displays the current temperature and humidity on the screen whenever it receives an update.

4. **ForecastDisplay (Observer)**:
   - This observer provides a simple weather forecast based on the current temperature (this is a dummy forecast for this example).

5. **Client Code**:
   - The client code creates a `WeatherStation`, attaches two displays (`CurrentConditionsDisplay` and `ForecastDisplay`), and simulates new weather updates.
   - Each time new weather data is set, all observers are notified and display the updated information.

### Output:

```
Setting new weather data:
Current Conditions: Temperature: 25.5°C, Humidity: 60%
Forecast: The temperature is expected to be 26.5°C tomorrow.

Setting new weather data:
Current Conditions: Temperature: 28°C, Humidity: 55%
Forecast: The temperature is expected to be 29°C tomorrow.
```