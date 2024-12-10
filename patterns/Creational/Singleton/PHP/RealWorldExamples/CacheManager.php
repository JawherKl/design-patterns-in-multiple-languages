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

use Creational\Singleton\Singleton;

/**
 * Cache Manager Singleton
 */
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
