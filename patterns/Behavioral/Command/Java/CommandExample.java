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
interface Command {
    void execute();
}

// SimpleCommand implements the Command interface for simple operations.
class SimpleCommand implements Command {
    private String payload;

    public SimpleCommand(String payload) {
        this.payload = payload;
    }

    @Override
    public void execute() {
        System.out.println("SimpleCommand: See, I can do simple things like printing (" + payload + ")");
    }
}

// ComplexCommand delegates more complex operations to a Receiver.
class ComplexCommand implements Command {
    private Receiver receiver;
    private String a;
    private String b;

    public ComplexCommand(Receiver receiver, String a, String b) {
        this.receiver = receiver;
        this.a = a;
        this.b = b;
    }

    @Override
    public void execute() {
        System.out.println("ComplexCommand: Complex stuff should be done by a receiver object.");
        receiver.doSomething(a);
        receiver.doSomethingElse(b);
    }
}

// Receiver contains business logic and knows how to perform operations.
class Receiver {
    public void doSomething(String a) {
        System.out.println("Receiver: Working on (" + a + ".)");
    }

    public void doSomethingElse(String b) {
        System.out.println("Receiver: Also working on (" + b + ".)");
    }
}

// Invoker is associated with commands and sends requests to them.
class Invoker {
    private Command onStart;
    private Command onFinish;

    public void setOnStart(Command command) {
        this.onStart = command;
    }

    public void setOnFinish(Command command) {
        this.onFinish = command;
    }

    public void doSomethingImportant() {
        System.out.println("Invoker: Does anybody want something done before I begin?");
        if (onStart != null) {
            onStart.execute();
        }

        System.out.println("Invoker: ...doing something really important...");

        System.out.println("Invoker: Does anybody want something done after I finish?");
        if (onFinish != null) {
            onFinish.execute();
        }
    }
}

// Client code parameterizes an invoker with commands.
public class CommandExample {
    public static void main(String[] args) {
        Invoker invoker = new Invoker();
        invoker.setOnStart(new SimpleCommand("Say Hi!"));
        Receiver receiver = new Receiver();
        invoker.setOnFinish(new ComplexCommand(receiver, "Send email", "Save report"));

        invoker.doSomethingImportant();
    }
}