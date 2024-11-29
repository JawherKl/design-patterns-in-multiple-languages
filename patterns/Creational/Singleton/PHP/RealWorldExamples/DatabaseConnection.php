<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Database Connection Example
|--------------------------------------------------------------------------
| Implement Singleton Design Pattern for database connection management.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Singleton\RealWorldExamples;

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
