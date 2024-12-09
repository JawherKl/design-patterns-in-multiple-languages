package main

import "fmt"

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

// PaymentGatewayConnector defines the contract for all payment gateway connectors.
type PaymentGatewayConnector interface {
	Connect()
	Disconnect()
	Pay(amount float64)
}

// PaymentProcessor is an abstract class that declares the factory method.
type PaymentProcessor interface {
	GetPaymentGateway() PaymentGatewayConnector
	ProcessPayment(amount float64)
}

// Concrete implementation of the PaymentProcessor for PayPal.
type PayPalProcessor struct {
	username string
	password string
}

func NewPayPalProcessor(username, password string) *PayPalProcessor {
	return &PayPalProcessor{username: username, password: password}
}

func (p *PayPalProcessor) GetPaymentGateway() PaymentGatewayConnector {
	return NewPayPalConnector(p.username, p.password)
}

func (p *PayPalProcessor) ProcessPayment(amount float64) {
	gateway := p.GetPaymentGateway()
	gateway.Connect()
	gateway.Pay(amount)
	gateway.Disconnect()
}

// Concrete implementation of the PaymentProcessor for Stripe.
type StripeProcessor struct {
	apiKey string
}

func NewStripeProcessor(apiKey string) *StripeProcessor {
	return &StripeProcessor{apiKey: apiKey}
}

func (s *StripeProcessor) GetPaymentGateway() PaymentGatewayConnector {
	return NewStripeConnector(s.apiKey)
}

func (s *StripeProcessor) ProcessPayment(amount float64) {
	gateway := s.GetPaymentGateway()
	gateway.Connect()
	gateway.Pay(amount)
	gateway.Disconnect()
}

// PayPalConnector implements the PaymentGatewayConnector interface.
type PayPalConnector struct {
	username string
	password string
}

func NewPayPalConnector(username, password string) *PayPalConnector {
	return &PayPalConnector{username: username, password: password}
}

func (p *PayPalConnector) Connect() {
	fmt.Printf("Connecting to PayPal using %s...\n", p.username)
}

func (p *PayPalConnector) Disconnect() {
	fmt.Println("Disconnecting from PayPal...")
}

func (p *PayPalConnector) Pay(amount float64) {
	fmt.Printf("Paying $%.2f via PayPal...\n", amount)
}

// StripeConnector implements the PaymentGatewayConnector interface.
type StripeConnector struct {
	apiKey string
}

func NewStripeConnector(apiKey string) *StripeConnector {
	return &StripeConnector{apiKey: apiKey}
}

func (s *StripeConnector) Connect() {
	fmt.Printf("Connecting to Stripe with API key %s...\n", s.apiKey)
}

func (s *StripeConnector) Disconnect() {
	fmt.Println("Disconnecting from Stripe...")
}

func (s *StripeConnector) Pay(amount float64) {
	fmt.Printf("Paying $%.2f via Stripe...\n", amount)
}

// Client code that works with any payment processor via the abstract interface.
func clientCode(processor PaymentProcessor, amount float64) {
	processor.ProcessPayment(amount)
}

// Example usage
func main() {
	fmt.Println("Using PayPal Processor:")
	payPalProcessor := NewPayPalProcessor("user_paypal", "secret")
	clientCode(payPalProcessor, 100.50)

	fmt.Println("\nUsing Stripe Processor:")
	stripeProcessor := NewStripeProcessor("stripe_api_key")
	clientCode(stripeProcessor, 200.75)
}
