package patterns.Creational.Builder.Java.RealWorldExample;


Java
// Builder Design Pattern - SQL Query Builder
//
// This example demonstrates the Factory Method Design Pattern to send various
// types of notifications (Email, SMS).

// The Builder interface declares a set of methods to assemble an SQL query.
interface SQLQueryBuilder {
    SQLQueryBuilder select(String table, String[] fields);
    SQLQueryBuilder where(String field, String value, String operator);
    SQLQueryBuilder limit(int start, int offset);
    String getSQL();
}

// Each Concrete Builder corresponds to a specific SQL dialect and may implement
// the builder steps a little bit differently from the others.
// This Concrete Builder can build SQL queries compatible with MySQL.
class MysqlQueryBuilder implements SQLQueryBuilder {
    protected SQLQuery query;

    public MysqlQueryBuilder() {
        this.query = new SQLQuery();
    }

    protected void reset() {
        this.query = new SQLQuery();
    }

    @Override
    public SQLQueryBuilder select(String table, String[] fields) {
        reset();
        query.base = "SELECT " + String.join(", ", fields) + " FROM " + table;
        query.type = "select";
        return this;
    }

    @Override
    public SQLQueryBuilder where(String field, String value, String operator) {
        if (!"select".equals(query.type) && !"update".equals(query.type) && !"delete".equals(query.type)) {
            throw new RuntimeException("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        query.where.add(field + " " + operator + " '" + value + "'");
        return this;
    }

    @Override
    public SQLQueryBuilder limit(int start, int offset) {
        if (!"select".equals(query.type)) {
            throw new RuntimeException("LIMIT can only be added to SELECT");
        }
        query.limit = " LIMIT " + start + ", " + offset;
        return this;
    }

    @Override
    public String getSQL() {
        StringBuilder sql = new StringBuilder(query.base);
        if (!query.where.isEmpty()) {
            sql.append(" WHERE ").append(String.join(" AND ", query.where));
        }
        if (query.limit != null) {
            sql.append(query.limit);
        }
        sql.append(";");
        return sql.toString();
    }
}

// This Concrete Builder is compatible with PostgreSQL. While Postgres is very
// similar to Mysql, it still has several differences. To reuse the common code,
// we extend it from the MySQL builder, while overriding some of the building
// steps.
class PostgresQueryBuilder extends MysqlQueryBuilder {
    @Override
    public SQLQueryBuilder limit(int start, int offset) {
        super.limit(start, offset);
        query.limit = " LIMIT " + start + " OFFSET " + offset;
        return this;
    }
}

// SQLQuery represents the SQL query being built.
class SQLQuery {
    String base;
    String type;
    List<String> where = new ArrayList<>();
    String limit;
}

// Client code to demonstrate the SQL Query Builder.
public class Main {
    public static void main(String[] args) {
        System.out.println("Testing MySQL query builder:");
        clientCode(new MysqlQueryBuilder());
        System.out.println();

        System.out.println("Testing PostgreSQL query builder:");
        clientCode(new PostgresQueryBuilder());
        System.out.println();
    }

    public static void clientCode(SQLQueryBuilder queryBuilder) {
        String query = queryBuilder.select("users", new String[]{"name", "email", "password"})
                .where("age", "18", ">")
                .where("age", "30", "<")
                .limit(10, 20)
                .getSQL();

        System.out.println(query);
    }
}
