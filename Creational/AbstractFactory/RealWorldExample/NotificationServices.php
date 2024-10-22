<?php

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Abstract Factory
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/AbstractFactory/RealWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\AbstractFactory\RealWorldExample;


/**
 * Abstract Factory for creating notification services.
 */
interface NotificationFactory
{
    public function createEmailService(): EmailService;
    public function createSMSService(): SMSService;
}

/**
 * Concrete Factory for Gmail notification services.
 */
class GmailFactory implements NotificationFactory
{
    public function createEmailService(): EmailService
    {
        return new GmailEmailService();
    }

    public function createSMSService(): SMSService
    {
        return new GmailSMSService();
    }
}

/**
 * Concrete Factory for Yahoo notification services.
 */
class YahooFactory implements NotificationFactory
{
    public function createEmailService(): EmailService
    {
        return new YahooEmailService();
    }

    public function createSMSService(): SMSService
    {
        return new YahooSMSService();
    }
}

/**
 * Abstract product interface for email services.
 */
interface EmailService
{
    public function sendEmail(): string;
}

/**
 * Concrete product for Gmail email service.
 */
class GmailEmailService implements EmailService
{
    public function sendEmail(): string
    {
        return "Sending email via Gmail.";
    }
}

/**
 * Concrete product for Yahoo email service.
 */
class YahooEmailService implements EmailService
{
    public function sendEmail(): string
    {
        return "Sending email via Yahoo.";
    }
}

/**
 * Abstract product interface for SMS services.
 */
interface SMSService
{
    public function sendSMS(): string;
}

/**
 * Concrete product for Gmail SMS service.
 */
class GmailSMSService implements SMSService
{
    public function sendSMS(): string
    {
        return "Sending SMS via Gmail.";
    }
}

/**
 * Concrete product for Yahoo SMS service.
 */
class YahooSMSService implements SMSService
{
    public function sendSMS(): string
    {
        return "Sending SMS via Yahoo.";
    }
}

/**
 * Client code.
 */
function sendNotifications(NotificationFactory $factory)
{
    $emailService = $factory->createEmailService();
    echo $emailService->sendEmail();

    $smsService = $factory->createSMSService();
    echo $smsService->sendSMS();
}

echo "Testing Gmail notification factory:\n";
sendNotifications(new GmailFactory());
echo "\n\n";

echo "Testing Yahoo notification factory:\n";
sendNotifications(new YahooFactory());
