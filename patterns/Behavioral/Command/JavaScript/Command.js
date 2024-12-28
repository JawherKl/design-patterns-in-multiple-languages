// Command interface declares a method for executing a command.
class Command {
  execute() {}
}

// Some commands can implement simple operations on their own.
class SimpleCommand extends Command {
  constructor(payload) {
    super();
    this.payload = payload;
  }

  execute() {
    console.log(`SimpleCommand: See, I can do simple things like printing (${this.payload})`);
  }
}

// However, some commands can delegate more complex operations to other objects, called "receivers."
class ComplexCommand extends Command {
  constructor(receiver, a, b) {
    super();
    this.receiver = receiver;
    this.a = a;
    this.b = b;
  }

  execute() {
    console.log("ComplexCommand: Complex stuff should be done by a receiver object.");
    this.receiver.doSomething(this.a);
    this.receiver.doSomethingElse(this.b);
  }
}

// The Receiver classes contain some important business logic. They know how to perform all kinds of operations, associated with carrying out a request. In fact, any class may serve as a Receiver.
class Receiver {
  doSomething(a) {
    console.log(`Receiver: Working on (${a}).`);
  }

  doSomethingElse(b) {
    console.log(`Receiver: Also working on (${b}).`);
  }
}

// The Invoker is associated with one or several commands. It sends a request to the command.
class Invoker {
  setOnStart(command) {
    this.onStart = command;
  }

  setOnFinish(command) {
    this.onFinish = command;
  }

  doSomethingImportant() {
    console.log("Invoker: Does anybody want something done before I begin?");
    if (this.onStart instanceof Command) {
      this.onStart.execute();
    }

    console.log("Invoker: ...doing something really important...");

    console.log("Invoker: Does anybody want something done after I finish?");
    if (this.onFinish instanceof Command) {
      this.onFinish.execute();
    }
  }
}

// The client code can parameterize an invoker with any commands.
const invoker = new Invoker();
invoker.setOnStart(new SimpleCommand("Say Hi!"));
const receiver = new Receiver();
invoker.setOnFinish(new ComplexCommand(receiver, "Send email", "Save report"));

invoker.doSomethingImportant();
