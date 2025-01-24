// Builder interface defines the steps to build the product.
class Builder {
    producePartA() {}
    producePartB() {}
    producePartC() {}
    getProduct() {}
}

// ConcreteBuilder1 implements the Builder interface.
class ConcreteBuilder1 extends Builder {
    constructor() {
        super();
        this.reset();
    }

    reset() {
        this.product = new Product1();
    }

    producePartA() {
        this.product.parts.push("PartA1");
    }

    producePartB() {
        this.product.parts.push("PartB1");
    }

    producePartC() {
        this.product.parts.push("PartC1");
    }

    getProduct() {
        const result = this.product;
        this.reset();
        return result;
    }
}

// Product represents the complex object being constructed.
class Product1 {
    constructor() {
        this.parts = [];
    }

    listParts() {
        console.log(`Product parts: ${this.parts.join(", ")}\n`);
    }
}

// Director orchestrates the construction process.
class Director {
    setBuilder(builder) {
        this.builder = builder;
    }

    buildMinimalViableProduct() {
        this.builder.producePartA();
    }

    buildFullFeaturedProduct() {
        this.builder.producePartA();
        this.builder.producePartB();
        this.builder.producePartC();
    }
}

// Client code
function clientCode(director) {
    const builder = new ConcreteBuilder1();
    director.setBuilder(builder);

    console.log("Standard basic product:");
    director.buildMinimalViableProduct();
    builder.getProduct().listParts();

    console.log("Standard full featured product:");
    director.buildFullFeaturedProduct();
    builder.getProduct().listParts();

    console.log("Custom product:");
    builder.producePartA();
    builder.producePartC();
    builder.getProduct().listParts();
}

const director = new Director();
clientCode(director);