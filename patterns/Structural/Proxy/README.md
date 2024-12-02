Proxy is a structural design pattern that provides an object that acts as a substitute for a real service object used by a client. A proxy receives client requests, does some work (access control, caching, etc.) and then passes the request to a service object.

The proxy object has the same interface as a service, which makes it interchangeable with a real object when passed to a client.

# Conceptual Example:
This example illustrates the structure of the Bridge design pattern and focuses on the following questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:
## Downloader
This example demonstrates how the Proxy pattern can improve the performance of a downloader object by caching its results.

## Image
The Subject interface defines the common interface for both the RealSubject and the Proxy. In this example, we are simulating an online image loading service.

### Explanation:
1. **Subject Interface:**
   - `Image`: Defines the `display()` method that both `RealImage` and `ProxyImage` implement.

2. **RealSubject:**
   - `RealImage`: Represents the actual image that performs the work of loading and displaying an image.

3. **Proxy:**
   - `ProxyImage`: Controls access to the `RealImage`. It delays the loading process by caching the image after the first load. It checks if the image is already loaded and if so, it simply displays it.

4. **Client Code:**
   - The client interacts with the `Image` interface, which means it can use either `RealImage` or `ProxyImage` without knowing the difference. In the case of `ProxyImage`, it saves resources by caching the result and reusing it.

This examples demonstrates the **Proxy** pattern for optimizing the loading of resources and caching. The `Proxy` provides a simplified and efficient way to manage resource-heavy operations.
