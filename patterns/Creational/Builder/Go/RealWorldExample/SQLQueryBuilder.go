package main

import (
    "fmt"
    "strings"
)

// Builder Design Pattern - SQL Query Builder
//
// This example demonstrates the Factory Method Design Pattern to send various
// types of notifications (Email, SMS).

// SQLQueryBuilder interface declares a set of methods to assemble an SQL query.
type SQLQueryBuilder interface {
    Select(table string, fields []string) SQLQueryBuilder
    Where(field string, value string, operator string) SQLQueryBuilder
    Limit(start int, offset int) SQLQueryBuilder
    GetSQL() string
}

// Concrete Builder for MySQL SQL queries.
type MysqlQueryBuilder struct {
    query *SQLQuery
}

func (b *MysqlQueryBuilder) reset() {
    b.query = &SQLQuery{}
}

func (b *MysqlQueryBuilder) Select(table string, fields []string) SQLQueryBuilder {
    b.reset()
    b.query.base = fmt.Sprintf("SELECT %s FROM %s", strings.Join(fields, ", "), table)
    b.query.queryType = "select"
    return b
}

func (b *MysqlQueryBuilder) Where(field string, value string, operator string) SQLQueryBuilder {
    if b.query.queryType != "select" && b.query.queryType != "update" && b.query.queryType != "delete" {
        panic("WHERE can only be added to SELECT, UPDATE OR DELETE")
    }
    b.query.where = append(b.query.where, fmt.Sprintf("%s %s '%s'", field, operator, value))
    return b
}

func (b *MysqlQueryBuilder) Limit(start int, offset int) SQLQueryBuilder {
    if b.query.queryType != "select" {
        panic("LIMIT can only be added to SELECT")
    }
    b.query.limit = fmt.Sprintf(" LIMIT %d, %d", start, offset)
    return b
}

func (b *MysqlQueryBuilder) GetSQL() string {
    sql := b.query.base
    if len(b.query.where) > 0 {
        sql += " WHERE " + strings.Join(b.query.where, " AND ")
    }
    if b.query.limit != "" {
        sql += b.query.limit
    }
    return sql + ";"
}

// Concrete Builder for PostgreSQL SQL queries.
type PostgresQueryBuilder struct {
    MysqlQueryBuilder
}

func (b *PostgresQueryBuilder) Limit(start int, offset int) SQLQueryBuilder {
    b.MysqlQueryBuilder.Limit(start, offset)
    b.query.limit = fmt.Sprintf(" LIMIT %d OFFSET %d", start, offset)
    return b
}

// SQLQuery represents the SQL query being built.
type SQLQuery struct {
    base      string
    where     []string
    limit     string
    queryType string
}

// Client code to demonstrate the SQL Query Builder.
func clientCode(builder SQLQueryBuilder) {
    query := builder.Select("users", []string{"name", "email", "password"}).
        Where("age", "18", ">").
        Where("age", "30", "<").
        Limit(10, 20).
        GetSQL()

    fmt.Println(query)
}

func main() {
    fmt.Println("Testing MySQL query builder:")
    clientCode(&MysqlQueryBuilder{})
    fmt.Println()

    fmt.Println("Testing PostgreSQL query builder:")
    clientCode(&PostgresQueryBuilder{})
    fmt.Println()
}
