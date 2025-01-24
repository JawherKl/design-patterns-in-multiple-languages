package patterns.Creational.FactoryMethod.Java.RealWorldExample;

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

// NotificationService interface
interface NotificationService {
    void connect();
    void disconnect();
    void send(String message);
}

// EmailService implementation
class EmailService implements NotificationService {
    private String email;
    private String password;

    public EmailService(String email, String password) {
        this.email = email;
        this.password = password;
    }

    @Override
    public void connect() {
        System.out.println("Connecting to email service with " + this.email + "...");
    }

    @Override
    public void disconnect() {
        System.out.println("Disconnecting from email service...");
    }

    @Override
    public void send(String message) {
        System.out.println("Sending email to " + this.email + ": " + message);
    }
}

// SMSService implementation
class SMSService implements NotificationService {
    private String phoneNumber;

    public SMSService(String phoneNumber) {
        this.phoneNumber = phoneNumber;
    }

    @Override
    public void connect() {
        System.out.println("Connecting to SMS service for " + this.phoneNumber + "...");
    }

    @Override
    public void disconnect() {
        System.out.println("Disconnecting from SMS service...");
    }

    @Override
    public void send(String message) {
        System.out.println("Sending SMS to " + this.phoneNumber + ": " + message);
    }
}

// Abstract NotificationSender class
abstract class NotificationSender {
    // Factory method to be implemented by subclasses
    public abstract NotificationService getNotificationService();

    // Core logic for sending notifications
    public void sendNotification(String message) {
        NotificationService service = getNotificationService();
        service.connect();
        service.send(message);
        service.disconnect();
    }
}

// EmailNotificationSender implementation
class EmailNotificationSender extends NotificationSender {
    private String email;
    private String password;

    public EmailNotificationSender(String email, String password) {
        this.email = email;
        this.password = password;
    }

    @Override
    public NotificationService getNotificationService() {
        return new EmailService(this.email, this.password);
    }
}

// SMSNotificationSender implementation
class SMSNotificationSender extends NotificationSender {
    private String phoneNumber;

    public SMSNotificationSender(String phoneNumber) {
        this.phoneNumber = phoneNumber;
    }

    @Override
    public NotificationService getNotificationService() {
        return new SMSService(this.phoneNumber);
    }
}

// Client code
public class NotificationSystemExample {
    public static void clientCode(NotificationSender sender, String message) {
        sender.sendNotification(message);
    }

    public static void main(String[] args) {
        System.out.println("Sending Email Notification:");
        clientCode(new EmailNotificationSender("john@example.com", "emailpassword"), "Hello via Email!");

        System.out.println("\n\nSending SMS Notification:");
        clientCode(new SMSNotificationSender("+123456789"), "Hello via SMS!");
    }
}