# Strategy Pattern

Strategy is a behavioral design pattern that turns a set of behaviors into objects and makes them interchangeable inside the original context object.

The original object, called context, holds a reference to a strategy object. The context delegates executing the behavior to the linked strategy object. In order to change the way the context performs its work, other objects may replace the currently linked strategy object with another one.

# Real World Example
## Payment Methods
In this example, the Strategy pattern is used to represent payment methods in an e-commerce application.

Each payment method can display a payment form to collect proper payment details from a user and send it to the payment processing company. Then, after the payment processing company redirects the user back to the application, the payment method will handle the response to complete the transaction.

### Examples of Payment Methods Implemented:
1. **Credit Card Payment (PHP)**
   - Displays a form to collect credit card details (e.g., card number, expiration date, CVV).
   - Sends the collected details to a credit card processing company.
   - Handles the response from the processing company.

2. **PayPal Payment (PHP)**
   - Redirects the user to PayPal to log in and approve the payment.
   - Handles the response from PayPal to complete the transaction.

3. **Bank Transfer Payment**
   - Displays a form to collect bank account details (e.g., account number, bank code).
   - Sends the collected details to a bank for processing the transfer.
   - Handles the response from the bank to confirm the payment.

### Main Example in PHP
The main example of the Strategy pattern implemented in PHP demonstrates how different algorithms can be defined and encapsulated within separate classes. The context class then uses these strategies interchangeably.

1. **Context Class**:
   - Holds a reference to a strategy object.
   - Delegates executing the behavior to the linked strategy object.

2. **Strategy Interface**:
   - Defines a common interface for all concrete strategies.

3. **Concrete Strategies**:
   - Implement different algorithms that the context can use interchangeably.

By using the Strategy pattern, the e-commerce application can easily switch between different payment methods without changing the code that handles the payment process. Each payment method implements a common interface, allowing the context object to interact with each method in a consistent manner. This makes the system flexible and easy to extend with new payment methods in the future.
