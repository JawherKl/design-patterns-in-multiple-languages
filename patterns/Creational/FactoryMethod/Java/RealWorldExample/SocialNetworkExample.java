package patterns.Creational.FactoryMethod.Java.RealWorldExample;

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

// SocialNetworkConnector interface
interface SocialNetworkConnector {
    void logIn();
    void logOut();
    void createPost(String content);
}

// FacebookConnector implementation
class FacebookConnector implements SocialNetworkConnector {
    private String login;
    private String password;

    public FacebookConnector(String login, String password) {
        this.login = login;
        this.password = password;
    }

    @Override
    public void logIn() {
        System.out.println("Send HTTP API request to log in user " + this.login + " with password " + this.password);
    }

    @Override
    public void logOut() {
        System.out.println("Send HTTP API request to log out user " + this.login);
    }

    @Override
    public void createPost(String content) {
        System.out.println("Send HTTP API requests to create a post in Facebook timeline.");
    }
}

// LinkedInConnector implementation
class LinkedInConnector implements SocialNetworkConnector {
    private String email;
    private String password;

    public LinkedInConnector(String email, String password) {
        this.email = email;
        this.password = password;
    }

    @Override
    public void logIn() {
        System.out.println("Send HTTP API request to log in user " + this.email + " with password " + this.password);
    }

    @Override
    public void logOut() {
        System.out.println("Send HTTP API request to log out user " + this.email);
    }

    @Override
    public void createPost(String content) {
        System.out.println("Send HTTP API requests to create a post in LinkedIn timeline.");
    }
}

// Abstract SocialNetworkPoster class
abstract class SocialNetworkPoster {
    // Factory method to be implemented by subclasses
    public abstract SocialNetworkConnector getSocialNetwork();

    // Core logic for posting content
    public void post(String content) {
        SocialNetworkConnector network = getSocialNetwork();
        network.logIn();
        network.createPost(content);
        network.logOut();
    }
}

// FacebookPoster implementation
class FacebookPoster extends SocialNetworkPoster {
    private String login;
    private String password;

    public FacebookPoster(String login, String password) {
        this.login = login;
        this.password = password;
    }

    @Override
    public SocialNetworkConnector getSocialNetwork() {
        return new FacebookConnector(this.login, this.password);
    }
}

// LinkedInPoster implementation
class LinkedInPoster extends SocialNetworkPoster {
    private String email;
    private String password;

    public LinkedInPoster(String email, String password) {
        this.email = email;
        this.password = password;
    }

    @Override
    public SocialNetworkConnector getSocialNetwork() {
        return new LinkedInConnector(this.email, this.password);
    }
}

// Client code
public class SocialNetworkExample {
    public static void clientCode(SocialNetworkPoster creator) {
        creator.post("Hello world!");
        creator.post("I had a large hamburger this morning!");
    }

    public static void main(String[] args) {
        System.out.println("Testing FacebookPoster:");
        clientCode(new FacebookPoster("john_smith", "******"));
        System.out.println("\n");

        System.out.println("Testing LinkedInPoster:");
        clientCode(new LinkedInPoster("john_smith@example.com", "******"));
        System.out.println("\n");
    }
}