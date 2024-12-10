<?php

/*
|--------------------------------------------------------------------------
| Real-World Example of Strategy Design Pattern - Order Payment System
|--------------------------------------------------------------------------
| This implementation demonstrates the Strategy Design Pattern in a 
| real-world scenario, allowing for dynamic selection of payment methods 
| (e.g., Credit Card, PayPal) when processing an order. The pattern enables 
| flexibility, extensibility, and clean separation of concerns in payment 
| processing logic.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Behavioral/Strategy
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **OrderController**: Acts as the Context, managing the order and 
|    interacting with the selected payment method (strategy).
| 2. **Order**: Represents an order with associated customer and product data.
| 3. **PaymentMethod Interface**: Declares a common interface for different 
|    payment methods, allowing them to be used interchangeably.
| 4. **Concrete Strategies**: Implement specific payment methods such as 
|    CreditCardPayment and PayPalPayment.
| 5. **Client Code**: Demonstrates how the Strategy pattern is applied to 
|    dynamically select and use different payment methods.
|
| Use Case:
| Use the Strategy pattern when you need to encapsulate and vary an algorithm 
| or behavior (e.g., payment processing) without modifying the client code. 
| This design promotes scalability by allowing new strategies to be added 
| without impacting existing functionality.
*/

namespace StrategyPattern;

/**
 * Context: Handles orders and allows payment processing using different strategies.
 */
class OrderController
{
    private $paymentMethod;

    public function setPaymentMethod(PaymentMethod $method): void
    {
        $this->paymentMethod = $method;
    }

    public function processOrder(array $orderData): void
    {
        $order = new Order($orderData);
        echo "OrderController: Created Order #{$order->id}\n";
        echo $this->paymentMethod->pay($order);
    }
}

/**
 * Order: Represents a customer's order.
 */
class Order
{
    public static $lastId = 0;
    public $id;
    public $email;
    public $product;
    public $total;

    public function __construct(array $data)
    {
        $this->id = ++self::$lastId;
        $this->email = $data['email'];
        $this->product = $data['product'];
        $this->total = $data['total'];
    }
}

/**
 * PaymentMethod: Strategy Interface for different payment methods.
 */
interface PaymentMethod
{
    public function pay(Order $order): string;
}

/**
 * Concrete Strategy: Credit Card Payment.
 */
class CreditCardPayment implements PaymentMethod
{
    public function pay(Order $order): string
    {
        return <<<OUTPUT
Processing Credit Card Payment for Order #{$order->id}:
    Customer Email: {$order->email}
    Product: {$order->product}
    Total: \${$order->total}
    Payment Status: SUCCESS
OUTPUT;
    }
}

/**
 * Concrete Strategy: PayPal Payment.
 */
class PayPalPayment implements PaymentMethod
{
    public function pay(Order $order): string
    {
        return <<<OUTPUT
Processing PayPal Payment for Order #{$order->id}:
    Customer Email: {$order->email}
    Product: {$order->product}
    Total: \${$order->total}
    Payment Status: SUCCESS
OUTPUT;
    }
}

/**
 * Client Code: Demonstrates the Strategy Pattern.
 */

echo "Client: Let's create an order and pay with Credit Card.\n";
$orderController = new OrderController();
$orderController->setPaymentMethod(new CreditCardPayment());
$orderController->processOrder([
    'email' => 'customer@example.com',
    'product' => 'Premium Headphones',
    'total' => 199.99
]);

echo "\nClient: Now, let's pay for another order with PayPal.\n";
$orderController->setPaymentMethod(new PayPalPayment());
$orderController->processOrder([
    'email' => 'customer@example.com',
    'product' => 'Gaming Mouse',
    'total' => 49.99
]);
