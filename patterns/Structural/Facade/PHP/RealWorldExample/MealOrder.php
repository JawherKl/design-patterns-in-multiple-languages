<?php

/*
|--------------------------------------------------------------------------
| Facade Design Pattern Example
|--------------------------------------------------------------------------
| This example demonstrates how to simplify complex subsystem interactions
| by creating a unified interface (Facade) that provides easy access to 
| the subsystem's functionality.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Facade
| @version   1.0.0
| @author    JawherKl
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace FacadeExample;

/**
 * Facade class providing a simple interface for ordering a meal.
 */
class MealOrderFacade
{
    protected $restaurant;
    protected $deliveryService;
    protected $paymentProcessor;

    public function __construct()
    {
        $this->restaurant = new Restaurant();
        $this->deliveryService = new DeliveryService();
        $this->paymentProcessor = new PaymentProcessor();
    }

    public function placeOrder(string $meal, string $address, float $amount): void
    {
        echo "Placing order for: $meal...\n";
        $this->restaurant->prepareMeal($meal);
        $this->paymentProcessor->processPayment($amount);
        $this->deliveryService->deliverMeal($meal, $address);
        echo "Order completed successfully!\n";
    }
}

/**
 * Subsystem class responsible for meal preparation.
 */
class Restaurant
{
    public function prepareMeal(string $meal): void
    {
        echo "Preparing the meal: $meal...\n";
    }
}

/**
 * Subsystem class responsible for delivering the meal.
 */
class DeliveryService
{
    public function deliverMeal(string $meal, string $address): void
    {
        echo "Delivering $meal to $address...\n";
    }
}

/**
 * Subsystem class responsible for processing payments.
 */
class PaymentProcessor
{
    public function processPayment(float $amount): void
    {
        echo "Processing payment of $$amount...\n";
    }
}

/**
 * Client code using the Facade to place an order.
 */
function clientCode(MealOrderFacade $facade)
{
    $facade->placeOrder("Pizza Margherita", "123 Main St", 20.50);
}

$facade = new MealOrderFacade();
clientCode($facade);
