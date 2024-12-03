Chain of Responsibility is behavioral design pattern that allows passing request along the chain of potential handlers until one of them handles request.

# Conceptual Example:
This example illustrates the structure of the Abstract Factory design pattern. It focuses on answering these questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:

## Middleware
The most widely known use of the Chain of Responsibility (CoR) pattern in the PHP world is found in HTTP request middleware. These are implemented by the most popular PHP frameworks and even got standardized as part of PSR-15.

It works like this: an HTTP request must pass through a stack of middleware objects in order to be handled by the app. Each middleware can either reject the further processing of the request or pass it to the next middleware. Once the request successfully passes all middleware, the primary handler of the app can finally handle it.

## ValidateOrder
this example using a scenario where a request goes through a chain of handlers to validate an order in an e-commerce application.

### Explanation:

1. **OrderHandler (Abstract Base Class):**
   - Defines the interface for handling the order and linking handlers into a chain.
   
2. **Concrete Handlers:**
   - `ItemsInOrderHandler`: Ensures the order contains at least one item.
   - `PaymentHandler`: Validates the payment method.
   - `ShippingAddressHandler`: Checks if the shipping address is provided.

3. **Client Code:**
   - Builds a chain of handlers and processes different orders to validate them sequentially.

### Output:
1. First order fails due to missing items.
2. Second order fails due to an invalid payment method.
3. Third order passes all checks and is processed successfully.

## CustomerSupportSystem
this example simulating a Customer Support System where a customer inquiry goes through different levels of support.

### Explanation:

1. **SupportHandler (Abstract Base Class):**
   - Declares the interface for handling support requests and passing them to the next handler.

2. **Concrete Handlers:**
   - `BasicSupportHandler`: Handles simple issues like password resets.
   - `TechnicalSupportHandler`: Handles technical issues like software bugs.
   - `ManagerSupportHandler`: Handles complex issues like billing problems.

3. **Client Code:**
   - Tests various cases to see how the chain handles different types of issues.

### Output:

```
Case 1: Password reset request:
BasicSupportHandler: Resolved the issue (Password reset).

Case 2: Software bug report:
BasicSupportHandler: Escalating the issue to the next level.
TechnicalSupportHandler: Resolved the issue (Software bug fix).

Case 3: Billing issue:
BasicSupportHandler: Escalating the issue to the next level.
TechnicalSupportHandler: Escalating the issue to the next level.
ManagerSupportHandler: Resolved the issue (Billing issue).

Case 4: Unknown issue:
BasicSupportHandler: Escalating the issue to the next level.
TechnicalSupportHandler: Escalating the issue to the next level.
ManagerSupportHandler: Unable to resolve the issue. Please contact higher management.
```