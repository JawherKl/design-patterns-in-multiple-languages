const Factory = require('../patterns/creational/FactoryMethod/Factory');

test('Factory creates the correct product', () => {
  const factory = new Factory();
  const product = factory.createProduct('ConcreteProduct');
  expect(product.getName()).toBe('ConcreteProduct');
});