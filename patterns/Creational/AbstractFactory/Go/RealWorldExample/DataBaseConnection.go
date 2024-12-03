package main

import "fmt"

// Abstract Factory interface for creating database connections and queries
type DatabaseFactory interface {
	CreateConnection() Connection
	CreateQuery() Query
}

// Concrete Factory for MySQL database
type MySQLFactory struct{}

func (f *MySQLFactory) CreateConnection() Connection {
	return &MySQLConnection{}
}

func (f *MySQLFactory) CreateQuery() Query {
	return &MySQLQuery{}
}

// Concrete Factory for PostgreSQL database
type PostgreSQLFactory struct{}

func (f *PostgreSQLFactory) CreateConnection() Connection {
	return &PostgreSQLConnection{}
}

func (f *PostgreSQLFactory) CreateQuery() Query {
	return &PostgreSQLQuery{}
}

// Abstract product interface for database connections
type Connection interface {
	Connect() string
}

// Concrete product for MySQL connection
type MySQLConnection struct{}

func (c *MySQLConnection) Connect() string {
	return "Connected to MySQL database."
}

// Concrete product for PostgreSQL connection
type PostgreSQLConnection struct{}

func (c *PostgreSQLConnection) Connect() string {
	return "Connected to PostgreSQL database."
}

// Abstract product interface for database queries
type Query interface {
	Execute() string
}

// Concrete product for MySQL query
type MySQLQuery struct{}

func (q *MySQLQuery) Execute() string {
	return "Executing MySQL query."
}

// Concrete product for PostgreSQL query
type PostgreSQLQuery struct{}

func (q *PostgreSQLQuery) Execute() string {
	return "Executing PostgreSQL query."
}

// Client code that interacts with the abstract factory and products
func clientCode(factory DatabaseFactory) {
	connection := factory.CreateConnection()
	fmt.Println(connection.Connect())

	query := factory.CreateQuery()
	fmt.Println(query.Execute())
}

func main() {
	// Testing MySQL factory
	fmt.Println("Testing MySQL factory:")
	clientCode(&MySQLFactory{})
	fmt.Println()

	// Testing PostgreSQL factory
	fmt.Println("Testing PostgreSQL factory:")
	clientCode(&PostgreSQLFactory{})
}
