/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Complex Page Example
|--------------------------------------------------------------------------
| Implement Prototype Design Pattern to create objects without specifying
| the exact class of object that will be created.
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

/**
 * Prototype.
 */
class Page implements Cloneable {
    private String title;
    private String body;
    private Author author;
    private List<String> comments = new ArrayList<>();
    private Date date;
    // +100 private fields.

    public Page(String title, String body, Author author) {
        this.title = title;
        this.body = body;
        this.author = author;
        this.author.addToPage(this);
        this.date = new Date();
    }

    public void addComment(String comment) {
        this.comments.add(comment);
    }

    /**
     * You can control what data you want to carry over to the cloned object.
     *
     * For instance, when a page is cloned:
     * - It gets a new "Copy of ..." title.
     * - The author of the page remains the same. Therefore we leave the
     * reference to the existing object while adding the cloned page to the list
     * of the author's pages.
     * - We don't carry over the comments from the old page.
     * - We also attach a new date object to the page.
     */
    @Override
    protected Page clone() {
        try {
            Page clone = (Page) super.clone();
            clone.title = "Copy of " + this.title;
            clone.author.addToPage(clone);
            clone.comments = new ArrayList<>();
            clone.date = new Date();
            return clone;
        } catch (CloneNotSupportedException e) {
            throw new AssertionError();
        }
    }

    @Override
    public String toString() {
        return "Page{" +
                "title='" + title + '\'' +
                ", body='" + body + '\'' +
                ", author=" + author +
                ", comments=" + comments +
                ", date=" + date +
                '}';
    }
}

class Author {
    private String name;
    private List<Page> pages = new ArrayList<>();

    public Author(String name) {
        this.name = name;
    }

    public void addToPage(Page page) {
        this.pages.add(page);
    }

    @Override
    public String toString() {
        return "Author{" +
                "name='" + name + '\'' +
                ", pages=" + pages +
                '}';
    }
}

/**
 * The client code.
 */
public class Main {
    public static void main(String[] args) {
        Author author = new Author("John Smith");
        Page page = new Page("Tip of the day", "Keep calm and carry on.", author);

        // ...

        page.addComment("Nice tip, thanks!");

        // ...

        Page draft = page.clone();
        System.out.println("Dump of the clone. Note that the author is now referencing two objects.\n\n");
        System.out.println(draft);
    }
}
