package RealWorldExample;

import java.util.Stack;

// Command Interface
interface Command {
    void execute();
    void undo();
}

// Receiver: Smart Light
class Light {
    public void turnOn() {
        System.out.println("Light: Turned on");
    }

    public void turnOff() {
        System.out.println("Light: Turned off");
    }
}

// Receiver: Thermostat
class Thermostat {
    public void setTemperature(int temperature) {
        System.out.printf("Thermostat: Set temperature to %d°C%n", temperature);
    }

    public void reset() {
        System.out.println("Thermostat: Reset to default temperature");
    }
}

// Receiver: Security System
class SecuritySystem {
    public void activate() {
        System.out.println("SecuritySystem: Activated");
    }

    public void deactivate() {
        System.out.println("SecuritySystem: Deactivated");
    }
}

// Concrete Command: Light On Command
class LightOnCommand implements Command {
    private Light light;

    public LightOnCommand(Light light) {
        this.light = light;
    }

    @Override
    public void execute() {
        light.turnOn();
    }

    @Override
    public void undo() {
        light.turnOff();
    }
}

// Concrete Command: Thermostat Set Command
class ThermostatSetCommand implements Command {
    private Thermostat thermostat;
    private int temperature;

    public ThermostatSetCommand(Thermostat thermostat, int temperature) {
        this.thermostat = thermostat;
        this.temperature = temperature;
    }

    @Override
    public void execute() {
        thermostat.setTemperature(temperature);
    }

    @Override
    public void undo() {
        thermostat.reset();
    }
}

// Concrete Command: Security System Activate Command
class SecuritySystemActivateCommand implements Command {
    private SecuritySystem securitySystem;

    public SecuritySystemActivateCommand(SecuritySystem securitySystem) {
        this.securitySystem = securitySystem;
    }

    @Override
    public void execute() {
        securitySystem.activate();
    }

    @Override
    public void undo() {
        securitySystem.deactivate();
    }
}

// Invoker: Home Automation Controller
class HomeAutomationController {
    private Stack<Command> commandHistory = new Stack<>();

    public void executeCommand(Command command) {
        command.execute();
        commandHistory.push(command);
    }

    public void undoLastCommand() {
        if (!commandHistory.isEmpty()) {
            Command lastCommand = commandHistory.pop();
            lastCommand.undo();
        }
    }
}

// Client Code
public class HomeAutomationExample {
    public static void main(String[] args) {
        // Receivers
        Light light = new Light();
        Thermostat thermostat = new Thermostat();
        SecuritySystem securitySystem = new SecuritySystem();

        // Commands
        Command lightOn = new LightOnCommand(light);
        Command thermostatSet = new ThermostatSetCommand(thermostat, 22);
        Command securityActivate = new SecuritySystemActivateCommand(securitySystem);

        // Invoker
        HomeAutomationController controller = new HomeAutomationController();

        // Execute commands
        controller.executeCommand(lightOn);           // Turn on the light
        controller.executeCommand(thermostatSet);     // Set thermostat to 22°C
        controller.executeCommand(securityActivate);  // Activate security system

        System.out.println("\n--- Undo Last Command ---");
        controller.undoLastCommand(); // Deactivate security system

        System.out.println("\n--- Undo Another Command ---");
        controller.undoLastCommand(); // Reset thermostat

        System.out.println("\n--- Undo Last Command ---");
        controller.undoLastCommand(); // Turn off the light
    }
}
