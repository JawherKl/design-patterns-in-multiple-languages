Memento is a behavioral design pattern that allows making snapshots of an object’s state and restoring it in future.

The Memento doesn’t compromise the internal structure of the object it works with, as well as data kept inside the snapshots.

# Conceptual Example:
This example illustrates the structure of the Abstract Factory design pattern. It focuses on answering these questions:
* What classes does it consist of?
* What roles do these classes play?
* In what way the elements of the pattern are related?

After learning about the pattern’s structure it’ll be easier for you to grasp the following example, based on a real-world PHP, Go, Js and Java use case.

# Real World Example:

## TextEditor
TextEditor is saved and restored. In this example, a user can edit text, save it, and later undo the changes to restore the previous state of the text.


### Explanation:

1. **Memento Class**: This class stores the content of the text editor at a given moment. It provides a method to retrieve the stored content.
2. **TextEditor Class**: This is the core class that holds the current content of the editor. It allows the user to change the content, save it to a `Memento`, and restore it from a `Memento`.
3. **History Class**: This class is the caretaker. It stores a history of `Memento` objects, allowing the user to undo or restore content to previous states.
4. **Client Code**: The client code demonstrates using the `TextEditor` to create, modify, and restore content. The history of changes is tracked by the `History` class.

### Output:

```
TextEditor: Saving current content to Memento.
TextEditor: Saving current content to Memento.
TextEditor: Saving current content to Memento.
Current content: Hello, Memento Pattern!
TextEditor: Restoring content from Memento: Hello, PHP World!
Restored content: Hello, PHP World!
TextEditor: Restoring content from Memento: Hello World!
Initial content: Hello World!
```

## GameCharacter
This time, we’ll implement a Game Character that can save and restore its state, such as health, level, and position. This is a common use case for the Memento pattern in games, where players can save the state of their character and restore it later.

### Explanation:

1. **Memento Class**: This class stores the state of the `GameCharacter` (health, level, and position) at a given time. It provides methods to retrieve these values.
2. **GameCharacter Class**: This is the core class that holds the current state of the game character. It allows the user to modify the state and save it as a `Memento` object, or restore it from a `Memento`.
3. **Caretaker Class**: This class acts as the caretaker, storing a list of `Memento` objects, each representing a previous state of the `GameCharacter`. It allows the client to retrieve any saved state.
4. **Client Code**: The client code demonstrates how the `GameCharacter`'s state can be saved, modified, and restored, simulating the process of saving and loading game progress.

### Output:

```
GameCharacter: Saving current state to Memento.
GameCharacter: Saving current state to Memento.
GameCharacter: Saving current state to Memento.
Current state: Health: 50, Level: 3, Position: Boss Room
GameCharacter: Restoring state from Memento: Health: 80, Level: 2, Position: Dungeon
Restored state: Health: 80, Level: 2, Position: Dungeon
GameCharacter: Restoring state from Memento: Health: 100, Level: 1, Position: Town
Initial state: Health: 100, Level: 1, Position: Town
```