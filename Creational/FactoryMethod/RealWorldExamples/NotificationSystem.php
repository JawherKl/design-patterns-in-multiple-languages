<?php

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Notification Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/RealWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
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

