<table>
  <tr>
    <td align="center">
      <a href="README.md">🇬🇧 Switch to English</a>
    </td>
    <td align="center">
      <a href="README_de.md">🇩🇪 Switch to German</a>
    </td>
  </tr>
</table>

# Behavioral Design Patterns

This folder contains common examples of **Behavioral Design Patterns** implemented in PHP, Go, JavaScript, and Java. Behavioral patterns focus on the interaction between objects, ensuring that they collaborate effectively and often describing how responsibilities are distributed among them.

## Table of Contents

1. [Chain of Responsibility Design Pattern](#chain-of-responsibility-design-pattern)
2. [Command Design Pattern](#command-design-pattern)
3. [Iterator Design Pattern](#iterator-design-pattern)
4. [Mediator Design Pattern](#mediator-design-pattern)
5. [Observer Design Pattern](#observer-design-pattern)
6. [State Design Pattern](#state-design-pattern)
7. [Strategy Design Pattern](#strategy-design-pattern)
8. [Template Method Design Pattern](#template-method-design-pattern)
9. [Visitor Design Pattern](#visitor-design-pattern)

---

### Chain of Responsibility Design Pattern

The **Chain of Responsibility Pattern** passes requests along a chain of handlers. Each handler decides whether to process the request or pass it to the next one.

#### Example: Request Handler

```php
<?php  
use Behavioral\ChainOfResponsibility\RealWorldExamples\Logger;  
use Behavioral\ChainOfResponsibility\RealWorldExamples\ErrorHandler;  

$logger = new Logger(Logger::INFO);  
$errorHandler = new ErrorHandler();  
$logger->setNext($errorHandler);  

$logger->handle("This is an information message", Logger::INFO);  
$logger->handle("This is an error message", Logger::ERROR);  
```

In this example:

* `Logger` and `ErrorHandler` form a chain of handlers.
* Each handler decides whether it should process the message or pass it along.

#### Use Cases

* Logging frameworks where different log levels are handled by different handlers.
* Validation chains for processing user input.

---

### Command Design Pattern

The **Command Pattern** encapsulates a request as an object, allowing clients to be parameterized with different requests, queued, or logged for later processing.

#### Example: Light Switch Commands

```php
<?php  
use Behavioral\Command\RealWorldExamples\Light;  
use Behavioral\Command\RealWorldExamples\LightOnCommand;  
use Behavioral\Command\RealWorldExamples\RemoteControl;  

$light = new Light();  
$command = new LightOnCommand($light);  
$remote = new RemoteControl();  

$remote->setCommand($command);  
$remote->pressButton();  
```

In this example:

* `LightOnCommand` encapsulates the request to turn on the light.
* `RemoteControl` acts as an invoker to execute the command.

#### Use Cases

* Request queuing in task managers.
* Undo/redo mechanisms in applications.

---

### Iterator Design Pattern

The **Iterator Pattern** provides a way to traverse a collection of elements without exposing its underlying representation.

#### Example: Iterating Over a List

```php
<?php  
use Behavioral\Iterator\RealWorldExamples\BookCollection;  

$books = new BookCollection();  
$books->add("Book 1");  
$books->add("Book 2");  

foreach ($books as $book) {  
    echo $book . "\n";  
}  
```

In this example:

* `BookCollection` implements an iterable collection structure.
* Iteration is performed without exposing internal details.

#### Use Cases

* Traversing collections of complex objects.
* Dynamic sequence generation.

---

### Mediator Design Pattern

The **Mediator Pattern** centralizes communication between objects to reduce direct dependencies between them.

#### Example: User Interface

```php
<?php  
use Behavioral\Mediator\RealWorldExamples\UIComponent;  

$ui = new UIComponent();  
$ui->buttonClicked();  
```

In this example:

* `UIComponent` acts as a mediator between buttons and other interface components.

#### Use Cases

* Complex user interfaces.
* Coordination of distributed workflows.

---

### Observer Design Pattern

The **Observer Pattern** defines a one-to-many dependency between objects so that when the state of one object changes, all its dependents are notified.

#### Example: Newsletter Subscription

```php
<?php  
use Behavioral\Observer\RealWorldExamples\Newsletter;  
use Behavioral\Observer\RealWorldExamples\User;  

$newsletter = new Newsletter();  
$user1 = new User("Alice");  
$user2 = new User("Bob");  

$newsletter->subscribe($user1);  
$newsletter->subscribe($user2);  

$newsletter->notify("New edition released!");  
```

In this example:

* `Newsletter` notifies all subscribed users when a new edition is available.
* `User` objects react to the notification and display the message.

#### Use Cases

* Event listeners in UI frameworks.
* Real-time systems such as stock price updates.

---

### State Design Pattern

The **State Pattern** allows an object to change its behavior when its internal state changes.

#### Example: Traffic Light System

```php
<?php  
use Behavioral\State\RealWorldExamples\TrafficLight;  

$trafficLight = new TrafficLight();  
$trafficLight->changeState(); // Green  
$trafficLight->changeState(); // Yellow  
$trafficLight->changeState(); // Red  
```

In this example:

* `TrafficLight` dynamically changes its behavior based on its current state.

#### Use Cases

* Finite state machines in games or workflow engines.
* UI components that change behavior depending on state.

---

### Strategy Design Pattern

The **Strategy Pattern** defines a family of algorithms, encapsulates each one, and makes them interchangeable at runtime.

#### Example: Payment Strategy

```php
<?php  
use Behavioral\Strategy\RealWorldExamples\PaymentContext;  
use Behavioral\Strategy\RealWorldExamples\CreditCardPayment;  

$payment = new PaymentContext(new CreditCardPayment());  
$payment->pay(100);  
```

In this example:

* `CreditCardPayment` implements a specific payment strategy.
* `PaymentContext` allows dynamic switching between payment methods.

#### Use Cases

* Implementing different sorting or searching algorithms.
* Payment processing with multiple payment methods.

---

### Template Method Design Pattern

The **Template Method Pattern** defines the skeleton of an algorithm in a method, while allowing subclasses to redefine certain steps.

#### Example: Report Generation

```php
<?php  
use Behavioral\TemplateMethod\RealWorldExamples\ReportGenerator;  

$report = new ReportGenerator();  
$report->generate();  
```

In this example:

* `ReportGenerator` provides a method to generate a report with customizable steps.

#### Use Cases

* Document or report generation.
* Standardized processing pipelines.

---

### Visitor Design Pattern

The **Visitor Pattern** allows adding new functionality to existing objects without modifying their structure.

#### Example: Tax Calculation for Different Asset Types

```php
<?php  
use Behavioral\Visitor\RealWorldExamples\TaxVisitor;  
use Behavioral\Visitor\RealWorldExamples\Property;  
use Behavioral\Visitor\RealWorldExamples\Car;  

$taxVisitor = new TaxVisitor();  

$property = new Property(500000);  
$car = new Car(30000);  

echo $property->accept($taxVisitor);  
echo $car->accept($taxVisitor);  
```

In this example:

* `TaxVisitor` calculates tax for different asset types (`Property`, `Car`).
* The `Property` and `Car` classes remain unchanged.

---

## How to Use

1. Clone or download this repository.
2. Navigate to the desired pattern (for example, `Observer`, `Strategy`, `Command`).
3. Run the examples in the terminal using:

```bash
php path/to/your/example.php
```

---

## License

This project is licensed under the MIT License.
