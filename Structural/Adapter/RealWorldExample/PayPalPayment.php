<?php

/*
|--------------------------------------------------------------------------
| Adapter Design Pattern - Adapter
|--------------------------------------------------------------------------
| Implement Adapter Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Adapter
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Adapter\Adapter\RealWorldExample;

/**
 * The Target interface represents the standard payment interface that our
 * application follows.
 */
interface PaymentProcessor
{
    public function pay(int $amount);
}

/**
 * A class implementing the PaymentProcessor interface that handles credit card
 * payments.
 */
class CreditCardPayment implements PaymentProcessor
{
    public function pay(int $amount): void
    {
        echo "Processing credit card payment of $$amount.\n";
    }
}

/**
 * The Adaptee class is a third-party PayPal payment library which is incompatible
 * with the PaymentProcessor interface.
 */
class PayPalPayment
{
    private $email;
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function login(): void
    {
        echo "Logged in to PayPal account '{$this->email}'.\n";
    }

    public function makePayment(int $amount): void
    {
        echo "PayPal processing payment of $$amount.\n";
    }
}

/**
 * The Adapter class makes PayPalPayment compatible with the PaymentProcessor
 * interface.
 */
class PayPalPaymentAdapter implements PaymentProcessor
{
    private $payPalPayment;

    public function __construct(PayPalPayment $payPalPayment)
    {
        $this->payPalPayment = $payPalPayment;
    }

    public function pay(int $amount): void
    {
        $this->payPalPayment->login();
        $this->payPalPayment->makePayment($amount);
    }
}

/**
 * Client code that works with any class implementing the PaymentProcessor
 * interface.
 */
function clientCode(PaymentProcessor $paymentProcessor)
{
    // The client code can process a payment without knowing the exact class type
    $paymentProcessor->pay(100);
}

echo "Using CreditCardPayment:\n";
$creditCardPayment = new CreditCardPayment();
clientCode($creditCardPayment);

echo "\n\nUsing PayPalPayment with Adapter:\n";
$payPalPayment = new PayPalPayment("user@example.com", "securepassword");
$payPalAdapter = new PayPalPaymentAdapter($payPalPayment);
clientCode($payPalAdapter);
