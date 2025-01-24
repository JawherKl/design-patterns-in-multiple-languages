package patterns.Creational.FactoryMethod.Java.RealWorldExample;

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Payment Gateway Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern used to handle
| various types of payment gateway processors, such as PayPal and Stripe. 
| The design encapsulates object creation to allow flexible extension of 
| payment gateways without altering client code.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/FactoryMethod/RealWorldExample
| @version   1.0.0
| @license   MIT License
| @author    JawherKl
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. PaymentProcessor (Abstract Class): Declares the factory method that must 
|    return objects implementing PaymentGatewayConnector. It may include common
|    payment processing logic.
| 2. Concrete Payment Processors: Implement the factory method to create specific
|    payment gateway connectors (e.g., PayPalConnector, StripeConnector).
| 3. PaymentGatewayConnector (Interface): Defines the contract for all payment 
|    gateway connectors, ensuring consistent behavior such as `connect`, `pay`, 
|    and `disconnect`.
| 4. Concrete Payment Gateway Connectors: Provide concrete implementations of 
|    the PaymentGatewayConnector interface for specific gateways.
| 5. Client Code: Works with PaymentProcessor and PaymentGatewayConnector via 
|    their abstract interfaces, enabling flexibility and adherence to the 
|    open/closed principle.
|--------------------------------------------------------------------------
| Use Case:
| Use the Factory Method pattern when a class needs to create objects but wants 
| to defer the instantiation logic to its subclasses, allowing for flexible 
| extension and easier maintenance.
*/

// PaymentGatewayConnector interface
interface PaymentGatewayConnector {
    void connect();
    void disconnect();
    void pay(double amount);
}

// PayPalConnector implementation
class PayPalConnector implements PaymentGatewayConnector {
    private String username;
    private String password;

    public PayPalConnector(String username, String password) {
        this.username = username;
        this.password = password;
    }

    @Override
    public void connect() {
        System.out.println("Connecting to PayPal using " + this.username + "...");
    }

    @Override
    public void disconnect() {
        System.out.println("Disconnecting from PayPal...");
    }

    @Override
    public void pay(double amount) {
        System.out.println("Paying $" + amount + " via PayPal...");
    }
}

// StripeConnector implementation
class StripeConnector implements PaymentGatewayConnector {
    private String apiKey;

    public StripeConnector(String apiKey) {
        this.apiKey = apiKey;
    }

    @Override
    public void connect() {
        System.out.println("Connecting to Stripe with API key " + this.apiKey + "...");
    }

    @Override
    public void disconnect() {
        System.out.println("Disconnecting from Stripe...");
    }

    @Override
    public void pay(double amount) {
        System.out.println("Paying $" + amount + " via Stripe...");
    }
}

// Abstract PaymentProcessor class
abstract class PaymentProcessor {
    // Factory method to be implemented by subclasses
    public abstract PaymentGatewayConnector getPaymentGateway();

    // Core logic for processing payments
    public void processPayment(double amount) {
        PaymentGatewayConnector gateway = getPaymentGateway();
        gateway.connect();
        gateway.pay(amount);
        gateway.disconnect();
    }
}

// PayPalProcessor implementation
class PayPalProcessor extends PaymentProcessor {
    private String username;
    private String password;

    public PayPalProcessor(String username, String password) {
        this.username = username;
        this.password = password;
    }

    @Override
    public PaymentGatewayConnector getPaymentGateway() {
        return new PayPalConnector(this.username, this.password);
    }
}

// StripeProcessor implementation
class StripeProcessor extends PaymentProcessor {
    private String apiKey;

    public StripeProcessor(String apiKey) {
        this.apiKey = apiKey;
    }

    @Override
    public PaymentGatewayConnector getPaymentGateway() {
        return new StripeConnector(this.apiKey);
    }
}

// Client code
public class PaymentGatewayExample {
    public static void clientCode(PaymentProcessor processor, double amount) {
        processor.processPayment(amount);
    }

    public static void main(String[] args) {
        System.out.println("Using PayPal Processor:");
        clientCode(new PayPalProcessor("user_paypal", "secret"), 100.50);

        System.out.println("\n\nUsing Stripe Processor:");
        clientCode(new StripeProcessor("stripe_api_key"), 200.75);
    }
}