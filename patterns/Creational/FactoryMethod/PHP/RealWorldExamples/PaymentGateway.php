<?php

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

namespace Creational\FactoryMethod\RealWorldExamples;

/**
 * The Creator abstract class declares the factory method that must be
 * implemented by concrete creators to return an object of a PaymentProcessor.
 */
abstract class PaymentProcessor
{
    /**
     * The factory method to return the appropriate Payment Gateway Connector.
     */
    abstract public function getPaymentGateway(): PaymentGatewayConnector;

    /**
     * This is the business logic that relies on the PaymentGatewayConnector
     * created by the factory method.
     */
    public function processPayment(float $amount): void
    {
        $gateway = $this->getPaymentGateway();
        $gateway->connect();
        $gateway->pay($amount);
        $gateway->disconnect();
    }
}

/**
 * Concrete Creator for PayPal payments.
 */
class PayPalProcessor extends PaymentProcessor
{
    private $username, $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getPaymentGateway(): PaymentGatewayConnector
    {
        return new PayPalConnector($this->username, $this->password);
    }
}

/**
 * Concrete Creator for Stripe payments.
 */
class StripeProcessor extends PaymentProcessor
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getPaymentGateway(): PaymentGatewayConnector
    {
        return new StripeConnector($this->apiKey);
    }
}

/**
 * The Product interface defines the methods for a Payment Gateway Connector.
 */
interface PaymentGatewayConnector
{
    public function connect(): void;

    public function disconnect(): void;

    public function pay(float $amount): void;
}

/**
 * Concrete Product implementing PayPal API.
 */
class PayPalConnector implements PaymentGatewayConnector
{
    private $username, $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function connect(): void
    {
        echo "Connecting to PayPal using $this->username...\n";
    }

    public function disconnect(): void
    {
        echo "Disconnecting from PayPal...\n";
    }

    public function pay(float $amount): void
    {
        echo "Paying $$amount via PayPal...\n";
    }
}

/**
 * Concrete Product implementing Stripe API.
 */
class StripeConnector implements PaymentGatewayConnector
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function connect(): void
    {
        echo "Connecting to Stripe with API key $this->apiKey...\n";
    }

    public function disconnect(): void
    {
        echo "Disconnecting from Stripe...\n";
    }

    public function pay(float $amount): void
    {
        echo "Paying $$amount via Stripe...\n";
    }
}

/**
 * The client code that works with any payment processor via the abstract interface.
 */
function clientCode(PaymentProcessor $processor, float $amount)
{
    $processor->processPayment($amount);
}

/**
 * Example usage.
 */
echo "Using PayPal Processor:\n";
clientCode(new PayPalProcessor("user_paypal", "secret"), 100.50);

echo "\n\nUsing Stripe Processor:\n";
clientCode(new StripeProcessor("stripe_api_key"), 200.75);

