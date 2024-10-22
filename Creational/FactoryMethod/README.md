Factory Method is a creational design pattern that provides an interface for creating objects in a superclass, but allows subclasses to alter the type of objects that will be created.

# Conceptual Example:
    This example illustrates the structure of the Factory Method design pattern and focuses on the following questions:

    What classes does it consist of?
    What roles do these classes play?
    In what way the elements of the pattern are related?
    After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.


# Real World Example:
## Social Network:
    In this example, the Factory Method pattern provides an interface for creating social network connectors, which can be used to log in to the network, create posts and potentially perform other activities—and all of this without coupling the client code to specific classes of the particular social network.

## Payment Gateway:
    Real-world example using the Factory Method design pattern, but this time it simulates an online payment gateway system, with different connectors for PayPal and Stripe.
### Explanation:
    * PaymentProcessor is the abstract class defining the factory method getPaymentGateway().
    * PayPalProcessor and StripeProcessor are concrete implementations that return different payment gateway connectors.
    * PaymentGatewayConnector is the interface for all payment gateway operations.
    * PayPalConnector and StripeConnector implement the methods to handle the payment process.
    * clientCode() works with any processor (PayPal or Stripe) by calling the processPayment() method.

    This setup allows switching between different payment methods (PayPal, Stripe) without modifying the core client logic.

## Notification System:
    Another example, this time based on a notification system, where different types of notifications (Email, SMS) are created using the Factory Method design pattern.

### Explanation:
    * NotificationSender is the abstract class with the factory method getNotificationService().
    * EmailNotificationSender and SMSNotificationSender are concrete implementations of the factory method that return different notification services.
    * NotificationService is the interface for sending notifications (either via email or SMS).
    * EmailService and SMSService implement specific behaviors for sending notifications.
    * clientCode() uses any notification sender (Email or SMS) without changing the core logic.
    
    This setup allows flexibility in switching between different notification services (Email, SMS) as needed.