<?php

/*
|--------------------------------------------------------------------------
| Proxy Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Proxy Design Pattern, which provides an object
| that acts as an intermediary to control access to another object. Proxies
| typically handle operations such as lazy loading, caching, or access control
| to ensure that the real object is only accessed when necessary.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Structural/Proxy
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Subject Interface**: Declares common methods that both the RealSubject
|    and Proxy implement. This allows the client code to interact with either
|    the real object or the proxy without knowing the difference.
|
| 2. **RealSubject Class**: Contains the core business logic and actual
|    functionality that needs to be accessed. It performs the actual work but
|    may be slow or sensitive to direct access, making it a good candidate for
|    a proxy.
|
| 3. **Proxy Class**: Provides a controlled access point to the RealSubject.
|    It can add extra functionality such as lazy loading, caching, logging,
|    or access control. The Proxy delegates requests to the RealSubject after
|    performing any necessary checks or operations.
|
| 4. **Client Code**: Works with both the RealSubject and Proxy through the
|    Subject interface. The client does not need to know whether it is using
|    a real object or a proxy; it just calls the request method on the Subject.
|
| Benefits:
| - **Lazy Loading**: A Proxy can delay the creation or access to a resource
|   until it is actually needed.
| - **Access Control**: A Proxy can restrict access to the RealSubject by
|   performing security checks before forwarding the request.
| - **Enhanced Functionality**: A Proxy can add additional functionality such
|   as logging, caching, or monitoring to operations without modifying the
|   RealSubject itself.
|
| Drawbacks:
| - **Complexity**: Introducing a Proxy adds an extra layer of indirection,
|   which can make the system more complex to understand and maintain.
| - **Overhead**: Using a Proxy adds additional method calls and overhead, 
|   which may not be necessary for all applications.
*/

namespace Structural\Proxy\Conceptual;

/**
 * The Subject interface declares common operations for both RealSubject and the
 * Proxy. As long as the client works with RealSubject using this interface,
 * you'll be able to pass it a proxy instead of a real subject.
 */
interface Subject
{
    public function request(): void;
}

/**
 * The RealSubject contains some core business logic. Usually, RealSubjects are
 * capable of doing some useful work which may also be very slow or sensitive -
 * e.g. correcting input data. A Proxy can solve these issues without any
 * changes to the RealSubject's code.
 */
class RealSubject implements Subject
{
    public function request(): void
    {
        echo "RealSubject: Handling request.\n";
    }
}

/**
 * The Proxy has an interface identical to the RealSubject.
 */
class Proxy implements Subject
{
    /**
     * @var RealSubject
     */
    private $realSubject;

    /**
     * The Proxy maintains a reference to an object of the RealSubject class. It
     * can be either lazy-loaded or passed to the Proxy by the client.
     */
    public function __construct(RealSubject $realSubject)
    {
        $this->realSubject = $realSubject;
    }

    /**
     * The most common applications of the Proxy pattern are lazy loading,
     * caching, controlling the access, logging, etc. A Proxy can perform one of
     * these things and then, depending on the result, pass the execution to the
     * same method in a linked RealSubject object.
     */
    public function request(): void
    {
        if ($this->checkAccess()) {
            $this->realSubject->request();
            $this->logAccess();
        }
    }

    private function checkAccess(): bool
    {
        // Some real checks should go here.
        echo "Proxy: Checking access prior to firing a real request.\n";

        return true;
    }

    private function logAccess(): void
    {
        echo "Proxy: Logging the time of request.\n";
    }
}

/**
 * The client code is supposed to work with all objects (both subjects and
 * proxies) via the Subject interface in order to support both real subjects and
 * proxies. In real life, however, clients mostly work with their real subjects
 * directly. In this case, to implement the pattern more easily, you can extend
 * your proxy from the real subject's class.
 */
function clientCode(Subject $subject)
{
    // ...

    $subject->request();

    // ...
}

echo "Client: Executing the client code with a real subject:\n";
$realSubject = new RealSubject();
clientCode($realSubject);

echo "\n";

echo "Client: Executing the same client code with a proxy:\n";
$proxy = new Proxy($realSubject);
clientCode($proxy);