<?php

namespace DesignPatterns\Bridge;

/**
 * The Abstraction defines the high-level control for payment methods.
 */
abstract class Payment
{
    /**
     * @var PaymentGateway
     */
    protected $gateway;

    public function __construct(PaymentGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    abstract public function pay(float $amount): string;
}

/**
 * Refined Abstraction: Handles online payments.
 */
class OnlinePayment extends Payment
{
    public function pay(float $amount): string
    {
        return "OnlinePayment: Initiating online payment...\n" . 
            $this->gateway->processPayment($amount);
    }
}

/**
 * Refined Abstraction: Handles in-store payments.
 */
class InStorePayment extends Payment
{
    public function pay(float $amount): string
    {
        return "InStorePayment: Initiating in-store payment...\n" . 
            $this->gateway->processPayment($amount);
    }
}

/**
 * The Implementation defines the interface for payment gateways.
 */
interface PaymentGateway
{
    public function processPayment(float $amount): string;
}

/**
 * Concrete Implementation: Handles payments through PayPal.
 */
class PayPalGateway implements PaymentGateway
{
    public function processPayment(float $amount): string
    {
        return "PayPalGateway: Processing payment of $$amount through PayPal.\n";
    }
}

/**
 * Concrete Implementation: Handles payments through Stripe.
 */
class StripeGateway implements PaymentGateway
{
    public function processPayment(float $amount): string
    {
        return "StripeGateway: Processing payment of $$amount through Stripe.\n";
    }
}

/**
 * Client Code
 */
function clientCode(Payment $payment, float $amount)
{
    echo $payment->pay($amount);
}

// Client: Testing Online Payment with PayPal
$paypalGateway = new PayPalGateway();
$onlinePayment = new OnlinePayment($paypalGateway);
clientCode($onlinePayment, 100.00);

echo "\n\n";

// Client: Testing In-Store Payment with Stripe
$stripeGateway = new StripeGateway();
$inStorePayment = new InStorePayment($stripeGateway);
clientCode($inStorePayment, 250.50);
