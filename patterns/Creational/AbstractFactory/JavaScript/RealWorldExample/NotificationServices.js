// NotificationFactory.js - Abstract Factory for creating notification services
class NotificationFactory {
    createEmailService() {
      throw new Error("Method 'createEmailService()' must be implemented.");
    }
  
    createSMSService() {
      throw new Error("Method 'createSMSService()' must be implemented.");
    }
  }
  
  // GmailFactory.js - Concrete Factory for Gmail notification services
  class GmailFactory extends NotificationFactory {
    createEmailService() {
      return new GmailEmailService();
    }
  
    createSMSService() {
      return new GmailSMSService();
    }
  }
  
  // YahooFactory.js - Concrete Factory for Yahoo notification services
  class YahooFactory extends NotificationFactory {
    createEmailService() {
      return new YahooEmailService();
    }
  
    createSMSService() {
      return new YahooSMSService();
    }
  }
  
  // EmailService.js - Abstract product interface for email services
  class EmailService {
    sendEmail() {
      throw new Error("Method 'sendEmail()' must be implemented.");
    }
  }
  
  // GmailEmailService.js - Concrete product for Gmail email service
  class GmailEmailService extends EmailService {
    sendEmail() {
      return "Sending email via Gmail.";
    }
  }
  
  // YahooEmailService.js - Concrete product for Yahoo email service
  class YahooEmailService extends EmailService {
    sendEmail() {
      return "Sending email via Yahoo.";
    }
  }
  
  // SMSService.js - Abstract product interface for SMS services
  class SMSService {
    sendSMS() {
      throw new Error("Method 'sendSMS()' must be implemented.");
    }
  }
  
  // GmailSMSService.js - Concrete product for Gmail SMS service
  class GmailSMSService extends SMSService {
    sendSMS() {
      return "Sending SMS via Gmail.";
    }
  }
  
  // YahooSMSService.js - Concrete product for Yahoo SMS service
  class YahooSMSService extends SMSService {
    sendSMS() {
      return "Sending SMS via Yahoo.";
    }
  }
  
  // Client.js - Client code
  function sendNotifications(factory) {
    const emailService = factory.createEmailService();
    console.log(emailService.sendEmail());
  
    const smsService = factory.createSMSService();
    console.log(smsService.sendSMS());
  }
  
  // Usage
  console.log("Testing Gmail notification factory:");
  sendNotifications(new GmailFactory());
  console.log("\n");
  
  console.log("Testing Yahoo notification factory:");
  sendNotifications(new YahooFactory());
  