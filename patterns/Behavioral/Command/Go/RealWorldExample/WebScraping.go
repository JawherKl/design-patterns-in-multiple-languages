package main

import (
	"database/sql"
	"encoding/base64"
	"encoding/gob"
	"fmt"
	"io/ioutil"
	"log"
	"regexp"

	_ "github.com/mattn/go-sqlite3"
)

// Command interface
type Command interface {
	Execute()
	GetID() int
	GetStatus() int
}

// WebScrapingCommand struct (Abstract)
type WebScrapingCommand struct {
	ID     int
	Status int
	URL    string
}

func (c *WebScrapingCommand) GetID() int {
	return c.ID
}

func (c *WebScrapingCommand) GetStatus() int {
	return c.Status
}

func (c *WebScrapingCommand) Download() string {
	resp, err := ioutil.ReadFile(c.URL) // Simulates file download
	if err != nil {
		log.Fatalf("Failed to download: %s", err)
	}
	fmt.Printf("WebScrapingCommand: Downloaded %s\n", c.URL)
	return string(resp)
}

func (c *WebScrapingCommand) Complete() {
	c.Status = 1
	QueueInstance.CompleteCommand(c)
}

// IMDBGenresScrapingCommand struct
type IMDBGenresScrapingCommand struct {
	WebScrapingCommand
}

func NewIMDBGenresScrapingCommand() *IMDBGenresScrapingCommand {
	return &IMDBGenresScrapingCommand{
		WebScrapingCommand{URL: "https://www.imdb.com/feature/genre/"},
	}
}

func (c *IMDBGenresScrapingCommand) Execute() {
	html := c.Download()
	c.Parse(html)
	c.Complete()
}

func (c *IMDBGenresScrapingCommand) Parse(html string) {
	re := regexp.MustCompile(`href="(https://www.imdb.com/search/title\?genres=.*?)"`)
	matches := re.FindAllStringSubmatch(html, -1)
	fmt.Printf("IMDBGenresScrapingCommand: Discovered %d genres.\n", len(matches))
	for _, match := range matches {
		QueueInstance.Add(&IMDBGenrePageScrapingCommand{
			WebScrapingCommand: WebScrapingCommand{URL: match[1]},
			Page:               1,
		})
	}
}

// IMDBGenrePageScrapingCommand struct
type IMDBGenrePageScrapingCommand struct {
	WebScrapingCommand
	Page int
}

func (c *IMDBGenrePageScrapingCommand) Execute() {
	html := c.Download()
	c.Parse(html)
	c.Complete()
}

func (c *IMDBGenrePageScrapingCommand) Parse(html string) {
	re := regexp.MustCompile(`href="(/title/.*?)/"`)
	matches := re.FindAllStringSubmatch(html, -1)
	fmt.Printf("IMDBGenrePageScrapingCommand: Discovered %d movies.\n", len(matches))
	for _, match := range matches {
		url := "https://www.imdb.com" + match[1]
		QueueInstance.Add(&IMDBMovieScrapingCommand{
			WebScrapingCommand: WebScrapingCommand{URL: url},
		})
	}
}

// IMDBMovieScrapingCommand struct
type IMDBMovieScrapingCommand struct {
	WebScrapingCommand
}

func (c *IMDBMovieScrapingCommand) Execute() {
	html := c.Download()
	c.Parse(html)
	c.Complete()
}

func (c *IMDBMovieScrapingCommand) Parse(html string) {
	re := regexp.MustCompile(`<h1 itemprop="name" class="">(.*?)</h1>`)
	match := re.FindStringSubmatch(html)
	if len(match) > 1 {
		title := match[1]
		fmt.Printf("IMDBMovieScrapingCommand: Parsed movie %s.\n", title)
	}
}

// Queue struct (Singleton)
type Queue struct {
	db *sql.DB
}

var QueueInstance *Queue

func init() {
	db, err := sql.Open("sqlite3", "./commands.db")
	if err != nil {
		log.Fatal(err)
	}

	QueueInstance = &Queue{db: db}
	QueueInstance.db.Exec(`CREATE TABLE IF NOT EXISTS commands (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		command BLOB,
		status INTEGER
	)`)
}

func (q *Queue) Add(command Command) {
	var buf []byte
	err := gob.NewEncoder(buf).Encode(command)
	if err != nil {
		log.Fatalf("Failed to serialize command: %s", err)
	}

	q.db.Exec("INSERT INTO commands (command, status) VALUES (?, ?)", base64.StdEncoding.EncodeToString(buf), command.GetStatus())
}

func (q *Queue) GetCommand() Command {
	row := q.db.QueryRow("SELECT * FROM commands WHERE status = 0 LIMIT 1")
	var id int
	var commandStr string
	var status int
	err := row.Scan(&id, &commandStr, &status)
	if err != nil {
		log.Fatal(err)
	}

	commandBytes, _ := base64.StdEncoding.DecodeString(commandStr)
	var command Command
	gob.NewDecoder(commandBytes).Decode(&command)
	return command
}

func (q *Queue) CompleteCommand(command Command) {
	q.db.Exec("UPDATE commands SET status = ? WHERE id = ?", command.GetStatus(), command.GetID())
}

func main() {
	QueueInstance.Add(NewIMDBGenresScrapingCommand())
	for {
		command := QueueInstance.GetCommand()
		if command == nil {
			break
		}
		command.Execute()
	}
}
