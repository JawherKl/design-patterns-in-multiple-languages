class Command {
    execute() {}
    undo() {}
}

class Light {
    turnOn() {
        console.log("Light: Turned on");
    }

    turnOff() {
        console.log("Light: Turned off");
    }
}

class Thermostat {
    setTemperature(temperature) {
        console.log(`Thermostat: Set temperature to ${temperature}°C`);
    }

    reset() {
        console.log("Thermostat: Reset to default temperature");
    }
}

class SecuritySystem {
    activate() {
        console.log("SecuritySystem: Activated");
    }

    deactivate() {
        console.log("SecuritySystem: Deactivated");
    }
}

class LightOnCommand extends Command {
    constructor(light) {
        super();
        this.light = light;
    }

    execute() {
        this.light.turnOn();
    }

    undo() {
        this.light.turnOff();
    }
}

class ThermostatSetCommand extends Command {
    constructor(thermostat, temperature) {
        super();
        this.thermostat = thermostat;
        this.temperature = temperature;
    }

    execute() {
        this.thermostat.setTemperature(this.temperature);
    }

    undo() {
        this.thermostat.reset();
    }
}

class SecuritySystemActivateCommand extends Command {
    constructor(securitySystem) {
        super();
        this.securitySystem = securitySystem;
    }

    execute() {
        this.securitySystem.activate();
    }

    undo() {
        this.securitySystem.deactivate();
    }
}

class HomeAutomationController {
    constructor() {
        this.commandHistory = [];
    }

    executeCommand(command) {
        command.execute();
        this.commandHistory.push(command);
    }

    undoLastCommand() {
        if (this.commandHistory.length > 0) {
            const command = this.commandHistory.pop();
            command.undo();
        }
    }
}

// Client Code
const light = new Light();
const thermostat = new Thermostat();
const securitySystem = new SecuritySystem();

const lightOn = new LightOnCommand(light);
const thermostatSet = new ThermostatSetCommand(thermostat, 22);
const securityActivate = new SecuritySystemActivateCommand(securitySystem);

const controller = new HomeAutomationController();

// Execute commands
controller.executeCommand(lightOn); // Turn on the light
controller.executeCommand(thermostatSet); // Set thermostat to 22°C
controller.executeCommand(securityActivate); // Activate security system

console.log("\n--- Undo Last Command ---\n");

// Undo the last command (deactivate security system)
controller.undoLastCommand();

console.log("\n--- Undo Another Command ---\n");

// Undo the second last command (reset thermostat)
controller.undoLastCommand();

console.log("\n--- Undo Last Command ---\n");

// Undo the last command (turn off the light)
controller.undoLastCommand();
