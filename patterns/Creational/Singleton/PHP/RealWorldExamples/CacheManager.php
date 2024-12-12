<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Cache Manager Example
|--------------------------------------------------------------------------
| This example demonstrates the Singleton Design Pattern for managing a 
| cache system, ensuring that only one instance of the cache manager 
| exists and is used throughout the application.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Singleton Class**: Implements the `getInstance` method to manage 
|    the single instance of the cache manager.
| 2. **Static Instance Storage**: Ensures only one instance of the cache 
|    manager is created.
| 3. **Client Code**: Demonstrates caching data using the singleton cache 
|    manager instance.
|
| Use Case:
| Use the Singleton pattern to manage a global cache system, ensuring that 
| all parts of the application access and modify the cache through the 
| same instance, optimizing memory and performance.
*/

namespace Creational\Singleton\RealWorldExamples;

/**
 * Cache Manager Singleton
 */
class Singleton
{
    /**
     * The actual singleton's instance almost always resides inside a static
     * field. In this case, the static field is an array, where each subclass of
     * the Singleton stores its own instance.
     */
    private static $instances = [];

    /**
     * Singleton's constructor should not be public. However, it can't be
     * private either if we want to allow subclassing.
     */
    protected function __construct() { }

    /**
     * Cloning and unserialization are not permitted for singletons.
     */
    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * The method you use to get the Singleton's instance.
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            // Note that here we use the "static" keyword instead of the actual
            // class name. In this context, the "static" keyword means "the name
            // of the current class". That detail is important because when the
            // method is called on the subclass, we want an instance of that
            // subclass to be created here.

            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }
}
class CacheManager extends Singleton
{
    private $cache = [];

    protected function __construct() { }

    public function set(string $key, $value): void
    {
        $this->cache[$key] = $value;
    }

    public function get(string $key)
    {
        return $this->cache[$key] ?? null;
    }
}

// Client code
$cache = CacheManager::getInstance();
$cache->set('user_1', ['name' => 'John Doe', 'email' => 'john@example.com']);

$user = $cache->get('user_1');
echo "Cached User: " . json_encode($user) . "\n";
