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

use Creational\Singleton\Singleton;

/**
 * Database Connection Singleton
 */
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
