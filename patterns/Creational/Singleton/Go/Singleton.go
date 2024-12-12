/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern, which ensures a 
| class has only one instance and provides a global point of access to it.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-go
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method for managing 
|    the single instance.
| 2. **Static Instance Storage**: Ensures only one instance per subclass.
| 3. **Client Code**: Demonstrates that the same instance is returned.
|
| Use Case:
| Use the Singleton pattern when only one instance of a class should exist, 
| such as in managing database connections or configuration settings.
*/

package main

import (
	"fmt"
	"sync"
)

type Singleton struct {
	// Define the Singleton's properties here
}

var instance *Singleton
var mu sync.Mutex

// GetInstance ensures that only one instance of the Singleton class is created
func GetInstance() *Singleton {
	mu.Lock()
	defer mu.Unlock()

	if instance == nil {
		instance = &Singleton{}
	}
	return instance
}

func (s *Singleton) SomeBusinessLogic() {
	// Add your business logic here
}

func main() {
	s1 := GetInstance()
	s2 := GetInstance()

	if s1 == s2 {
		fmt.Println("Singleton works, both variables contain the same instance.")
	} else {
		fmt.Println("Singleton failed, variables contain different instances.")
	}
}
