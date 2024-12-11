# Design Patterns Overview

This repository provides a comprehensive guide to **Design Patterns** in software engineering. Design patterns are proven solutions to common problems in software design. They promote reusability, flexibility, and maintainability of code. Below, we explore the three main categories of design patterns:

---

## Table of Contents

1. [Behavioral Patterns](#behavioral-patterns)
2. [Creational Patterns](#creational-patterns)
3. [Structural Patterns](#structural-patterns)

---

## Behavioral Patterns

**Behavioral patterns** are concerned with algorithms and the assignment of responsibilities between objects. They help manage communication between objects and make it easier to maintain and scale software systems.

### Key Behavioral Patterns:
- **Strategy**: Defines a family of algorithms and allows them to be interchangeable.
- **Observer**: Allows one object (the subject) to notify other objects (observers) of any changes in its state.
- **Command**: Encapsulates a request as an object, thereby decoupling sender and receiver.

### Example:
```php
// Strategy Pattern Example
class PaymentProcessor {
    private $paymentMethod;

    public function __construct(PaymentMethod $method) {
        $this->paymentMethod = $method;
    }

    public function processPayment($amount) {
        $this->paymentMethod->pay($amount);
    }
}
```

---

## Creational Patterns

**Creational patterns** focus on object creation mechanisms. They are designed to instantiate objects in a manner suitable to the situation. These patterns provide flexibility in creating objects while avoiding tight coupling in your code.

### Key Creational Patterns:
- **Singleton**: Ensures a class has only one instance and provides a global access point to it.
- **Factory Method**: Defines an interface for creating an object, but allows subclasses to alter the type of created objects.
- **Abstract Factory**: Creates families of related or dependent objects without specifying their concrete classes.

### Example:
```php
// Singleton Pattern Example
class DatabaseConnection {
    private static $instance;

    private function __construct() {
        // private constructor
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }
}
```

---

## Structural Patterns

**Structural patterns** are concerned with the composition of classes or objects. They help ensure that the classes and objects in your application work together in a flexible, scalable way. These patterns are used to simplify the design and structure of your software.

### Key Structural Patterns:
- **Adapter**: Allows incompatible interfaces to work together.
- **Decorator**: Adds additional functionality to an object at runtime.
- **Facade**: Provides a simplified interface to a complex subsystem.

### Example:
```php
// Adapter Pattern Example
class WeatherAPI {
    public function getWeatherData() {
        return "Weather data from API";
    }
}

class WeatherAdapter {
    private $weatherAPI;

    public function __construct(WeatherAPI $weatherAPI) {
        $this->weatherAPI = $weatherAPI;
    }

    public function getTemperature() {
        $data = $this->weatherAPI->getWeatherData();
        return "Extracted temperature: " . $data;
    }
}
```

---

## Conclusion

Design patterns are essential tools in software engineering that solve common problems in design and maintainability. Understanding these patterns helps you write more scalable, flexible, and reusable code. 

### Explore More:
- For **Behavioral** patterns, refer to specific patterns like **Strategy** and **Observer**.
- For **Creational** patterns, explore **Singleton** and **Abstract Factory**.
- For **Structural** patterns, dive deeper into **Adapter** and **Decorator**.
