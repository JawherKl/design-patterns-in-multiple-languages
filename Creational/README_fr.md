[ Passer en Anglais 🇬🇧](README.md)

# Les Design Patterns Créationnels

Ce dossier contient des exemples de **Design Patterns Créationnels** courants implémentés en PHP. Les patterns créationnels sont conçus pour gérer les mécanismes de création des objets, rendant le processus de création plus flexible et efficace.

## Table des Matières

1. [Design Pattern Prototype](#design-pattern-prototype)  
2. [Design Pattern Singleton](#design-pattern-singleton)

---

### Design Pattern Prototype

Le **Design Pattern Prototype** permet de créer de nouveaux objets en copiant des instances existantes, appelées prototypes, sans dépendre directement de leurs classes. Ce pattern est utile lorsque le coût de création d’un nouvel objet est élevé et que dupliquer une instance existante offre une solution plus efficace.

#### Exemple : Prototype de Page

```php
<?php
use Creational\Prototype\RealWorldExamples\Page;
use Creational\Prototype\RealWorldExamples\Author;

$author = new Author("John Smith");
$page = new Page("Astuce du jour", "Restez calme et continuez.", $author);

$page->addComment("Super astuce, merci !");

$draft = clone $page;
echo "Instance de page clonée :\n";
print_r($draft);
```

Dans cet exemple :  
- Nous créons un objet `Page` avec un `Author`.  
- En clonant l’objet `Page`, une copie est créée avec certains champs réinitialisés ou modifiés (par exemple, le titre est préfixé par "Copie de", les commentaires sont effacés).

#### Cas d'Utilisation

- **Quand créer des objets est coûteux** (par exemple, initialisation complexe ou gourmande en ressources).  
- **Quand vous souhaitez dupliquer des objets avec des modifications spécifiques**, comme créer plusieurs versions d’un document.

---

### Design Pattern Singleton

Le **Design Pattern Singleton** garantit qu'une seule instance d'une classe est créée et fournit un point d'accès global à cette instance. Ce pattern est particulièrement utile lorsqu’un objet doit contrôler des ressources partagées ou centraliser une action à l’échelle du système.

#### Exemple 1 : Singleton pour un Logger

Une classe `Logger` est utilisée pour gérer les journaux de l'application, en s'assurant que tous les journaux sont traités par une seule instance.

```php
<?php
use Creational\Singleton\RealWorldExamples\Logger;

Logger::log("Application démarrée");

$logger1 = Logger::getInstance();
$logger2 = Logger::getInstance();

if ($logger1 === $logger2) {
    echo "Logger a une seule instance.\n";
}
```

#### Exemple 2 : Singleton pour une Connexion à la Base de Données

Gère une seule instance d'une connexion à la base de données, évitant ainsi le coût de création de connexions multiples.

```php
<?php
use Creational\Singleton\RealWorldExamples\DatabaseConnection;

$dbConnection1 = DatabaseConnection::getInstance();
$dbConnection2 = DatabaseConnection::getInstance();

if ($dbConnection1 === $dbConnection2) {
    echo "Il n’existe qu’une seule instance de DatabaseConnection.\n";
}
```

#### Exemple 3 : Singleton pour un Gestionnaire de Cache

Une instance singleton de `CacheManager` est utilisée pour gérer la mise en cache des données en mémoire.

```php
<?php
use Creational\Singleton\RealWorldExamples\CacheManager;

$cache = CacheManager::getInstance();
$cache->set('user_1', ['name' => 'John Doe', 'email' => 'john@example.com']);

echo "Données mises en cache : " . json_encode($cache->get('user_1')) . "\n";
```

#### Cas d'Utilisation

- **Journalisation (Logging)** : Lorsque tous les journaux de l'application doivent être gérés de manière centralisée.  
- **Gestion de la Configuration** : Lorsque les configurations de l'application doivent être accessibles globalement.  
- **Connexions à la Base de Données** : Pour éviter des connexions multiples et réduire l'utilisation des ressources.

---

## Comment Utiliser

1. Clonez ou téléchargez ce dépôt.  
2. Naviguez jusqu'au pattern souhaité (par exemple, `Prototype` ou `Singleton`).  
3. Exécutez les exemples dans le terminal en lançant :  
   ```bash
   php chemin/vers/votre/exemple.php
   ```

---

## Licence

Ce projet est sous licence MIT.