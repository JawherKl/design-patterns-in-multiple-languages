[🇫🇷 Passer au français](README_fr.md)

# Modèles de conception comportementaux

Ce dossier contient des exemples courants de **Modèles de conception comportementaux** implémentés en PHP, Go, JavaScript et Java. Les modèles comportementaux se concentrent sur l’interaction entre les objets, en veillant à ce qu’ils collaborent efficacement et décrivent souvent comment les responsabilités sont réparties entre eux.

## Table des matières  
1. [Modèle de conception Chaîne de responsabilité (Chain of Responsibility)](#modèle-de-conception-chaîne-de-responsabilité)  
2. [Modèle de conception Commande (Command)](#modèle-de-conception-commande)  
3. [Modèle de conception Itérateur (Iterator)](#modèle-de-conception-itérateur)  
4. [Modèle de conception Médiateur (Mediator)](#modèle-de-conception-médiateur)  
5. [Modèle de conception Observateur (Observer)](#modèle-de-conception-observateur)  
6. [Modèle de conception État (State)](#modèle-de-conception-état)  
7. [Modèle de conception Stratégie (Strategy)](#modèle-de-conception-stratégie)  
8. [Modèle de conception Méthode Template (Template Method)](#modèle-de-conception-méthode-template)  
9. [Modèle de conception Visiteur (Visitor)](#modèle-de-conception-visiteur)

---

### Modèle de conception Chaîne de responsabilité (Chain of Responsibility)  
Le **Modèle Chaîne de responsabilité** transmet des requêtes le long d'une chaîne de manipulateurs. Chaque manipulateur décide de traiter la requête ou de la transmettre au suivant.

#### Exemple : Gestionnaire de requêtes  
```php  
<?php  
use Behavioral\ChainOfResponsibility\RealWorldExamples\Logger;  
use Behavioral\ChainOfResponsibility\RealWorldExamples\ErrorHandler;  

$logger = new Logger(Logger::INFO);  
$errorHandler = new ErrorHandler();  
$logger->setNext($errorHandler);  

$logger->handle("Ceci est un message d'information", Logger::INFO);  
$logger->handle("Ceci est un message d'erreur", Logger::ERROR);  
```  
Dans cet exemple :  
- `Logger` et `ErrorHandler` forment une chaîne de manipulateurs.  
- Chaque manipulateur décide s'il doit traiter le message ou le transmettre.

#### Cas d'utilisation  
- Cadres de journalisation où différents niveaux de log sont traités par des manipulateurs différents.  
- Chaînes de validation pour le traitement des entrées utilisateur.

---

### Modèle de conception Commande (Command)  
Le **Modèle Commande** encapsule une requête sous forme d'objet, permettant ainsi de paramétrer les clients avec des requêtes différentes ou de les mettre en file d'attente.

#### Exemple : Commandes d'interrupteur  
```php  
<?php  
use Behavioral\Command\RealWorldExamples\Light;  
use Behavioral\Command\RealWorldExamples\LightOnCommand;  
use Behavioral\Command\RealWorldExamples\RemoteControl;  

$light = new Light();  
$command = new LightOnCommand($light);  
$remote = new RemoteControl();  

$remote->setCommand($command);  
$remote->pressButton();  
```  
Dans cet exemple :  
- `LightOnCommand` encapsule la demande d'allumer la lumière.  
- `RemoteControl` agit comme un invocateur pour exécuter la commande.

#### Cas d'utilisation  
- Mise en file d'attente des requêtes dans les gestionnaires de tâches.  
- Mécanismes d'annulation/rétablissement dans les applications.

---

### Modèle de conception Observateur (Observer)  
Le **Modèle Observateur** définit une dépendance un-à-plusieurs entre objets, de sorte que lorsque l'état d'un objet change, tous ses dépendants sont informés.

#### Exemple : Abonnement à une newsletter  
```php  
<?php  
use Behavioral\Observer\RealWorldExamples\Newsletter;  
use Behavioral\Observer\RealWorldExamples\User;  

$newsletter = new Newsletter();  
$user1 = new User("Alice");  
$user2 = new User("Bob");  

$newsletter->subscribe($user1);  
$newsletter->subscribe($user2);  

$newsletter->notify("Nouvelle édition publiée !");  
```  
Dans cet exemple :  
- `Newsletter` informe tous les utilisateurs abonnés lorsqu'une nouvelle édition est disponible.  
- Les objets `User` réagissent à la notification et affichent le message.

#### Cas d'utilisation  
- Écouteurs d'événements dans les frameworks d'interface utilisateur.  
- Systèmes en temps réel comme les mises à jour des prix des actions.

---

### Modèle de conception Stratégie (Strategy)  
Le **Modèle Stratégie** définit une famille d'algorithmes, les encapsule et les rend interchangeables dynamiquement.

#### Exemple : Stratégie de paiement  
```php  
<?php  
use Behavioral\Strategy\RealWorldExamples\PaymentContext;  
use Behavioral\Strategy\RealWorldExamples\CreditCardPayment;  

$payment = new PaymentContext(new CreditCardPayment());  
$payment->pay(100);  
```  
Dans cet exemple :  
- `CreditCardPayment` implémente une stratégie de paiement spécifique.  
- `PaymentContext` permet de changer dynamiquement la méthode de paiement.

#### Cas d'utilisation  
- Implémentation de différents algorithmes de tri ou de recherche.  
- Traitement des paiements avec plusieurs méthodes.

---

### Modèle de conception État (State)  
Le **Modèle État** permet à un objet de modifier son comportement lorsque son état interne change.

#### Exemple : Système de feux de circulation  
```php  
<?php  
use Behavioral\State\RealWorldExamples\TrafficLight;  

$trafficLight = new TrafficLight();  
$trafficLight->changeState(); // Vert  
$trafficLight->changeState(); // Jaune  
$trafficLight->changeState(); // Rouge  
```  
Dans cet exemple :  
- `TrafficLight` change dynamiquement de comportement selon son état actuel.

#### Cas d'utilisation  
- Machines à états finis dans les jeux ou moteurs de workflow.  
- Composants d'interface utilisateur changeant de comportement selon l'état.

---

## Comment utiliser  
1. Clonez ou téléchargez ce dépôt.  
2. Accédez au modèle souhaité (par exemple, `Observer`, `Strategy`, `Command`).  
3. Exécutez les exemples dans le terminal en utilisant :  
   ```bash  
   php chemin/vers/votre/exemple.php  
   ```

---

## Licence  
Ce projet est sous licence MIT.
