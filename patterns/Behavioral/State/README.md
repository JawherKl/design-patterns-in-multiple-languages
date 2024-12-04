State is a behavioral design pattern that allows an object to change the behavior when its internal state changes.

The pattern extracts state-related behaviors into separate state classes and forces the original object to delegate the work to an instance of these classes, instead of acting on its own.





# RealWorldExample:
## OrderProcess:
 In this example, we simulate a simple Order Process where an order can be in one of several states: New, Shipped, or Delivered. The Order class changes its behavior depending on the current state.

### Explanation:

1. **OrderState Interface**:
   - The `OrderState` interface defines the `handleOrder()` method, which is implemented by each concrete state to handle the order in that specific state.

2. **Concrete States**:
   - `NewOrderState`: The order is new, and the action transitions the order to the `ShippedOrderState`.
   - `ShippedOrderState`: The order is shipped, and the action transitions the order to the `DeliveredOrderState`.
   - `DeliveredOrderState`: The order has been delivered, and no further state transitions occur.

3. **Order Class (Context)**:
   - The `Order` class holds the current state and allows transitions between states using the `setState()` method. The `processOrder()` method delegates the behavior to the current state.

4. **Client Code**:
   - In the client code, we create an `Order` object, and then we call `processOrder()` to simulate the order's journey from `New` to `Shipped` to `Delivered`.

### Output:

```
Processing the order:
Order is new. Processing the order.
Order has been shipped. Waiting for delivery.
Order has been delivered. Thank you for your purchase!
```