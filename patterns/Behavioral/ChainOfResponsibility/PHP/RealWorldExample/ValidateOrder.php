<?php

/*
|--------------------------------------------------------------------------
| Chain of Responsibility Design Pattern - Validate Order
|--------------------------------------------------------------------------
| this example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Behavioral/ChainOfResponsibility/ValidateOrder
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace patterns\Behavioral\ChainOfResponsibility\PHP\RealWorldExample;

/**
 * The base Handler class declares an interface for linking handlers into a chain.
 */
abstract class OrderHandler
{
    private $nextHandler;

    /**
     * Sets the next handler in the chain.
     */
    public function linkWith(OrderHandler $handler): OrderHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * Processes the request or passes it to the next handler in the chain.
     */
    public function handle(array $order): bool
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($order);
        }

        return true;
    }
}

/**
 * This handler checks if the order contains at least one item.
 */
class ItemsInOrderHandler extends OrderHandler
{
    public function handle(array $order): bool
    {
        if (empty($order['items'])) {
            echo "ItemsInOrderHandler: The order must contain at least one item.\n";
            return false;
        }
        return parent::handle($order);
    }
}

/**
 * This handler checks if the payment method is valid.
 */
class PaymentHandler extends OrderHandler
{
    private $validPaymentMethods = ['credit_card', 'paypal'];

    public function handle(array $order): bool
    {
        if (!in_array($order['payment_method'], $this->validPaymentMethods)) {
            echo "PaymentHandler: Invalid payment method.\n";
            return false;
        }
        return parent::handle($order);
    }
}

/**
 * This handler checks if the shipping address is provided.
 */
class ShippingAddressHandler extends OrderHandler
{
    public function handle(array $order): bool
    {
        if (empty($order['shipping_address'])) {
            echo "ShippingAddressHandler: Shipping address is required.\n";
            return false;
        }
        return parent::handle($order);
    }
}

/**
 * Client code that builds the chain and processes an order.
 */
function clientCode(array $order)
{
    $handler = new ItemsInOrderHandler();
    $handler
        ->linkWith(new PaymentHandler())
        ->linkWith(new ShippingAddressHandler());

    if ($handler->handle($order)) {
        echo "Order is valid. Processing...\n";
    } else {
        echo "Order validation failed.\n";
    }
}

// Test order with missing items
$order1 = [
    'items' => [],
    'payment_method' => 'credit_card',
    'shipping_address' => '123 Elm Street'
];
clientCode($order1);

echo "\n";

// Test order with invalid payment method
$order2 = [
    'items' => ['item1', 'item2'],
    'payment_method' => 'bitcoin',
    'shipping_address' => '123 Elm Street'
];
clientCode($order2);

echo "\n";

// Valid order
$order3 = [
    'items' => ['item1'],
    'payment_method' => 'paypal',
    'shipping_address' => '456 Maple Avenue'
];
clientCode($order3);
