<?php

/*
|--------------------------------------------------------------------------
| Real-World Example of Strategy Design Pattern - Notification System
|--------------------------------------------------------------------------
| This example demonstrates the Strategy Design Pattern in the context of 
| a Notification System. The system allows dynamic selection of notification 
| methods (e.g., Email, SMS, Push Notifications) based on runtime requirements, 
| providing flexibility and scalability.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Behavioral/Strategy
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **NotificationService**: Acts as the Context, managing the notification 
|    logic and delegating the notification process to a selected strategy.
| 2. **NotificationMethod Interface**: Defines a common interface for all 
|    notification strategies, ensuring consistency and interchangeability.
| 3. **Concrete Strategies**: Implement specific notification methods such as 
|    EmailNotification, SMSNotification, and PushNotification.
| 4. **Client Code**: Demonstrates how the NotificationService dynamically 
|    selects and uses different notification methods at runtime.
|
| Use Case:
| Use the Strategy pattern when you need to provide multiple algorithms or 
| methods for achieving a goal (e.g., sending notifications) and dynamically 
| select one at runtime. This design promotes flexibility by allowing new 
| strategies to be added without modifying existing code.
*/

namespace patterns\Behavioral\Strategy\PHP\NotificationSystem;

/**
 * Context class that represents the Notification Service.
 */
class NotificationService
{
    private NotificationMethod $notificationMethod;

    /**
     * Set the notification method (strategy) dynamically.
     */
    public function setNotificationMethod(NotificationMethod $method): void
    {
        $this->notificationMethod = $method;
    }

    /**
     * Send a notification using the selected strategy.
     */
    public function send(string $recipient, string $message): void
    {
        if (!isset($this->notificationMethod)) {
            throw new \Exception("No notification method set.");
        }

        $this->notificationMethod->sendNotification($recipient, $message);
    }
}

/**
 * Strategy interface for notification methods.
 */
interface NotificationMethod
{
    public function sendNotification(string $recipient, string $message): void;
}

/**
 * Concrete Strategy: Email Notification.
 */
class EmailNotification implements NotificationMethod
{
    public function sendNotification(string $recipient, string $message): void
    {
        echo "Sending Email to $recipient: $message\n";
        // Simulate email sending logic here.
    }
}

/**
 * Concrete Strategy: SMS Notification.
 */
class SMSNotification implements NotificationMethod
{
    public function sendNotification(string $recipient, string $message): void
    {
        echo "Sending SMS to $recipient: $message\n";
        // Simulate SMS sending logic here.
    }
}

/**
 * Concrete Strategy: Push Notification.
 */
class PushNotification implements NotificationMethod
{
    public function sendNotification(string $recipient, string $message): void
    {
        echo "Sending Push Notification to $recipient: $message\n";
        // Simulate push notification logic here.
    }
}

/**
 * Client code.
 */

echo "Client: Setting up the Notification Service.\n";
$notificationService = new NotificationService();

echo "Client: Choosing Email Notification.\n";
$notificationService->setNotificationMethod(new EmailNotification());
$notificationService->send("user@example.com", "Welcome to our service!");

echo "Client: Switching to SMS Notification.\n";
$notificationService->setNotificationMethod(new SMSNotification());
$notificationService->send("+1234567890", "Your OTP is 1234.");

echo "Client: Switching to Push Notification.\n";
$notificationService->setNotificationMethod(new PushNotification());
$notificationService->send("DeviceID123", "You have a new message!");
