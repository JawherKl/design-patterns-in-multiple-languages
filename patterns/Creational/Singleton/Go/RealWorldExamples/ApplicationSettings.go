/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Application Settings Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing 
| application settings, ensuring that only one instance of the settings 
| is created and accessed globally.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-go
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method to manage 
|    the single instance of the settings.
| 2. **Static Instance Storage**: Ensures only one instance of the class 
|    is created.
| 3. **Client Code**: Demonstrates accessing and modifying the singleton 
|    instance to manage application settings.
|
| Use Case:
| Use the Singleton pattern to manage a global instance that holds 
| application-wide settings, ensuring that all parts of the application 
| work with the same configuration.
*/

package main

import (
	"fmt"
	"sync"
)

type AppSettings struct {
	settings map[string]string
}

var instance *AppSettings
var mu sync.Mutex

// GetInstance ensures that only one instance of the AppSettings class is created
func GetInstance() *AppSettings {
	mu.Lock()
	defer mu.Unlock()

	if instance == nil {
		instance = &AppSettings{
			settings: map[string]string{
				"appName": "My Application",
				"version": "1.0.0",
			},
		}
	}
	return instance
}

// GetSetting retrieves the setting by key
func (a *AppSettings) GetSetting(key string) string {
	return a.settings[key]
}

// SetSetting sets a value for a given setting key
func (a *AppSettings) SetSetting(key, value string) {
	a.settings[key] = value
}

func main() {
	// Client code
	appSettings := GetInstance()
	fmt.Println("App Name:", appSettings.GetSetting("appName"))

	appSettings.SetSetting("version", "1.0.1")
	fmt.Println("Updated Version:", appSettings.GetSetting("version"))
}
