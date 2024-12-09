/**
 * Factory Method Design Pattern - Notification Example
 * 
 * This example demonstrates the Factory Method Design Pattern to send various
 * types of notifications (Email, SMS). It defines a structure for creating 
 * notification services without specifying their concrete classes, promoting 
 * flexibility and scalability.
 * 
 * Key Components:
 * 1. NotificationSender (Abstract Class): Declares the factory method that 
 *    returns NotificationService objects. It may also contain core logic for 
 *    sending notifications.
 * 2. Concrete Notification Senders: Override the factory method to create 
 *    specific NotificationService instances (e.g., EmailService, SMSService).
 * 3. NotificationService (Interface): Defines the contract for all notification
 *    services, including methods to connect, send, and disconnect.
 * 4. Concrete Notification Services: Implement the NotificationService 
 *    interface, providing specific implementations for Email and SMS.
 * 5. Client Code: Works with the NotificationSender and NotificationService 
 *    via their abstract interfaces, ensuring flexibility and decoupling.
 * 
 * Use Case:
 * Use the Factory Method pattern when a class needs to delegate the instantiation
 * of specific notification services to its subclasses or when you want to simplify 
 * object creation while adhering to the open/closed principle.
 */

// Abstract Creator
class NotificationSender {
    /**
     * Factory method to return the appropriate notification service.
     * This method must be implemented by subclasses.
     */
    getNotificationService() {
        throw new Error("You must implement the 'getNotificationService' method in a subclass.");
    }

    /**
     * Handles the notification sending logic using the service 
     * returned by the factory method.
     */
    sendNotification(message) {
        const service = this.getNotificationService();
        service.connect();
        service.send(message);
        service.disconnect();
    }
}

// Concrete Creator for sending email notifications
class EmailNotificationSender extends NotificationSender {
    constructor(email, password) {
        super();
        this.email = email;
        this.password = password;
    }

    getNotificationService() {
        return new EmailService(this.email, this.password);
    }
}

// Concrete Creator for sending SMS notifications
class SMSNotificationSender extends NotificationSender {
    constructor(phoneNumber) {
        super();
        this.phoneNumber = phoneNumber;
    }

    getNotificationService() {
        return new SMSService(this.phoneNumber);
    }
}

// Product Interface
class NotificationService {
    connect() {
        throw new Error("You must implement the 'connect' method.");
    }

    disconnect() {
        throw new Error("You must implement the 'disconnect' method.");
    }

    send(message) {
        throw new Error("You must implement the 'send' method.");
    }
}

// Concrete Product implementing the Email notification service
class EmailService extends NotificationService {
    constructor(email, password) {
        super();
        this.email = email;
        this.password = password;
    }

    connect() {
        console.log(`Connecting to email service with ${this.email}...`);
    }

    disconnect() {
        console.log("Disconnecting from email service...");
    }

    send(message) {
        console.log(`Sending email to ${this.email}: ${message}`);
    }
}

// Concrete Product implementing the SMS notification service
class SMSService extends NotificationService {
    constructor(phoneNumber) {
        super();
        this.phoneNumber = phoneNumber;
    }

    connect() {
        console.log(`Connecting to SMS service for ${this.phoneNumber}...`);
    }

    disconnect() {
        console.log("Disconnecting from SMS service...");
    }

    send(message) {
        console.log(`Sending SMS to ${this.phoneNumber}: ${message}`);
    }
}

// Client Code
function clientCode(sender, message) {
    sender.sendNotification(message);
}

// Example Usage
console.log("Sending Email Notification:");
clientCode(new EmailNotificationSender("john@example.com", "emailpassword"), "Hello via Email!");

console.log("\nSending SMS Notification:");
clientCode(new SMSNotificationSender("+123456789"), "Hello via SMS!");
