package main

import "fmt"

// Command interface
type Command interface {
    Execute()
    Undo()
}

// Receiver: Smart Light
type Light struct{}

func (l *Light) TurnOn() {
    fmt.Println("Light: Turned on")
}

func (l *Light) TurnOff() {
    fmt.Println("Light: Turned off")
}

// Receiver: Thermostat
type Thermostat struct{}

func (t *Thermostat) SetTemperature(temp int) {
    fmt.Printf("Thermostat: Set temperature to %d°C\n", temp)
}

func (t *Thermostat) Reset() {
    fmt.Println("Thermostat: Reset to default temperature")
}

// Receiver: Security System
type SecuritySystem struct{}

func (s *SecuritySystem) Activate() {
    fmt.Println("SecuritySystem: Activated")
}

func (s *SecuritySystem) Deactivate() {
    fmt.Println("SecuritySystem: Deactivated")
}

// Concrete Command: Light On Command
type LightOnCommand struct {
    light *Light
}

func (c *LightOnCommand) Execute() {
    c.light.TurnOn()
}

func (c *LightOnCommand) Undo() {
    c.light.TurnOff()
}

// Concrete Command: Thermostat Set Command
type ThermostatSetCommand struct {
    thermostat  *Thermostat
    temperature int
}

func (c *ThermostatSetCommand) Execute() {
    c.thermostat.SetTemperature(c.temperature)
}

func (c *ThermostatSetCommand) Undo() {
    c.thermostat.Reset()
}

// Concrete Command: Security System Activate Command
type SecuritySystemActivateCommand struct {
    securitySystem *SecuritySystem
}

func (c *SecuritySystemActivateCommand) Execute() {
    c.securitySystem.Activate()
}

func (c *SecuritySystemActivateCommand) Undo() {
    c.securitySystem.Deactivate()
}

// Invoker: Home Automation Controller
type HomeAutomationController struct {
    commandHistory []Command
}

func (h *HomeAutomationController) ExecuteCommand(cmd Command) {
    cmd.Execute()
    h.commandHistory = append(h.commandHistory, cmd)
}

func (h *HomeAutomationController) UndoLastCommand() {
    if len(h.commandHistory) > 0 {
        lastCmd := h.commandHistory[len(h.commandHistory)-1]
        h.commandHistory = h.commandHistory[:len(h.commandHistory)-1]
        lastCmd.Undo()
    }
}

func main() {
    // Receivers
    light := &Light{}
    thermostat := &Thermostat{}
    securitySystem := &SecuritySystem{}

    // Commands
    lightOn := &LightOnCommand{light}
    thermostatSet := &ThermostatSetCommand{thermostat, 22}
    securityActivate := &SecuritySystemActivateCommand{securitySystem}

    // Invoker
    controller := &HomeAutomationController{}

    // Execute commands
    controller.ExecuteCommand(lightOn)
    controller.ExecuteCommand(thermostatSet)
    controller.ExecuteCommand(securityActivate)

    fmt.Println("\n--- Undo Last Command ---")
    controller.UndoLastCommand()

    fmt.Println("\n--- Undo Another Command ---")
    controller.UndoLastCommand()

    fmt.Println("\n--- Undo Last Command ---")
    controller.UndoLastCommand()
}
