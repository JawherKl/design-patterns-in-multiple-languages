// AbstractFactory.js - DatabaseFactory Interface
class DatabaseFactory {
    createConnection() {
      throw new Error("Method 'createConnection()' must be implemented.");
    }
  
    createQuery() {
      throw new Error("Method 'createQuery()' must be implemented.");
    }
  }
  
  // MySQLFactory.js - Concrete Factory for MySQL
  class MySQLFactory extends DatabaseFactory {
    createConnection() {
      return new MySQLConnection();
    }
  
    createQuery() {
      return new MySQLQuery();
    }
  }
  
  // PostgreSQLFactory.js - Concrete Factory for PostgreSQL
  class PostgreSQLFactory extends DatabaseFactory {
    createConnection() {
      return new PostgreSQLConnection();
    }
  
    createQuery() {
      return new PostgreSQLQuery();
    }
  }
  
  // Connection.js - Connection Interface
  class Connection {
    connect() {
      throw new Error("Method 'connect()' must be implemented.");
    }
  }
  
  // MySQLConnection.js - Concrete MySQL Connection
  class MySQLConnection extends Connection {
    connect() {
      return "Connected to MySQL database.";
    }
  }
  
  // PostgreSQLConnection.js - Concrete PostgreSQL Connection
  class PostgreSQLConnection extends Connection {
    connect() {
      return "Connected to PostgreSQL database.";
    }
  }
  
  // Query.js - Query Interface
  class Query {
    execute() {
      throw new Error("Method 'execute()' must be implemented.");
    }
  }
  
  // MySQLQuery.js - Concrete MySQL Query
  class MySQLQuery extends Query {
    execute() {
      return "Executing MySQL query.";
    }
  }
  
  // PostgreSQLQuery.js - Concrete PostgreSQL Query
  class PostgreSQLQuery extends Query {
    execute() {
      return "Executing PostgreSQL query.";
    }
  }
  
  // Client.js - Client Code
  function clientCode(factory) {
    const connection = factory.createConnection();
    console.log(connection.connect());
  
    const query = factory.createQuery();
    console.log(query.execute());
  }
  
  // Usage
  console.log("Testing MySQL factory:");
  clientCode(new MySQLFactory());
  console.log("\n");
  
  console.log("Testing PostgreSQL factory:");
  clientCode(new PostgreSQLFactory());
  