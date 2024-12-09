/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern - Social Network Example
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern, allowing for 
| dynamic creation of different types of social network connectors (e.g., 
| Facebook, LinkedIn) without specifying the exact class to instantiate.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/FactoryMethod/RealWorldExample
| @version   1.0.0
| @license   MIT License
| @author    JawherKl
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. SocialNetworkPoster (Abstract Class): Declares the factory method 
|    `getSocialNetwork` that returns a SocialNetworkConnector. Includes common 
|    logic for posting content to a social network.
| 2. Concrete Social Network Posters: Implement the factory method to create 
|    specific connectors like FacebookConnector and LinkedInConnector.
| 3. SocialNetworkConnector (Interface): Defines the behavior of social 
|    network connectors, including methods like `logIn`, `logOut`, and 
|    `createPost`.
| 4. Concrete Social Network Connectors: Implement the SocialNetworkConnector 
|    interface for specific platforms (e.g., Facebook, LinkedIn).
| 5. Client Code: Works with SocialNetworkPoster via its abstract interface, 
|    enabling flexibility and decoupling from concrete implementations.
|--------------------------------------------------------------------------
| Use Case:
| Use the Factory Method pattern when the application needs to support 
| multiple types of social network integrations without hardcoding the 
| specifics of each connector. This approach promotes scalability and adherence 
| to the open/closed principle.
*/

// Abstract Class for SocialNetworkPoster
class SocialNetworkPoster {
    // Abstract Factory Method
    getSocialNetwork() {
      throw new Error("This method must be implemented by subclasses");
    }
  
    // Logic for posting content using the created connector
    post(content) {
      const network = this.getSocialNetwork();
      network.logIn();
      network.createPost(content);
      network.logOut();
    }
  }
  
  // Concrete Creator: FacebookPoster
  class FacebookPoster extends SocialNetworkPoster {
    constructor(login, password) {
      super();
      this.login = login;
      this.password = password;
    }
  
    getSocialNetwork() {
      return new FacebookConnector(this.login, this.password);
    }
  }
  
  // Concrete Creator: LinkedInPoster
  class LinkedInPoster extends SocialNetworkPoster {
    constructor(email, password) {
      super();
      this.email = email;
      this.password = password;
    }
  
    getSocialNetwork() {
      return new LinkedInConnector(this.email, this.password);
    }
  }
  
  // SocialNetworkConnector Interface (Implemented as an Abstract Class)
  class SocialNetworkConnector {
    logIn() {
      throw new Error("This method must be implemented by concrete classes");
    }
  
    logOut() {
      throw new Error("This method must be implemented by concrete classes");
    }
  
    createPost(content) {
      throw new Error("This method must be implemented by concrete classes");
    }
  }
  
  // Concrete Product: FacebookConnector
  class FacebookConnector extends SocialNetworkConnector {
    constructor(login, password) {
      super();
      this.login = login;
      this.password = password;
    }
  
    logIn() {
      console.log(`Send HTTP API request to log in user ${this.login} with password ${this.password}`);
    }
  
    logOut() {
      console.log(`Send HTTP API request to log out user ${this.login}`);
    }
  
    createPost(content) {
      console.log("Send HTTP API requests to create a post in Facebook timeline.");
    }
  }
  
  // Concrete Product: LinkedInConnector
  class LinkedInConnector extends SocialNetworkConnector {
    constructor(email, password) {
      super();
      this.email = email;
      this.password = password;
    }
  
    logIn() {
      console.log(`Send HTTP API request to log in user ${this.email} with password ${this.password}`);
    }
  
    logOut() {
      console.log(`Send HTTP API request to log out user ${this.email}`);
    }
  
    createPost(content) {
      console.log("Send HTTP API requests to create a post in LinkedIn timeline.");
    }
  }
  
  // Client code can work with any subclass of SocialNetworkPoster
  function clientCode(creator) {
    creator.post("Hello world!");
    creator.post("I had a large hamburger this morning!");
  }
  
  // During initialization, the app can decide which social network to use
  console.log("Testing ConcreteCreator1:");
  clientCode(new FacebookPoster("john_smith", "******"));
  console.log("\n");
  
  console.log("Testing ConcreteCreator2:");
  clientCode(new LinkedInPoster("john_smith@example.com", "******"));
  console.log("\n");
  