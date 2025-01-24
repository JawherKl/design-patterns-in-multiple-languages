package patterns.Creational.Builder.Java;

// Builder interface defines the steps to build the product.
interface Builder {
    void producePartA();
    void producePartB();
    void producePartC();
    Product getProduct();
}

// ConcreteBuilder1 implements the Builder interface.
class ConcreteBuilder1 implements Builder {
    private Product product;

    public ConcreteBuilder1() {
        this.reset();
    }

    public void reset() {
        this.product = new Product();
    }

    @Override
    public void producePartA() {
        this.product.addPart("PartA1");
    }

    @Override
    public void producePartB() {
        this.product.addPart("PartB1");
    }

    @Override
    public void producePartC() {
        this.product.addPart("PartC1");
    }

    @Override
    public Product getProduct() {
        Product result = this.product;
        this.reset();
        return result;
    }
}

// Product represents the complex object being constructed.
class Product {
    private java.util.List<String> parts = new java.util.ArrayList<>();

    public void addPart(String part) {
        this.parts.add(part);
    }

    public void listParts() {
        System.out.println("Product parts: " + String.join(", ", parts) + "\n");
    }
}

// Director orchestrates the construction process.
class Director {
    private Builder builder;

    public void setBuilder(Builder builder) {
        this.builder = builder;
    }

    public void buildMinimalViableProduct() {
        this.builder.producePartA();
    }

    public void buildFullFeaturedProduct() {
        this.builder.producePartA();
        this.builder.producePartB();
        this.builder.producePartC();
    }
}

// Client code
public class Main {
    public static void main(String[] args) {
        Director director = new Director();
        ConcreteBuilder1 builder = new ConcreteBuilder1();
        director.setBuilder(builder);

        System.out.println("Standard basic product:");
        director.buildMinimalViableProduct();
        builder.getProduct().listParts();

        System.out.println("Standard full featured product:");
        director.buildFullFeaturedProduct();
        builder.getProduct().listParts();

        System.out.println("Custom product:");
        builder.producePartA();
        builder.producePartC();
        builder.getProduct().listParts();
    }
}