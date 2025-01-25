/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Document Example
|--------------------------------------------------------------------------
| Implement the Prototype Design Pattern to create new instances by cloning 
| existing objects, which can avoid costly initialization steps.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype/RealWorldExamples
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-js
|--------------------------------------------------------------------------
*/

/**
 * Prototype Interface.
 * Defines the `clone` method that all prototypes must implement.
 */
class Prototype {
    clone() {
        throw new Error("Method 'clone()' must be implemented.");
    }
}

/**
 * Concrete Prototype: Document
 */
class Document extends Prototype {
    constructor(title, content, author) {
        super();
        this.title = title;
        this.content = content;
        this.author = author;
        this.createdAt = new Date();
        this.author.addDocument(this);
    }

    /**
     * Control what data to copy when cloning.
     * Example:
     * - The cloned document will have "Copy of ..." title.
     * - The author reference remains the same.
     * - The creation date is updated to the current date.
     */
    clone() {
        const clone = Object.create(Object.getPrototypeOf(this));
        clone.title = "Copy of " + this.title;
        clone.content = this.content;
        clone.author = this.author;
        clone.createdAt = new Date();
        // Add the cloned document to the author's list of documents.
        this.author.addDocument(clone);
        return clone;
    }

    getDetails() {
        return {
            Title: this.title,
            Content: this.content,
            Author: this.author.getName(),
            CreatedAt: this.createdAt.toISOString().slice(0, 19).replace('T', ' ')
        };
    }
}

/**
 * The Author class, which has a collection of documents.
 */
class Author {
    constructor(name) {
        this.name = name;
        this.documents = [];
    }

    getName() {
        return this.name;
    }

    addDocument(document) {
        this.documents.push(document);
    }

    getDocuments() {
        return this.documents;
    }
}

/**
 * Client code that demonstrates the Prototype Design Pattern.
 */
function clientCode() {
    // Create an author and a document.
    const author = new Author("Jane Doe");
    const originalDocument = new Document("Design Patterns", "Learning the Prototype Pattern.", author);

    // Clone the original document.
    const clonedDocument = originalDocument.clone();

    // Display details of both documents.
    console.log("Original Document:");
    console.log(originalDocument.getDetails());

    console.log("\nCloned Document:");
    console.log(clonedDocument.getDetails());
}

clientCode();
