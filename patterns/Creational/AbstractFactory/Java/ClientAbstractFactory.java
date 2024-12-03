/*
|--------------------------------------------------------------------------
| Abstract Factory Design Pattern - Abstract Factory
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/AbstractFactory
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

package patterns.Creational.AbstractFactory.Java;

// Abstract Factory interface that declares methods for creating abstract products
interface AbstractFactorys {
    AbstractProductA createProductA();
    AbstractProductB createProductB();
}

// Concrete Factory 1 implements the AbstractFactory and creates Concrete Products
class ConcreteFactory1 implements AbstractFactorys {
    @Override
    public AbstractProductA createProductA() {
        return new ConcreteProductA1();
    }

    @Override
    public AbstractProductB createProductB() {
        return new ConcreteProductB1();
    }
}

// Concrete Factory 2 implements the AbstractFactory and creates Concrete Products
class ConcreteFactory2 implements AbstractFactorys {
    @Override
    public AbstractProductA createProductA() {
        return new ConcreteProductA2();
    }

    @Override
    public AbstractProductB createProductB() {
        return new ConcreteProductB2();
    }
}

// Abstract Product A
interface AbstractProductA {
    String usefulFunctionA();
}

// Concrete Product A1 implements AbstractProductA
class ConcreteProductA1 implements AbstractProductA {
    @Override
    public String usefulFunctionA() {
        return "The result of the product A1.";
    }
}

// Concrete Product A2 implements AbstractProductA
class ConcreteProductA2 implements AbstractProductA {
    @Override
    public String usefulFunctionA() {
        return "The result of the product A2.";
    }
}

// Abstract Product B
interface AbstractProductB {
    String usefulFunctionB();
    String anotherUsefulFunctionB(AbstractProductA collaborator);
}

// Concrete Product B1 implements AbstractProductB
class ConcreteProductB1 implements AbstractProductB {
    @Override
    public String usefulFunctionB() {
        return "The result of the product B1.";
    }

    @Override
    public String anotherUsefulFunctionB(AbstractProductA collaborator) {
        String result = collaborator.usefulFunctionA();
        return "The result of the B1 collaborating with the (" + result + ")";
    }
}

// Concrete Product B2 implements AbstractProductB
class ConcreteProductB2 implements AbstractProductB {
    @Override
    public String usefulFunctionB() {
        return "The result of the product B2.";
    }

    @Override
    public String anotherUsefulFunctionB(AbstractProductA collaborator) {
        String result = collaborator.usefulFunctionA();
        return "The result of the B2 collaborating with the (" + result + ")";
    }
}

// Client code works with factories and products only through abstract types
public class ClientAbstractFactory {
    public static void clientCode(AbstractFactorys factory) {
        AbstractProductA productA = factory.createProductA();
        AbstractProductB productB = factory.createProductB();

        System.out.println(productB.usefulFunctionB());
        System.out.println(productB.anotherUsefulFunctionB(productA));
    }

    public static void main(String[] args) {
        System.out.println("Client: Testing client code with the first factory type:");
        clientCode(new ConcreteFactory1());

        System.out.println();

        System.out.println("Client: Testing the same client code with the second factory type:");
        clientCode(new ConcreteFactory2());
    }
}
