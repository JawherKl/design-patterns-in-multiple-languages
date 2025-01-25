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
| @link      https://github.com/JawherKl/design-patterns-in-go
|--------------------------------------------------------------------------
*/

package main

import (
    "fmt"
    "time"
)

// Prototype Interface.
// Defines the Clone method that all prototypes must implement.
type Prototype interface {
    Clone() Prototype
    GetDetails() map[string]string
}

// Concrete Prototype: Document
type Document struct {
    Title     string
    Content   string
    CreatedAt time.Time
    Author    *Author
}

// NewDocument is the constructor for Document.
func NewDocument(title, content string, author *Author) *Document {
    doc := &Document{
        Title:     title,
        Content:   content,
        CreatedAt: time.Now(),
        Author:    author,
    }
    author.AddDocument(doc)
    return doc
}

// Clone provides a copy of the Document with certain modifications.
func (d *Document) Clone() Prototype {
    clone := *d
    clone.Title = "Copy of " + d.Title
    clone.CreatedAt = time.Now()
    d.Author.AddDocument(&clone)
    return &clone
}

// GetDetails returns the details of the Document.
func (d *Document) GetDetails() map[string]string {
    return map[string]string{
        "Title":     d.Title,
        "Content":   d.Content,
        "Author":    d.Author.Name,
        "CreatedAt": d.CreatedAt.Format("2006-01-02 15:04:05"),
    }
}

// The Author class, which has a collection of documents.
type Author struct {
    Name      string
    Documents []*Document
}

// NewAuthor is the constructor for Author.
func NewAuthor(name string) *Author {
    return &Author{
        Name:      name,
        Documents: []*Document{},
    }
}

// AddDocument adds a Document to the Author's list of documents.
func (a *Author) AddDocument(document *Document) {
    a.Documents = append(a.Documents, document)
}

// Client code that demonstrates the Prototype Design Pattern.
func clientCode() {
    // Create an author and a document.
    author := NewAuthor("Jane Doe")
    originalDocument := NewDocument("Design Patterns", "Learning the Prototype Pattern.", author)

    // Clone the original document.
    clonedDocument := originalDocument.Clone()

    // Display details of both documents.
    fmt.Println("Original Document:")
    for k, v := range originalDocument.GetDetails() {
        fmt.Printf("%s: %s\n", k, v)
    }

    fmt.Println("\nCloned Document:")
    for k, v := range clonedDocument.GetDetails() {
        fmt.Printf("%s: %s\n", k, v)
    }
}

func main() {
    clientCode()
}
