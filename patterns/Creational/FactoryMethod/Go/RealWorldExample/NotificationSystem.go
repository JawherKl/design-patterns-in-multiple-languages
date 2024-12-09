package main

import "fmt"

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Notification Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS). It defines a structure for creating 
| notification services without specifying their concrete classes, promoting 
| flexibility and scalability.
|--------------------------------------------------------------------------
| Key Components:
| 1. NotificationSender (Abstract Class): Declares the factory method that 
|    returns NotificationService objects. It may also contain core logic for 
|    sending notifications.
| 2. Concrete Notification Senders: Override the factory method to create 
|    specific NotificationService instances (e.g., EmailService, SMSService).
| 3. NotificationService (Interface): Defines the contract for all notification
|    services, including methods to connect, send, and disconnect.
| 4. Concrete Notification Services: Implement the NotificationService 
|    interface, providing specific implementations for Email and SMS.
| 5. Client Code: Works with the NotificationSender and NotificationService 
|    via their abstract interfaces, ensuring flexibility and decoupling.
|--------------------------------------------------------------------------
| Use Case:
| Use the Factory Method pattern when a class needs to delegate the instantiation
| of specific notification services to its subclasses or when you want to simplify 
| object creation while adhering to the open/closed principle.
*/

type NotificationService interface {
	Connect()
	Disconnect()
	Send(message string)
}

// NotificationSender defines the abstract Creator class
type NotificationSender interface {
	GetNotificationService() NotificationService
	SendNotification(message string)
}

// EmailNotificationSender is a concrete creator for sending email notifications
type EmailNotificationSender struct {
	Email    string
	Password string
}

func (e *EmailNotificationSender) GetNotificationService() NotificationService {
	return &EmailService{Email: e.Email, Password: e.Password}
}

func (e *EmailNotificationSender) SendNotification(message string) {
	service := e.GetNotificationService()
	service.Connect()
	service.Send(message)
	service.Disconnect()
}

// SMSNotificationSender is a concrete creator for sending SMS notifications
type SMSNotificationSender struct {
	PhoneNumber string
}

func (s *SMSNotificationSender) GetNotificationService() NotificationService {
	return &SMSService{PhoneNumber: s.PhoneNumber}
}

func (s *SMSNotificationSender) SendNotification(message string) {
	service := s.GetNotificationService()
	service.Connect()
	service.Send(message)
	service.Disconnect()
}

// EmailService is a concrete product implementing the NotificationService interface
type EmailService struct {
	Email    string
	Password string
}

func (e *EmailService) Connect() {
	fmt.Printf("Connecting to email service with %s...\n", e.Email)
}

func (e *EmailService) Disconnect() {
	fmt.Println("Disconnecting from email service...")
}

func (e *EmailService) Send(message string) {
	fmt.Printf("Sending email to %s: %s\n", e.Email, message)
}

// SMSService is a concrete product implementing the NotificationService interface
type SMSService struct {
	PhoneNumber string
}

func (s *SMSService) Connect() {
	fmt.Printf("Connecting to SMS service for %s...\n", s.PhoneNumber)
}

func (s *SMSService) Disconnect() {
	fmt.Println("Disconnecting from SMS service...")
}

func (s *SMSService) Send(message string) {
	fmt.Printf("Sending SMS to %s: %s\n", s.PhoneNumber, message)
}

// Client code to demonstrate usage
func clientCode(sender NotificationSender, message string) {
	sender.SendNotification(message)
}

func main() {
	// Sending Email Notification
	fmt.Println("Sending Email Notification:")
	clientCode(&EmailNotificationSender{Email: "john@example.com", Password: "emailpassword"}, "Hello via Email!")

	// Sending SMS Notification
	fmt.Println("\nSending SMS Notification:")
	clientCode(&SMSNotificationSender{PhoneNumber: "+123456789"}, "Hello via SMS!")
}
