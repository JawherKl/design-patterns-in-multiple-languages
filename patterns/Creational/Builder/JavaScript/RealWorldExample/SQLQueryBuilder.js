// Builder Design Pattern - SQL Query Builder
//
// This example demonstrates the Factory Method Design Pattern to send various
// types of notifications (Email, SMS).

// SQLQueryBuilder interface declares a set of methods to assemble an SQL query.
class SQLQueryBuilder {
    select(table, fields) {}
    where(field, value, operator = '=') {}
    limit(start, offset) {}
    getSQL() {}
}

// Concrete Builder for MySQL SQL queries.
class MysqlQueryBuilder extends SQLQueryBuilder {
    constructor() {
        super();
        this.reset();
    }

    reset() {
        this.query = {};
    }

    select(table, fields) {
        this.reset();
        this.query.base = `SELECT ${fields.join(', ')} FROM ${table}`;
        this.query.type = 'select';
        return this;
    }

    where(field, value, operator = '=') {
        if (!['select', 'update', 'delete'].includes(this.query.type)) {
            throw new Error('WHERE can only be added to SELECT, UPDATE OR DELETE');
        }
        if (!this.query.where) {
            this.query.where = [];
        }
        this.query.where.push(`${field} ${operator} '${value}'`);
        return this;
    }

    limit(start, offset) {
        if (!['select'].includes(this.query.type)) {
            throw new Error('LIMIT can only be added to SELECT');
        }
        this.query.limit = ` LIMIT ${start}, ${offset}`;
        return this;
    }

    getSQL() {
        let sql = this.query.base;
        if (this.query.where && this.query.where.length > 0) {
            sql += ` WHERE ${this.query.where.join(' AND ')}`;
        }
        if (this.query.limit) {
            sql += this.query.limit;
        }
        return sql + ';';
    }
}

// Concrete Builder for PostgreSQL SQL queries.
class PostgresQueryBuilder extends MysqlQueryBuilder {
    limit(start, offset) {
        super.limit(start, offset);
        this.query.limit = ` LIMIT ${start} OFFSET ${offset}`;
        return this;
    }
}

// Client code to demonstrate the SQL Query Builder.
function clientCode(builder) {
    const query = builder.select('users', ['name', 'email', 'password'])
        .where('age', '18', '>')
        .where('age', '30', '<')
        .limit(10, 20)
        .getSQL();

    console.log(query);
}

console.log('Testing MySQL query builder:');
clientCode(new MysqlQueryBuilder());
console.log();

console.log('Testing PostgreSQL query builder:');
clientCode(new PostgresQueryBuilder());
console.log();
