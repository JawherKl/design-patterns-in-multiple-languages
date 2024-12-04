Command is a behavioral design pattern that turns a request into a stand-alone object that contains all information about the request. This transformation lets you pass requests as a method arguments, delay or queue a request’s execution, and support undoable operations.

# Conceptual Example:
This example illustrates the structure of the Abstract Factory design pattern. It focuses on answering these questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:
## WebScraping
In this example, the Command pattern is used to queue web scraping calls to the IMDB website and execute them one by one. The queue itself is kept in a database that helps to preserve commands between script launches.

## DocumentProcessing
this example simulating a Document Processing System where multiple commands (such as printing, saving, and converting documents) are queued and executed

### Explanation:

1. **Command Interface:**
   - Defines the basic methods (`execute()`, `getId()`, and `getStatus()`) that concrete command classes must implement.

2. **Abstract Command Class (`DocumentCommand`):**
   - The base class for all specific document commands, holding common logic like handling status and document details. Each specific command class must implement the `process()` method.

3. **Concrete Command Classes:**
   - `PrintDocumentCommand`: Represents the command to print a document.
   - `SaveDocumentCommand`: Represents the command to save a document.
   - `ConvertDocumentCommand`: Represents the command to convert a document to another format.

4. **Queue Class:**
   - Manages the execution of the commands. It simulates a job queue by saving commands in an SQLite database, retrieving and executing them sequentially.

5. **Client Code:**
   - Adds different document-related commands to the queue and processes them sequentially.

### Output:
```
PrintDocumentCommand: Printing document 'Document1.pdf'.
SaveDocumentCommand: Saving document 'Document1.pdf'.
ConvertDocumentCommand: Converting document 'Document1.pdf'.
```

## HomeAutomation
A Home Automation System with multiple commands for controlling smart devices (e.g., lights, thermostat, and security system). This example integrates different home appliances and provides an interface to execute commands based on user inputs.

### **Explanation:**
1. **Command Interface:**
   - The `Command` interface defines two methods: `execute()` (to execute the command) and `undo()` (to undo the command).

2. **Receivers (Smart Devices):**
   - **Light**: Has methods to turn on and off the light.
   - **Thermostat**: Has methods to set the temperature and reset to default.
   - **SecuritySystem**: Has methods to activate and deactivate the security system.

3. **Concrete Command Classes:**
   - `LightOnCommand`: Turns on the light.
   - `ThermostatSetCommand`: Sets the thermostat to a specific temperature.
   - `SecuritySystemActivateCommand`: Activates the security system.

4. **Invoker (Home Automation Controller):**
   - `HomeAutomationController`: Holds a history of executed commands and provides a method to execute and undo commands.

5. **Client Code:**
   - The client creates the `Light`, `Thermostat`, and `SecuritySystem` objects (the receivers), then creates concrete commands to control them.
   - The `HomeAutomationController` acts as an invoker, executing and storing commands, and allows the undoing of previously executed commands.

### **Output:**
```
Light: Turned on
Thermostat: Set temperature to 22°C
SecuritySystem: Activated

--- Undo Last Command ---
SecuritySystem: Deactivated

--- Undo Another Command ---
Thermostat: Reset to default temperature

--- Undo Last Command ---
Light: Turned off
```