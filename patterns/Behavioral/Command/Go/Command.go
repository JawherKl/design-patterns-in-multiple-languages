package main

import "fmt"

/*
|--------------------------------------------------------------------------
| Command Design Pattern
|--------------------------------------------------------------------------
| This example demonstrates the Command Design Pattern
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Behavioral/Command
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

// Command interface declares a method for executing a command.
type Command interface {
	Execute()
}

// SimpleCommand implements the Command interface for simple operations.
type SimpleCommand struct {
	payload string
}

func NewSimpleCommand(payload string) *SimpleCommand {
	return &SimpleCommand{payload: payload}
}

func (s *SimpleCommand) Execute() {
	fmt.Printf("SimpleCommand: See, I can do simple things like printing (%s)\n", s.payload)
}

// ComplexCommand delegates more complex operations to a Receiver.
type ComplexCommand struct {
	receiver *Receiver
	a        string
	b        string
}

func NewComplexCommand(receiver *Receiver, a string, b string) *ComplexCommand {
	return &ComplexCommand{receiver: receiver, a: a, b: b}
}

func (c *ComplexCommand) Execute() {
	fmt.Println("ComplexCommand: Complex stuff should be done by a receiver object.")
	c.receiver.DoSomething(c.a)
	c.receiver.DoSomethingElse(c.b)
}

// Receiver contains business logic and knows how to perform operations.
type Receiver struct{}

func (r *Receiver) DoSomething(a string) {
	fmt.Printf("Receiver: Working on (%s.)\n", a)
}

func (r *Receiver) DoSomethingElse(b string) {
	fmt.Printf("Receiver: Also working on (%s.)\n", b)
}

// Invoker is associated with commands and sends requests to them.
type Invoker struct {
	onStart  Command
	onFinish Command
}

func (i *Invoker) SetOnStart(command Command) {
	i.onStart = command
}

func (i *Invoker) SetOnFinish(command Command) {
	i.onFinish = command
}

func (i *Invoker) DoSomethingImportant() {
	fmt.Println("Invoker: Does anybody want something done before I begin?")
	if i.onStart != nil {
		i.onStart.Execute()
	}

	fmt.Println("Invoker: ...doing something really important...")

	fmt.Println("Invoker: Does anybody want something done after I finish?")
	if i.onFinish != nil {
		i.onFinish.Execute()
	}
}

// Client code parameterizes an invoker with commands.
func main() {
	invoker := &Invoker{}
	invoker.SetOnStart(NewSimpleCommand("Say Hi!"))
	receiver := &Receiver{}
	invoker.SetOnFinish(NewComplexCommand(receiver, "Send email", "Save report"))

	invoker.DoSomethingImportant()
}