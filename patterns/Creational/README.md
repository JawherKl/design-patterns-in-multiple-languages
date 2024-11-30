[ Switch to French 🇫🇷](README_fr.md)

# Creational Design Patterns

This folder includes examples of common **Creational Design Patterns** implemented in PHP, Go, Js and Java. Creational patterns are designed to handle object creation mechanisms, making the creation process more flexible and efficient.

## Table of Contents
1. [Prototype Design Pattern](#prototype-design-pattern)
2. [Singleton Design Pattern](#singleton-design-pattern)

---

### Prototype Design Pattern
The **Prototype Design Pattern** allows you to create new objects by copying existing instances, known as prototypes, without directly depending on their classes. This pattern is helpful when the cost of creating a new object is high, and duplicating an existing instance provides a more efficient solution.

#### Example: Page Prototype
```php
<?php
use Creational\Prototype\RealWorldExamples\Page;
use Creational\Prototype\RealWorldExamples\Author;

$author = new Author("John Smith");
$page = new Page("Tip of the day", "Keep calm and carry on.", $author);

$page->addComment("Nice tip, thanks!");

$draft = clone $page;
echo "Cloned page instance:\n";
print_r($draft);
```

In this example:
- We create a `Page` object with an `Author`.
- When cloning the `Page` object, a copy is created with specific fields reset or modified (e.g., title prefixed with "Copy of", comments cleared).

#### Use Cases
- **When creating objects is costly** (e.g., complex or resource-intensive initialization).
- **When you want to duplicate objects with specific changes**, such as creating multiple versions of a document.

---

### Singleton Design Pattern
The **Singleton Design Pattern** ensures that only one instance of a class is created and provides a global access point to that instance. This pattern is particularly useful when one object should control shared resources or centralize a system-wide action.

#### Example 1: Logger Singleton

A `Logger` class is used to manage application logs, ensuring all logs are handled by a single instance.

```php
<?php
use Creational\Singleton\RealWorldExamples\Logger;

Logger::log("Application started");

$logger1 = Logger::getInstance();
$logger2 = Logger::getInstance();

if ($logger1 === $logger2) {
    echo "Logger has a single instance.\n";
}
```

#### Example 2: Database Connection Singleton

Manages a single instance of a database connection, preventing the overhead of creating multiple connections.

```php
<?php
use Creational\Singleton\RealWorldExamples\DatabaseConnection;

$dbConnection1 = DatabaseConnection::getInstance();
$dbConnection2 = DatabaseConnection::getInstance();

if ($dbConnection1 === $dbConnection2) {
    echo "Only one instance of DatabaseConnection exists.\n";
}
```

#### Example 3: Cache Manager Singleton

A `CacheManager` singleton instance is used to handle caching of data in memory.

```php
<?php
use Creational\Singleton\RealWorldExamples\CacheManager;

$cache = CacheManager::getInstance();
$cache->set('user_1', ['name' => 'John Doe', 'email' => 'john@example.com']);

echo "Cached data: " . json_encode($cache->get('user_1')) . "\n";
```

#### Use Cases
- **Logging**: When all application logs need to be managed centrally.
- **Configuration Management**: When application configurations should be accessible globally.
- **Database Connections**: To prevent multiple connections and reduce resource use.

---

## How to Use
1. Clone or download this repository.
2. Navigate to the desired pattern (e.g., `Prototype` or `Singleton`).
3. Run examples in the terminal by executing:
   ```bash
   php path/to/your/example.php
   ```

---

## License
This project is licensed under the MIT License.
