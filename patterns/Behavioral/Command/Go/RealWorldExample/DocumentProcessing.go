package main

import (
	"database/sql"
	"encoding/base64"
	"encoding/gob"
	"fmt"
	"os"
	"sync"

	_ "github.com/mattn/go-sqlite3"
)

// Command Interface
type Command interface {
	Execute()
	GetID() int
	GetStatus() int
}

// DocumentCommand Struct (Abstract class equivalent in Go)
type DocumentCommand struct {
	ID       int
	Status   int
	Document string
}

func (c *DocumentCommand) GetID() int {
	return c.ID
}

func (c *DocumentCommand) GetStatus() int {
	return c.Status
}

func (c *DocumentCommand) Complete() {
	c.Status = 1
	QueueInstance.CompleteCommand(c)
}

// PrintDocumentCommand Struct (Concrete implementation)
type PrintDocumentCommand struct {
	DocumentCommand
}

func (cmd *PrintDocumentCommand) Execute() {
	fmt.Printf("PrintDocumentCommand: Printing document '%s'.\n", cmd.Document)
	cmd.Complete()
}

// SaveDocumentCommand Struct (Concrete implementation)
type SaveDocumentCommand struct {
	DocumentCommand
}

func (cmd *SaveDocumentCommand) Execute() {
	fmt.Printf("SaveDocumentCommand: Saving document '%s'.\n", cmd.Document)
	cmd.Complete()
}

// ConvertDocumentCommand Struct (Concrete implementation)
type ConvertDocumentCommand struct {
	DocumentCommand
}

func (cmd *ConvertDocumentCommand) Execute() {
	fmt.Printf("ConvertDocumentCommand: Converting document '%s'.\n", cmd.Document)
	cmd.Complete()
}

// Queue Singleton
type Queue struct {
	db   *sql.DB
	lock sync.Mutex
}

var QueueInstance = func() *Queue {
	queue := &Queue{}
	db, err := sql.Open("sqlite3", "./commands.sqlite")
	if err != nil {
		fmt.Println("Error opening database:", err)
		os.Exit(1)
	}
	queue.db = db
	_, _ = db.Exec(`CREATE TABLE IF NOT EXISTS commands (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		command BLOB,
		status INTEGER
	)`)
	return queue
}()

func (q *Queue) Add(command Command) {
	q.lock.Lock()
	defer q.lock.Unlock()

	var buffer []byte
	enc := gob.NewEncoder(&buffer)
	err := enc.Encode(command)
	if err != nil {
		fmt.Println("Error encoding command:", err)
		return
	}
	encoded := base64.StdEncoding.EncodeToString(buffer)

	_, err = q.db.Exec("INSERT INTO commands (command, status) VALUES (?, ?)", encoded, command.GetStatus())
	if err != nil {
		fmt.Println("Error inserting command into DB:", err)
	}
}

func (q *Queue) GetCommand() Command {
	q.lock.Lock()
	defer q.lock.Unlock()

	row := q.db.QueryRow("SELECT id, command FROM commands WHERE status = 0 LIMIT 1")
	var id int
	var commandStr string
	err := row.Scan(&id, &commandStr)
	if err != nil {
		return nil
	}

	data, err := base64.StdEncoding.DecodeString(commandStr)
	if err != nil {
		fmt.Println("Error decoding command:", err)
		return nil
	}

	var command Command
	dec := gob.NewDecoder(data)
	err = dec.Decode(&command)
	if err != nil {
		fmt.Println("Error decoding command object:", err)
		return nil
	}
	return command
}

func (q *Queue) CompleteCommand(command Command) {
	q.lock.Lock()
	defer q.lock.Unlock()

	_, _ = q.db.Exec("UPDATE commands SET status = ? WHERE id = ?", command.GetStatus(), command.GetID())
}

func (q *Queue) Work() {
	for {
		command := q.GetCommand()
		if command == nil {
			break
		}
		command.Execute()
	}
}

// Main function (Client Code)
func main() {
	// Add commands to queue
	queue := QueueInstance
	queue.Add(&PrintDocumentCommand{DocumentCommand{Document: "Document1.pdf"}})
	queue.Add(&SaveDocumentCommand{DocumentCommand{Document: "Document1.pdf"}})
	queue.Add(&ConvertDocumentCommand{DocumentCommand{Document: "Document1.pdf"}})

	// Process commands
	queue.Work()
}
