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
| @link      https://github.com/JawherKl/design-patterns-in-js
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

class DatabaseConnection {
    static instance;

    constructor() {
        if (DatabaseConnection.instance) {
            throw new Error("DatabaseConnection is a singleton and cannot be instantiated directly.");
        }
        this.connection = "Database Connection Established";
        DatabaseConnection.instance = this;
    }

    // Accessor for the singleton instance
    static getInstance() {
        if (!DatabaseConnection.instance) {
            new DatabaseConnection(); // Initialize the instance
        }
        return DatabaseConnection.instance;
    }

    // Get the connection
    getConnection() {
        return this.connection;
    }
}

// Client code
const db1 = DatabaseConnection.getInstance();
console.log(db1.getConnection());

const db2 = DatabaseConnection.getInstance();
if (db1 === db2) {
    console.log("Only one instance of DatabaseConnection exists.");
}
