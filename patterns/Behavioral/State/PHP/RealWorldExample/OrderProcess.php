<?php

namespace patterns\Behavioral\State\PHP\RealWorldExample;

/**
 * The State interface declares methods that are used to handle state transitions.
 */
interface OrderState
{
    public function handleOrder(Order $order): void;
}

/**
 * Concrete state: The order is new.
 */
class NewOrderState implements OrderState
{
    public function handleOrder(Order $order): void
    {
        echo "Order is new. Processing the order.\n";
        // Transition to the next state
        $order->setState(new ShippedOrderState());
    }
}

/**
 * Concrete state: The order has been shipped.
 */
class ShippedOrderState implements OrderState
{
    public function handleOrder(Order $order): void
    {
        echo "Order has been shipped. Waiting for delivery.\n";
        // Transition to the next state
        $order->setState(new DeliveredOrderState());
    }
}

/**
 * Concrete state: The order has been delivered.
 */
class DeliveredOrderState implements OrderState
{
    public function handleOrder(Order $order): void
    {
        echo "Order has been delivered. Thank you for your purchase!\n";
        // The order is finished, no further transitions.
    }
}

/**
 * The Order class represents the context that maintains the current state.
 */
class Order
{
    private $state;

    public function __construct()
    {
        // Initial state is NewOrder
        $this->state = new NewOrderState();
    }

    public function setState(OrderState $state): void
    {
        $this->state = $state;
    }

    public function processOrder(): void
    {
        $this->state->handleOrder($this);
    }
}

/**
 * Client code
 */

// Create a new order
$order = new Order();

// Process the order
echo "Processing the order:\n";
$order->processOrder(); // New state: Processing the order

$order->processOrder(); // Shipped state: Order has been shipped

$order->processOrder(); // Delivered state: Order has been delivered

