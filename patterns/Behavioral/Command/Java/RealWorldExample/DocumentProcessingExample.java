package RealWorldExample;

import java.util.LinkedList;
import java.util.Queue;

// Command Interface
interface Command {
    void execute();
    int getId();
    int getStatus();
}

// Abstract DocumentCommand
abstract class DocumentCommand implements Command {
    protected int id;
    protected int status;
    protected String document;

    public DocumentCommand(String document) {
        this.document = document;
        this.status = 0;
    }

    public int getId() {
        return id;
    }

    public int getStatus() {
        return status;
    }

    public void execute() {
        process();
        complete();
    }

    public void complete() {
        this.status = 1;
        CommandQueue.getInstance().completeCommand(this);
    }

    protected abstract void process();
}

// Concrete Print Command
class PrintDocumentCommand extends DocumentCommand {
    public PrintDocumentCommand(String document) {
        super(document);
    }

    @Override
    protected void process() {
        System.out.println("PrintDocumentCommand: Printing document '" + document + "'.");
    }
}

// Concrete Save Command
class SaveDocumentCommand extends DocumentCommand {
    public SaveDocumentCommand(String document) {
        super(document);
    }

    @Override
    protected void process() {
        System.out.println("SaveDocumentCommand: Saving document '" + document + "'.");
    }
}

// Concrete Convert Command
class ConvertDocumentCommand extends DocumentCommand {
    public ConvertDocumentCommand(String document) {
        super(document);
    }

    @Override
    protected void process() {
        System.out.println("ConvertDocumentCommand: Converting document '" + document + "'.");
    }
}

// Command Queue (Singleton)
class CommandQueue {
    private Queue<Command> queue = new LinkedList<>();
    private static CommandQueue instance;

    private CommandQueue() {}

    public static CommandQueue getInstance() {
        if (instance == null) {
            instance = new CommandQueue();
        }
        return instance;
    }

    public void addCommand(Command command) {
        queue.offer(command);
    }

    public Command getCommand() {
        return queue.poll();
    }

    public void completeCommand(Command command) {
        // Logic to mark the command as completed
    }

    public void work() {
        while (!queue.isEmpty()) {
            Command command = getCommand();
            if (command != null) {
                command.execute();
            }
        }
    }
}

// Client Code
public class DocumentProcessingExample {
    public static void main(String[] args) {
        CommandQueue queue = CommandQueue.getInstance();

        // Adding commands to the queue
        queue.addCommand(new PrintDocumentCommand("Document1.pdf"));
        queue.addCommand(new SaveDocumentCommand("Document1.pdf"));
        queue.addCommand(new ConvertDocumentCommand("Document1.pdf"));

        // Processing the commands in the queue
        queue.work();
    }
}
