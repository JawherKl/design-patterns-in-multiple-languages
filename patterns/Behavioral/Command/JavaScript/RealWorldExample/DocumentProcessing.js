class Command {
    execute() {}
    getId() {}
    getStatus() {}
}

class DocumentCommand extends Command {
    constructor(document) {
        super();
        this.id = null;
        this.status = 0;
        this.document = document;
    }

    getId() {
        return this.id;
    }

    getStatus() {
        return this.status;
    }

    getDocument() {
        return this.document;
    }

    execute() {
        this.process();
        this.complete();
    }

    process() {
        throw new Error("Method 'process()' must be implemented.");
    }

    complete() {
        this.status = 1;
        Queue.get().completeCommand(this);
    }
}

class PrintDocumentCommand extends DocumentCommand {
    process() {
        console.log(`PrintDocumentCommand: Printing document '${this.document}'.`);
    }
}

class SaveDocumentCommand extends DocumentCommand {
    process() {
        console.log(`SaveDocumentCommand: Saving document '${this.document}'.`);
    }
}

class ConvertDocumentCommand extends DocumentCommand {
    process() {
        console.log(`ConvertDocumentCommand: Converting document '${this.document}'.`);
    }
}

class Queue {
    constructor() {
        this.db = new Map();
        this.lastId = 0;
    }

    isEmpty() {
        for (let [key, value] of this.db) {
            if (value.status === 0) {
                return false;
            }
        }
        return true;
    }

    add(command) {
        this.lastId++;
        command.id = this.lastId;
        this.db.set(this.lastId, { command: command, status: command.getStatus() });
    }

    getCommand() {
        for (let [key, value] of this.db) {
            if (value.status === 0) {
                return value.command;
            }
        }
        return null;
    }

    completeCommand(command) {
        if (this.db.has(command.getId())) {
            this.db.get(command.getId()).status = command.getStatus();
        }
    }

    work() {
        while (!this.isEmpty()) {
            const command = this.getCommand();
            if (command === null) {
                break;
            }
            command.execute();
        }
    }

    static get() {
        if (!Queue.instance) {
            Queue.instance = new Queue();
        }
        return Queue.instance;
    }
}

// Client Code
const queue = Queue.get();

// Adding commands to the queue
if (queue.isEmpty()) {
    queue.add(new PrintDocumentCommand("Document1.pdf"));
    queue.add(new SaveDocumentCommand("Document1.pdf"));
    queue.add(new ConvertDocumentCommand("Document1.pdf"));
}

// Processing the commands in the queue
queue.work();
