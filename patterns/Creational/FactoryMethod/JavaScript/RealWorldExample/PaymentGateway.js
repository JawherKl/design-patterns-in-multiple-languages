/**
 * Factory Method Design Pattern - Payment Gateway Example
 * 
 * This example demonstrates the Factory Method Design Pattern used to handle
 * various types of payment gateway processors, such as PayPal and Stripe.
 * The design encapsulates object creation to allow flexible extension of 
 * payment gateways without altering client code.
 * 
 * Key Components:
 * 1. PaymentProcessor (Abstract Class): Declares the factory method that must 
 *    return objects implementing PaymentGatewayConnector. It may include common
 *    payment processing logic.
 * 2. Concrete Payment Processors: Implement the factory method to create specific
 *    payment gateway connectors (e.g., PayPalConnector, StripeConnector).
 * 3. PaymentGatewayConnector (Interface): Defines the contract for all payment 
 *    gateway connectors, ensuring consistent behavior such as `connect`, `pay`, 
 *    and `disconnect`.
 * 4. Concrete Payment Gateway Connectors: Provide concrete implementations of 
 *    the PaymentGatewayConnector interface for specific gateways.
 * 5. Client Code: Works with PaymentProcessor and PaymentGatewayConnector via 
 *    their abstract interfaces, enabling flexibility and adherence to the 
 *    open/closed principle.
 */

// Abstract Creator
class PaymentProcessor {
    /**
     * Factory method to return the appropriate Payment Gateway Connector.
     * This method must be implemented by subclasses.
     */
    getPaymentGateway() {
        throw new Error("You must implement the 'getPaymentGateway' method in a subclass.");
    }

    /**
     * Business logic that relies on the PaymentGatewayConnector.
     */
    processPayment(amount) {
        const gateway = this.getPaymentGateway();
        gateway.connect();
        gateway.pay(amount);
        gateway.disconnect();
    }
}

// Concrete Creator for PayPal payments
class PayPalProcessor extends PaymentProcessor {
    constructor(username, password) {
        super();
        this.username = username;
        this.password = password;
    }

    getPaymentGateway() {
        return new PayPalConnector(this.username, this.password);
    }
}

// Concrete Creator for Stripe payments
class StripeProcessor extends PaymentProcessor {
    constructor(apiKey) {
        super();
        this.apiKey = apiKey;
    }

    getPaymentGateway() {
        return new StripeConnector(this.apiKey);
    }
}

// Product Interface
class PaymentGatewayConnector {
    connect() {
        throw new Error("You must implement the 'connect' method.");
    }

    disconnect() {
        throw new Error("You must implement the 'disconnect' method.");
    }

    pay(amount) {
        throw new Error("You must implement the 'pay' method.");
    }
}

// Concrete Product for PayPal
class PayPalConnector extends PaymentGatewayConnector {
    constructor(username, password) {
        super();
        this.username = username;
        this.password = password;
    }

    connect() {
        console.log(`Connecting to PayPal using ${this.username}...`);
    }

    disconnect() {
        console.log("Disconnecting from PayPal...");
    }

    pay(amount) {
        console.log(`Paying $${amount.toFixed(2)} via PayPal...`);
    }
}

// Concrete Product for Stripe
class StripeConnector extends PaymentGatewayConnector {
    constructor(apiKey) {
        super();
        this.apiKey = apiKey;
    }

    connect() {
        console.log(`Connecting to Stripe with API key ${this.apiKey}...`);
    }

    disconnect() {
        console.log("Disconnecting from Stripe...");
    }

    pay(amount) {
        console.log(`Paying $${amount.toFixed(2)} via Stripe...`);
    }
}

// Client Code
function clientCode(processor, amount) {
    processor.processPayment(amount);
}

// Example Usage
console.log("Using PayPal Processor:");
clientCode(new PayPalProcessor("user_paypal", "secret"), 100.50);

console.log("\nUsing Stripe Processor:");
clientCode(new StripeProcessor("stripe_api_key"), 200.75);
