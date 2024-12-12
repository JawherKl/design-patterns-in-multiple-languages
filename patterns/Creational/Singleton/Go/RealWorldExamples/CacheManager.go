/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Cache Manager Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing a 
| cache system, ensuring that only one instance of the cache manager 
| exists and is used throughout the application.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method to manage 
|    the single instance of the cache manager.
| 2. **Static Instance Storage**: Ensures only one instance of the cache 
|    manager is created.
| 3. **Client Code**: Demonstrates caching data using the singleton cache 
|    manager instance.
|
| Use Case:
| Use the Singleton pattern to manage a global cache system, ensuring that 
| all parts of the application access and modify the cache through the 
| same instance, optimizing memory and performance.
*/

package main

import (
	"fmt"
	"sync"
)

// CacheManager Singleton
type CacheManager struct {
	cache map[string]interface{}
	mu    sync.RWMutex
}

var instance *CacheManager
var once sync.Once

// GetInstance returns the single instance of CacheManager
func GetInstance() *CacheManager {
	once.Do(func() {
		instance = &CacheManager{
			cache: make(map[string]interface{}),
		}
	})
	return instance
}

// Set adds a value to the cache
func (c *CacheManager) Set(key string, value interface{}) {
	c.mu.Lock()
	defer c.mu.Unlock()
	c.cache[key] = value
}

// Get retrieves a value from the cache
func (c *CacheManager) Get(key string) interface{} {
	c.mu.RLock()
	defer c.mu.RUnlock()
	return c.cache[key]
}

func main() {
	// Client code
	cache := GetInstance()
	cache.Set("user_1", map[string]string{"name": "John Doe", "email": "john@example.com"})

	user := cache.Get("user_1")
	fmt.Printf("Cached User: %v\n", user)
}
