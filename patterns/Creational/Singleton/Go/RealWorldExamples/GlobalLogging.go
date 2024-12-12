/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Global Logging Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern, applied to a 
| logging system. It ensures that only one instance of the Logger class 
| is used throughout the application, providing a global access point 
| for logging.
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
|    only one instance of the Logger class is created.
| 2. **Logger Class**: Provides the logging functionality and ensures 
|    that the log file is managed by a single instance.
| 3. **Config Class**: Demonstrates another application of the Singleton 
|    pattern, storing application configuration settings globally.
|
| Use Case:
| Use the Singleton pattern when you need a single, global point of access 
| to an object, such as logging or configuration management, ensuring that 
| only one instance exists to manage resources like file handles or 
| settings.
*/
package main

import (
	"fmt"
	"sync"
	"time"
)

// Singleton base class
type Singleton struct{}

var instances = make(map[string]*Singleton)
var once sync.Once

func (s *Singleton) getInstance() *Singleton {
	once.Do(func() {
		instances["Singleton"] = &Singleton{}
	})
	return instances["Singleton"]
}

// Logger Singleton
type Logger struct {
	fileHandle *string
}

var loggerInstance *Logger

func GetLoggerInstance() *Logger {
	if loggerInstance == nil {
		loggerInstance = &Logger{fileHandle: new(string)}
	}
	return loggerInstance
}

func (logger *Logger) writeLog(message string) {
	date := time.Now().Format("2006-01-02")
	fmt.Printf("%s: %s\n", date, message)
}

func Log(message string) {
	logger := GetLoggerInstance()
	logger.writeLog(message)
}

// Config Singleton
type Config struct {
	hashmap map[string]string
}

var configInstance *Config

func GetConfigInstance() *Config {
	if configInstance == nil {
		configInstance = &Config{hashmap: make(map[string]string)}
	}
	return configInstance
}

func (config *Config) getValue(key string) string {
	return config.hashmap[key]
}

func (config *Config) setValue(key, value string) {
	config.hashmap[key] = value
}

func main() {
	// Client code
	Log("Started!")

	// Compare values of Logger singleton.
	l1 := GetLoggerInstance()
	l2 := GetLoggerInstance()
	if l1 == l2 {
		Log("Logger has a single instance.")
	} else {
		Log("Loggers are different.")
	}

	// Check how Config singleton saves data...
	config1 := GetConfigInstance()
	login := "test_login"
	password := "test_password"
	config1.setValue("login", login)
	config1.setValue("password", password)

	// ...and restores it.
	config2 := GetConfigInstance()
	if login == config2.getValue("login") && password == config2.getValue("password") {
		Log("Config singleton also works fine.")
	}

	Log("Finished!")
}
