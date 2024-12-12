

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

class Singleton {
    static instance;

    static getInstance() {
        if (!this.instance) {
            this.instance = new this();
        }
        return this.instance;
    }
}

// Logger Singleton
class Logger extends Singleton {
    constructor() {
        super();
        if (Logger.instance) {
            return Logger.instance;
        }
        this.fileHandle = process.stdout;
        Logger.instance = this;
    }

    writeLog(message) {
        const date = new Date().toISOString().split('T')[0]; // Date in YYYY-MM-DD format
        this.fileHandle.write(`${date}: ${message}\n`);
    }

    static log(message) {
        const logger = Logger.getInstance();
        logger.writeLog(message);
    }
}

// Config Singleton
class Config extends Singleton {
    constructor() {
        super();
        if (Config.instance) {
            return Config.instance;
        }
        this.hashmap = {};
        Config.instance = this;
    }

    getValue(key) {
        return this.hashmap[key];
    }

    setValue(key, value) {
        this.hashmap[key] = value;
    }
}

// Client code
Logger.log("Started!");

// Compare values of Logger singleton.
const l1 = Logger.getInstance();
const l2 = Logger.getInstance();
if (l1 === l2) {
    Logger.log("Logger has a single instance.");
} else {
    Logger.log("Loggers are different.");
}

// Check how Config singleton saves data...
const config1 = Config.getInstance();
const login = "test_login";
const password = "test_password";
config1.setValue("login", login);
config1.setValue("password", password);

// ...and restores it.
const config2 = Config.getInstance();
if (login === config2.getValue("login") && password === config2.getValue("password")) {
    Logger.log("Config singleton also works fine.");
}

Logger.log("Finished!");
