package patterns.Creational.AbstractFactory.Java.RealWorldExample;

// Abstract Factory interface for creating database connections and queries
interface DatabaseFactory {
    Connection createConnection();
    Query createQuery();
}

// Concrete Factory for MySQL database
class MySQLFactory implements DatabaseFactory {
    @Override
    public Connection createConnection() {
        return new MySQLConnection();
    }

    @Override
    public Query createQuery() {
        return new MySQLQuery();
    }
}

// Concrete Factory for PostgreSQL database
class PostgreSQLFactory implements DatabaseFactory {
    @Override
    public Connection createConnection() {
        return new PostgreSQLConnection();
    }

    @Override
    public Query createQuery() {
        return new PostgreSQLQuery();
    }
}

// Abstract product interface for database connections
interface Connection {
    String connect();
}

// Concrete product for MySQL connection
class MySQLConnection implements Connection {
    @Override
    public String connect() {
        return "Connected to MySQL database.";
    }
}

// Concrete product for PostgreSQL connection
class PostgreSQLConnection implements Connection {
    @Override
    public String connect() {
        return "Connected to PostgreSQL database.";
    }
}

// Abstract product interface for database queries
interface Query {
    String execute();
}

// Concrete product for MySQL query
class MySQLQuery implements Query {
    @Override
    public String execute() {
        return "Executing MySQL query.";
    }
}

// Concrete product for PostgreSQL query
class PostgreSQLQuery implements Query {
    @Override
    public String execute() {
        return "Executing PostgreSQL query.";
    }
}

// Client code
public class ClientDatabaseFactory {
    public static void clientCode(DatabaseFactory factory) {
        Connection connection = factory.createConnection();
        System.out.println(connection.connect());

        Query query = factory.createQuery();
        System.out.println(query.execute());
    }

    public static void main(String[] args) {
        System.out.println("Testing MySQL factory:");
        clientCode(new MySQLFactory());
        System.out.println();

        System.out.println("Testing PostgreSQL factory:");
        clientCode(new PostgreSQLFactory());
    }
}
