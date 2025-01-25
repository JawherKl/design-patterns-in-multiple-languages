/*
|--------------------------------------------------------------------------
| Prototype Design Pattern - Complex Page Example
|--------------------------------------------------------------------------
| Implement Prototype Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Prototype/RealWorldExamples
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-js
|--------------------------------------------------------------------------
*/

class Page {
    constructor(title, body, author) {
        this.title = title;
        this.body = body;
        this.author = author;
        this.author.addToPage(this);
        this.comments = [];
        this.date = new Date();
    }

    addComment(comment) {
        this.comments.push(comment);
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
    clone() {
        const clone = Object.create(Object.getPrototypeOf(this));
        clone.title = "Copy of " + this.title;
        clone.body = this.body;
        clone.author = this.author;
        clone.author.addToPage(clone);
        clone.comments = [];
        clone.date = new Date();

        return clone;
    }
}

class Author {
    constructor(name) {
        this.name = name;
        this.pages = [];
    }

    addToPage(page) {
        this.pages.push(page);
    }
}

/**
 * The client code.
 */
function clientCode() {
    const author = new Author("John Smith");
    const page = new Page("Tip of the day", "Keep calm and carry on.", author);

    // ...

    page.addComment("Nice tip, thanks!");

    // ...

    const draft = page.clone();
    console.log("Dump of the clone. Note that the author is now referencing two objects.\n\n");
    console.log(draft);
}

clientCode();
