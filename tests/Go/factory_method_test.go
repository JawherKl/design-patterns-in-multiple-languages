package factorymethod

import (
    "testing"
)

func TestFactoryProducesCorrectObject(t *testing.T) {
    factory := Factory{}
    product := factory.CreateProduct("ConcreteProduct")
    if product.Name() != "ConcreteProduct" {
        t.Errorf("Expected ConcreteProduct, got %s", product.Name())
    }
}
