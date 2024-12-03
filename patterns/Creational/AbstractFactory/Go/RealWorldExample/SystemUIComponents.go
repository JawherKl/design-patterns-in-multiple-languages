package main

import "fmt"

// UIFactory - Abstract Factory for creating UI components
type UIFactory interface {
    CreateButton() Button
    CreateCheckbox() Checkbox
}

// WindowsFactory - Concrete Factory for Windows OS
type WindowsFactory struct{}

func (w *WindowsFactory) CreateButton() Button {
    return &WindowsButton{}
}

func (w *WindowsFactory) CreateCheckbox() Checkbox {
    return &WindowsCheckbox{}
}

// MacFactory - Concrete Factory for Mac OS
type MacFactory struct{}

func (m *MacFactory) CreateButton() Button {
    return &MacButton{}
}

func (m *MacFactory) CreateCheckbox() Checkbox {
    return &MacCheckbox{}
}

// Button - Abstract product interface for buttons
type Button interface {
    Render() string
}

// WindowsButton - Concrete product for Windows button
type WindowsButton struct{}

func (w *WindowsButton) Render() string {
    return "Rendering Windows button."
}

// MacButton - Concrete product for Mac button
type MacButton struct{}

func (m *MacButton) Render() string {
    return "Rendering Mac button."
}

// Checkbox - Abstract product interface for checkboxes
type Checkbox interface {
    Toggle() string
}

// WindowsCheckbox - Concrete product for Windows checkbox
type WindowsCheckbox struct{}

func (w *WindowsCheckbox) Toggle() string {
    return "Toggling Windows checkbox."
}

// MacCheckbox - Concrete product for Mac checkbox
type MacCheckbox struct{}

func (m *MacCheckbox) Toggle() string {
    return "Toggling Mac checkbox."
}

// Client function to render UI components
func renderUI(factory UIFactory) {
    button := factory.CreateButton()
    fmt.Println(button.Render())

    checkbox := factory.CreateCheckbox()
    fmt.Println(checkbox.Toggle())
}

func main() {
    fmt.Println("Testing Windows UI factory:")
    renderUI(&WindowsFactory{})
    fmt.Println()

    fmt.Println("Testing Mac UI factory:")
    renderUI(&MacFactory{})
}
