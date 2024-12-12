<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Database Connection Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing a 
| database connection, ensuring that only one instance of the connection 
| is created and used throughout the application.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method to ensure 
|    only one instance of the database connection is created.
| 2. **Static Instance Storage**: Ensures that the same instance of the 
|    database connection is used throughout the application.
| 3. **Client Code**: Demonstrates using the Singleton to retrieve the 
|    database connection, ensuring that only one connection instance exists.
|
| Use Case:
| Use the Singleton pattern to manage a global database connection in an 
| application, ensuring that all parts of the application use the same 
| connection instance, optimizing resource management.
*/

namespace Creational\Singleton\RealWorldExamples;


/**
 * Database Connection Singleton
 */
class Singleton
{
    /**
     * The actual singleton's instance almost always resides inside a static
     * field. In this case, the static field is an array, where each subclass of
     * the Singleton stores its own instance.
     */
    private static $instances = [];

    /**
     * Singleton's constructor should not be public. However, it can't be
     * private either if we want to allow subclassing.
     */
    protected function __construct() { }

    /**
     * Cloning and unserialization are not permitted for singletons.
     */
    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * The method you use to get the Singleton's instance.
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            // Note that here we use the "static" keyword instead of the actual
            // class name. In this context, the "static" keyword means "the name
            // of the current class". That detail is important because when the
            // method is called on the subclass, we want an instance of that
            // subclass to be created here.

            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }
}
class DatabaseConnection extends Singleton
{
    private $connection;

    protected function __construct()
    {
        // Simulating a database connection
        $this->connection = "Database Connection Established";
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

// Client code
$db1 = DatabaseConnection::getInstance();
echo $db1->getConnection() . "\n";

$db2 = DatabaseConnection::getInstance();
if ($db1 === $db2) {
    echo "Only one instance of DatabaseConnection exists.\n";
}
