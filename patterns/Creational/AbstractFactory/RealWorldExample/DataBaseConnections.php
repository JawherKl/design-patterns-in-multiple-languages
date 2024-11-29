<?php

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Abstract Factory
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/AbstractFactory/RealWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\AbstractFactory\RealWorldExample;

/**
 * Abstract Factory interface for creating database connections and queries.
 */
interface DatabaseFactory
{
    public function createConnection(): Connection;
    public function createQuery(): Query;
}

/**
 * Concrete Factory for MySQL database.
 */
class MySQLFactory implements DatabaseFactory
{
    public function createConnection(): Connection
    {
        return new MySQLConnection();
    }

    public function createQuery(): Query
    {
        return new MySQLQuery();
    }
}

/**
 * Concrete Factory for PostgreSQL database.
 */
class PostgreSQLFactory implements DatabaseFactory
{
    public function createConnection(): Connection
    {
        return new PostgreSQLConnection();
    }

    public function createQuery(): Query
    {
        return new PostgreSQLQuery();
    }
}

/**
 * Abstract product interface for database connections.
 */
interface Connection
{
    public function connect(): string;
}

/**
 * Concrete product for MySQL connection.
 */
class MySQLConnection implements Connection
{
    public function connect(): string
    {
        return "Connected to MySQL database.";
    }
}

/**
 * Concrete product for PostgreSQL connection.
 */
class PostgreSQLConnection implements Connection
{
    public function connect(): string
    {
        return "Connected to PostgreSQL database.";
    }
}

/**
 * Abstract product interface for database queries.
 */
interface Query
{
    public function execute(): string;
}

/**
 * Concrete product for MySQL query.
 */
class MySQLQuery implements Query
{
    public function execute(): string
    {
        return "Executing MySQL query.";
    }
}

/**
 * Concrete product for PostgreSQL query.
 */
class PostgreSQLQuery implements Query
{
    public function execute(): string
    {
        return "Executing PostgreSQL query.";
    }
}

/**
 * Client code.
 */
function clientCode(DatabaseFactory $factory)
{
    $connection = $factory->createConnection();
    echo $connection->connect();

    $query = $factory->createQuery();
    echo $query->execute();
}

echo "Testing MySQL factory:\n";
clientCode(new MySQLFactory());
echo "\n\n";

echo "Testing PostgreSQL factory:\n";
clientCode(new PostgreSQLFactory());
