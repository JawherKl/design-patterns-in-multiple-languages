// AbstractFactory.js - Abstract Factory Interface
class AbstractFactory {
    createProductA() {
      throw new Error("Method 'createProductA()' must be implemented.");
    }
    
    createProductB() {
      throw new Error("Method 'createProductB()' must be implemented.");
    }
  }
  
  // ConcreteFactory1.js - Concrete Factory 1
  class ConcreteFactory1 extends AbstractFactory {
    createProductA() {
      return new ConcreteProductA1();
    }
    
    createProductB() {
      return new ConcreteProductB1();
    }
  }
  
  // ConcreteFactory2.js - Concrete Factory 2
  class ConcreteFactory2 extends AbstractFactory {
    createProductA() {
      return new ConcreteProductA2();
    }
    
    createProductB() {
      return new ConcreteProductB2();
    }
  }
  
  // AbstractProductA.js - Abstract Product A Interface
  class AbstractProductA {
    usefulFunctionA() {
      throw new Error("Method 'usefulFunctionA()' must be implemented.");
    }
  }
  
  // ConcreteProductA1.js - Concrete Product A1
  class ConcreteProductA1 extends AbstractProductA {
    usefulFunctionA() {
      return "The result of the product A1.";
    }
  }
  
  // ConcreteProductA2.js - Concrete Product A2
  class ConcreteProductA2 extends AbstractProductA {
    usefulFunctionA() {
      return "The result of the product A2.";
    }
  }
  
  // AbstractProductB.js - Abstract Product B Interface
  class AbstractProductB {
    usefulFunctionB() {
      throw new Error("Method 'usefulFunctionB()' must be implemented.");
    }
    
    anotherUsefulFunctionB(collaborator) {
      throw new Error("Method 'anotherUsefulFunctionB()' must be implemented.");
    }
  }
  
  // ConcreteProductB1.js - Concrete Product B1
  class ConcreteProductB1 extends AbstractProductB {
    usefulFunctionB() {
      return "The result of the product B1.";
    }
  
    anotherUsefulFunctionB(collaborator) {
      const result = collaborator.usefulFunctionA();
      return `The result of the B1 collaborating with the (${result})`;
    }
  }
  
  // ConcreteProductB2.js - Concrete Product B2
  class ConcreteProductB2 extends AbstractProductB {
    usefulFunctionB() {
      return "The result of the product B2.";
    }
  
    anotherUsefulFunctionB(collaborator) {
      const result = collaborator.usefulFunctionA();
      return `The result of the B2 collaborating with the (${result})`;
    }
  }
  
  // Client.js - Client Code
  function clientCode(factory) {
    const productA = factory.createProductA();
    const productB = factory.createProductB();
    
    console.log(productB.usefulFunctionB());
    console.log(productB.anotherUsefulFunctionB(productA));
  }
  
  // Usage
  console.log("Client: Testing client code with the first factory type:");
  clientCode(new ConcreteFactory1());
  
  console.log("\nClient: Testing the same client code with the second factory type:");
  clientCode(new ConcreteFactory2());
  