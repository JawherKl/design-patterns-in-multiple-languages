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
| @link      https://github.com/JawherKl/design-patterns-in-go
|--------------------------------------------------------------------------
*/

package main

import (
    "fmt"
    "time"
)

// Page represents the Prototype.
type Page struct {
    Title    string
    Body     string
    Author   *Author
    Comments []string
    Date     time.Time
}

// NewPage is the constructor for Page.
func NewPage(title, body string, author *Author) *Page {
    page := &Page{
        Title:    title,
        Body:     body,
        Author:   author,
        Comments: []string{},
        Date:     time.Now(),
    }
    author.AddToPage(page)
    return page
}

// AddComment adds a comment to the Page.
func (p *Page) AddComment(comment string) {
    p.Comments = append(p.Comments, comment)
}

// Clone creates a copy of the Page with certain modifications.
func (p *Page) Clone() *Page {
    clone := *p
    clone.Title = "Copy of " + p.Title
    p.Author.AddToPage(&clone)
    clone.Comments = []string{}
    clone.Date = time.Now()
    return &clone
}

// Author represents the author of the Page.
type Author struct {
    Name  string
    Pages []*Page
}

// NewAuthor is the constructor for Author.
func NewAuthor(name string) *Author {
    return &Author{
        Name:  name,
        Pages: []*Page{},
    }
}

// AddToPage adds a Page to the Author's list of pages.
func (a *Author) AddToPage(page *Page) {
    a.Pages = append(a.Pages, page)
}

// Client code demonstrating the Prototype Design Pattern.
func clientCode() {
    author := NewAuthor("John Smith")
    page := NewPage("Tip of the day", "Keep calm and carry on.", author)

    // ...

    page.AddComment("Nice tip, thanks!")

    // ...

    draft := page.Clone()
    fmt.Println("Dump of the clone. Note that the author is now referencing two objects.")
    fmt.Printf("%+v\n", draft)
}

func main() {
    clientCode()
}
