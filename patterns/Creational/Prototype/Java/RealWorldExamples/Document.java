/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Document Example
|--------------------------------------------------------------------------
| Implement the Prototype Design Pattern to create new instances by cloning 
| existing objects, which can avoid costly initialization steps.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational.Prototype.RealWorldExamples
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-java
|--------------------------------------------------------------------------
*/

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

// Prototype Interface
interface Prototype extends Cloneable {
    Prototype clone();
}

// Concrete Prototype: Document
class Document implements Prototype {
    private String title;
    private String content;
    private Date createdAt;
    private Author author;

    public Document(String title, String content, Author author) {
        this.title = title;
        this.content = content;
        this.author = author;
        this.createdAt = new Date();
        this.author.addDocument(this);
    }

    @Override
    public Document clone() {
        try {
            Document clone = (Document) super.clone();
            clone.title = "Copy of " + this.title;
            clone.createdAt = new Date();
            this.author.addDocument(clone);
            return clone;
        } catch (CloneNotSupportedException e) {
            throw new AssertionError();
        }
    }

    public String getDetails() {
        return "Title: " + title + "\nContent: " + content + "\nAuthor: " + author.getName() + "\nCreatedAt: " + createdAt.toString();
    }
}

// The Author class, which has a collection of documents.
class Author {
    private String name;
    private List<Document> documents = new ArrayList<>();

    public Author(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public void addDocument(Document document) {
        this.documents.add(document);
    }

    public List<Document> getDocuments() {
        return documents;
    }
}

// Client code that demonstrates the Prototype Design Pattern.
public class Main {
    public static void main(String[] args) {
        // Create an author and a document.
        Author author = new Author("Jane Doe");
        Document originalDocument = new Document("Design Patterns", "Learning the Prototype Pattern.", author);

        // Clone the original document.
        Document clonedDocument = originalDocument.clone();

        // Display details of both documents.
        System.out.println("Original Document:");
        System.out.println(originalDocument.getDetails());

        System.out.println("\nCloned Document:");
        System.out.println(clonedDocument.getDetails());
    }
}
