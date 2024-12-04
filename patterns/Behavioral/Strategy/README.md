Strategy is a behavioral design pattern that turns a set of behaviors into objects and makes them interchangeable inside original context object.

The original object, called context, holds a reference to a strategy object. The context delegates executing the behavior to the linked strategy object. In order to change the way the context performs its work, other objects may replace the currently linked strategy object with another one.


# RealWorldExamle
## PaymentMethods
In this example, the Strategy pattern is used to represent payment methods in an e-commerce application.

Each payment method can display a payment form to collect proper payment details from a user and send it to the payment processing company. Then, after the payment processing company redirects the user back to our website, the payment method validates the return parameters and helps to decide whether the order was completed.