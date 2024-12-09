<?php

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Notification Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS). It defines a structure for creating 
| notification services without specifying their concrete classes, promoting 
| flexibility and scalability.
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

namespace Creational\FactoryMethod\NotificationSystem;

/**
 * The Creator abstract class declares the factory method that returns a
 * notification sender. Subclasses will provide the actual implementation.
 */
abstract class NotificationSender
{
    /**
     * The factory method to return the appropriate notification sender.
     */
    abstract public function getNotificationService(): NotificationService;

    /**
     * This method handles the notification sending logic using the service
     * returned by the factory method.
     */
    public function sendNotification(string $message): void
    {
        $service = $this->getNotificationService();
        $service->connect();
        $service->send($message);
        $service->disconnect();
    }
}

/**
 * Concrete Creator for sending email notifications.
 */
class EmailNotificationSender extends NotificationSender
{
    private $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getNotificationService(): NotificationService
    {
        return new EmailService($this->email, $this->password);
    }
}

/**
 * Concrete Creator for sending SMS notifications.
 */
class SMSNotificationSender extends NotificationSender
{
    private $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getNotificationService(): NotificationService
    {
        return new SMSService($this->phoneNumber);
    }
}

/**
 * The Product interface defines the common behavior for notification services.
 */
interface NotificationService
{
    public function connect(): void;

    public function disconnect(): void;

    public function send(string $message): void;
}

/**
 * Concrete Product implementing the Email notification service.
 */
class EmailService implements NotificationService
{
    private $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function connect(): void
    {
        echo "Connecting to email service with $this->email...\n";
    }

    public function disconnect(): void
    {
        echo "Disconnecting from email service...\n";
    }

    public function send(string $message): void
    {
        echo "Sending email to $this->email: $message\n";
    }
}

/**
 * Concrete Product implementing the SMS notification service.
 */
class SMSService implements NotificationService
{
    private $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function connect(): void
    {
        echo "Connecting to SMS service for $this->phoneNumber...\n";
    }

    public function disconnect(): void
    {
        echo "Disconnecting from SMS service...\n";
    }

    public function send(string $message): void
    {
        echo "Sending SMS to $this->phoneNumber: $message\n";
    }
}

/**
 * The client code that works with any notification sender using the abstract interface.
 */
function clientCode(NotificationSender $sender, string $message)
{
    $sender->sendNotification($message);
}

/**
 * Example usage.
 */
echo "Sending Email Notification:\n";
clientCode(new EmailNotificationSender("john@example.com", "emailpassword"), "Hello via Email!");

echo "\n\nSending SMS Notification:\n";
clientCode(new SMSNotificationSender("+123456789"), "Hello via SMS!");

