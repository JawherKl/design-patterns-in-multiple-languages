package main

import "fmt"

// NotificationFactory - Abstract Factory for creating notification services
type NotificationFactory interface {
    CreateEmailService() EmailService
    CreateSMSService() SMSService
}

// GmailFactory - Concrete Factory for Gmail notification services
type GmailFactory struct{}

func (g *GmailFactory) CreateEmailService() EmailService {
    return &GmailEmailService{}
}

func (g *GmailFactory) CreateSMSService() SMSService {
    return &GmailSMSService{}
}

// YahooFactory - Concrete Factory for Yahoo notification services
type YahooFactory struct{}

func (y *YahooFactory) CreateEmailService() EmailService {
    return &YahooEmailService{}
}

func (y *YahooFactory) CreateSMSService() SMSService {
    return &YahooSMSService{}
}

// EmailService - Abstract product interface for email services
type EmailService interface {
    SendEmail() string
}

// GmailEmailService - Concrete product for Gmail email service
type GmailEmailService struct{}

func (g *GmailEmailService) SendEmail() string {
    return "Sending email via Gmail."
}

// YahooEmailService - Concrete product for Yahoo email service
type YahooEmailService struct{}

func (y *YahooEmailService) SendEmail() string {
    return "Sending email via Yahoo."
}

// SMSService - Abstract product interface for SMS services
type SMSService interface {
    SendSMS() string
}

// GmailSMSService - Concrete product for Gmail SMS service
type GmailSMSService struct{}

func (g *GmailSMSService) SendSMS() string {
    return "Sending SMS via Gmail."
}

// YahooSMSService - Concrete product for Yahoo SMS service
type YahooSMSService struct{}

func (y *YahooSMSService) SendSMS() string {
    return "Sending SMS via Yahoo."
}

// Client function to send notifications
func sendNotifications(factory NotificationFactory) {
    emailService := factory.CreateEmailService()
    fmt.Println(emailService.SendEmail())

    smsService := factory.CreateSMSService()
    fmt.Println(smsService.SendSMS())
}

func main() {
    fmt.Println("Testing Gmail notification factory:")
    sendNotifications(&GmailFactory{})
    fmt.Println()

    fmt.Println("Testing Yahoo notification factory:")
    sendNotifications(&YahooFactory{})
}
