<?php
use PHPUnit\Framework\TestCase;
use Patterns\Creational\FactoryMethod\Factory;

class FactoryMethodTest extends TestCase
{
    public function testFactoryProducesCorrectObject()
    {
        $factory = new Factory();
        $product = $factory->createProduct('ConcreteProduct');
        $this->assertInstanceOf(ConcreteProduct::class, $product);
    }
}
