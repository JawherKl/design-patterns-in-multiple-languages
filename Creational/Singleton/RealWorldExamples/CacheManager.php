<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern - Cache Manager
|--------------------------------------------------------------------------
| Implement Singleton Design Pattern for cache management.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Singleton
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Singleton\RealWorldExamples;

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
