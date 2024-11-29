Adapter is a structural design pattern that allows objects with incompatible interfaces to collaborate.

The Adapter acts as a wrapper between two objects. It catches calls for one object and transforms them to format and interface recognizable by the second object.

# Conceptual Example:
This example illustrates the structure of the Adapter design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP use case.

# Real World Example:
## Notification
The Adapter pattern allows you to use 3rd-party or legacy classes even if they’re incompatible with the bulk of your code. For example, instead of rewriting the notification interface of your app to support each 3rd-party service such as Slack, Facebook, SMS or (you-name-it), you can create a set of special wrappers that adapt calls from your app to an interface and format required by each 3rd-party class.

## PayPalPayment
Adapter Design Pattern where we integrate a third-party PayPal payment service with an existing credit card payment interface. This example demonstrates how the adapter pattern can help integrate incompatible interfaces for payment processing in a unified way.

### Explanation:
* Target Interface (PaymentProcessor): This interface requires a pay method, allowing the client code to process payments consistently.
* Existing Class (CreditCardPayment): A class that processes credit card payments by directly implementing the PaymentProcessor interface.
* Adaptee Class (PayPalPayment): Represents a third-party PayPal payment service that doesn’t implement PaymentProcessor and has different methods (login and makePayment).
* Adapter Class (PayPalPaymentAdapter): Adapts PayPalPayment to be compatible with PaymentProcessor by implementing the pay method, which uses login and makePayment internally.
* Client Code: Can handle any PaymentProcessor implementation, meaning it can use both CreditCardPayment and PayPalPaymentAdapter seamlessly.

## CurrencyConverter:
 Adapter design pattern, which demonstrates integrating a third-party currency conversion system (CurrencyConverterAPI) with a standard currency calculation interface. This approach allows the application to convert prices across various currencies seamlessly.
### Explanation:
* Target Interface (CurrencyCalculator): defines a convert method to standardize currency conversion.
* Existing Class (SimpleCurrencyConverter): performs currency conversion with a fixed rate, already adhering to the interface.
* Adaptee (CurrencyConverterAPI): a third-party API for currency conversion that has an incompatible interface with the target. It uses getConvertedAmount with different parameters.
* Adapter (CurrencyConverterAPIAdapter): makes the API compatible with CurrencyCalculator, adapting the convert call to getConvertedAmount.
* Client Code: can convert currencies without knowing the source, using either simple conversion or the third-party API through the adapter.

This examples demonstrate how the Adapter pattern allows integrating an external conversion API into a standardized interface, letting the client code interact with multiple currency providers without modification.