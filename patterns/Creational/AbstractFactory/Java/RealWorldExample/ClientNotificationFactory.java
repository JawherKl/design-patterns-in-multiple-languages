package patterns.Creational.AbstractFactory.Java.RealWorldExample;

// Abstract Factory for creating notification services
interface NotificationFactory {
    EmailService createEmailService();
    SMSService createSMSService();
}

// Concrete Factory for Gmail notification services
class GmailFactory implements NotificationFactory {
    @Override
    public EmailService createEmailService() {
        return new GmailEmailService();
    }

    @Override
    public SMSService createSMSService() {
        return new GmailSMSService();
    }
}

// Concrete Factory for Yahoo notification services
class YahooFactory implements NotificationFactory {
    @Override
    public EmailService createEmailService() {
        return new YahooEmailService();
    }

    @Override
    public SMSService createSMSService() {
        return new YahooSMSService();
    }
}

// Abstract product interface for email services
interface EmailService {
    String sendEmail();
}

// Concrete product for Gmail email service
class GmailEmailService implements EmailService {
    @Override
    public String sendEmail() {
        return "Sending email via Gmail.";
    }
}

// Concrete product for Yahoo email service
class YahooEmailService implements EmailService {
    @Override
    public String sendEmail() {
        return "Sending email via Yahoo.";
    }
}

// Abstract product interface for SMS services
interface SMSService {
    String sendSMS();
}

// Concrete product for Gmail SMS service
class GmailSMSService implements SMSService {
    @Override
    public String sendSMS() {
        return "Sending SMS via Gmail.";
    }
}

// Concrete product for Yahoo SMS service
class YahooSMSService implements SMSService {
    @Override
    public String sendSMS() {
        return "Sending SMS via Yahoo.";
    }
}

// Client code
public class ClientNotificationFactory {
    public static void sendNotifications(NotificationFactory factory) {
        EmailService emailService = factory.createEmailService();
        System.out.println(emailService.sendEmail());

        SMSService smsService = factory.createSMSService();
        System.out.println(smsService.sendSMS());
    }

    public static void main(String[] args) {
        System.out.println("Testing Gmail notification factory:");
        sendNotifications(new GmailFactory());
        System.out.println();

        System.out.println("Testing Yahoo notification factory:");
        sendNotifications(new YahooFactory());
    }
}
