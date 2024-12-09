package main

import "fmt"

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

// SocialNetworkConnector defines the behavior of the social network connectors.
type SocialNetworkConnector interface {
	LogIn()
	LogOut()
	CreatePost(content string)
}

// SocialNetworkPoster is an abstract class that declares the factory method.
type SocialNetworkPoster interface {
	GetSocialNetwork() SocialNetworkConnector
	Post(content string)
}

// FacebookPoster is a concrete creator that works with the Facebook API.
type FacebookPoster struct {
	login    string
	password string
}

func NewFacebookPoster(login, password string) *FacebookPoster {
	return &FacebookPoster{login: login, password: password}
}

func (f *FacebookPoster) GetSocialNetwork() SocialNetworkConnector {
	return NewFacebookConnector(f.login, f.password)
}

func (f *FacebookPoster) Post(content string) {
	network := f.GetSocialNetwork()
	network.LogIn()
	network.CreatePost(content)
	network.LogOut()
}

// LinkedInPoster is a concrete creator that works with the LinkedIn API.
type LinkedInPoster struct {
	email    string
	password string
}

func NewLinkedInPoster(email, password string) *LinkedInPoster {
	return &LinkedInPoster{email: email, password: password}
}

func (l *LinkedInPoster) GetSocialNetwork() SocialNetworkConnector {
	return NewLinkedInConnector(l.email, l.password)
}

func (l *LinkedInPoster) Post(content string) {
	network := l.GetSocialNetwork()
	network.LogIn()
	network.CreatePost(content)
	network.LogOut()
}

// FacebookConnector is a concrete product that implements the Facebook API.
type FacebookConnector struct {
	login    string
	password string
}

func NewFacebookConnector(login, password string) *FacebookConnector {
	return &FacebookConnector{login: login, password: password}
}

func (f *FacebookConnector) LogIn() {
	fmt.Printf("Send HTTP API request to log in user %s with password %s\n", f.login, f.password)
}

func (f *FacebookConnector) LogOut() {
	fmt.Printf("Send HTTP API request to log out user %s\n", f.login)
}

func (f *FacebookConnector) CreatePost(content string) {
	fmt.Printf("Send HTTP API requests to create a post in Facebook timeline with content: %s\n", content)
}

// LinkedInConnector is a concrete product that implements the LinkedIn API.
type LinkedInConnector struct {
	email    string
	password string
}

func NewLinkedInConnector(email, password string) *LinkedInConnector {
	return &LinkedInConnector{email: email, password: password}
}

func (l *LinkedInConnector) LogIn() {
	fmt.Printf("Send HTTP API request to log in user %s with password %s\n", l.email, l.password)
}

func (l *LinkedInConnector) LogOut() {
	fmt.Printf("Send HTTP API request to log out user %s\n", l.email)
}

func (l *LinkedInConnector) CreatePost(content string) {
	fmt.Printf("Send HTTP API requests to create a post in LinkedIn timeline with content: %s\n", content)
}

// clientCode is the client code that works with any subclass of SocialNetworkPoster.
func clientCode(creator SocialNetworkPoster) {
	creator.Post("Hello world!")
	creator.Post("I had a large hamburger this morning!")
}

func main() {
	fmt.Println("Testing FacebookPoster:")
	clientCode(NewFacebookPoster("john_smith", "******"))
	fmt.Println()

	fmt.Println("Testing LinkedInPoster:")
	clientCode(NewLinkedInPoster("john_smith@example.com", "******"))
}
