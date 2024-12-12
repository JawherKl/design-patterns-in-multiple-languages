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

package main

import (
	"fmt"
	"sync"
)

// DatabaseConnection Singleton
type DatabaseConnection struct {
	connection string
}

var instance *DatabaseConnection
var once sync.Once

// GetInstance returns the single instance of DatabaseConnection
func GetInstance() *DatabaseConnection {
	once.Do(func() {
		instance = &DatabaseConnection{
			connection: "Database Connection Established",
		}
	})
	return instance
}

// GetConnection returns the database connection
func (db *DatabaseConnection) GetConnection() string {
	return db.connection
}

func main() {
	// Client code
	db1 := GetInstance()
	fmt.Println(db1.GetConnection())

	db2 := GetInstance()
	if db1 == db2 {
		fmt.Println("Only one instance of DatabaseConnection exists.")
	}
}
