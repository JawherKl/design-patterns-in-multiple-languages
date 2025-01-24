[ Passer en Anglais 🇬🇧](README.md)

# Vue d'ensemble des Design Patterns

![design-patterns](https://github.com/JawherKl/design-patterns-in-multiple-languages/blob/main/docs/design-patterns.jpeg)

Ce dépôt fournit un guide complet sur les **Design Patterns** en génie logiciel. Les design patterns sont des solutions éprouvées aux problèmes courants de conception logicielle. Ils favorisent la réutilisabilité, la flexibilité et la maintenabilité du code. Ci-dessous, nous explorons les trois principales catégories de design patterns :

---

## Table des matières

1. [Design Patterns Comportementaux](#design-patterns-comportementaux)
2. [Design Patterns Créationnels](#design-patterns-créationnels)
3. [Design Patterns Structuraux](#design-patterns-structuraux)

---

## Design Patterns Comportementaux

Les **design patterns comportementaux** sont liés aux algorithmes et à l'attribution des responsabilités entre les objets. Ils aident à gérer la communication entre les objets et facilitent la maintenance et l'extension des systèmes logiciels.

### Principaux Design Patterns Comportementaux :
- **Strategy** : Définit une famille d'algorithmes et permet de les rendre interchangeables.
- **Observer** : Permet à un objet (le sujet) d'avertir d'autres objets (les observateurs) de tout changement dans son état.
- **Command** : Encapsule une requête sous forme d'objet, ce qui découple l'émetteur et le récepteur.

### Exemple :
```php
// Exemple de Design Pattern Strategy
class PaymentProcessor {
    private $paymentMethod;

    public function __construct(PaymentMethod $method) {
        $this->paymentMethod = $method;
    }

    public function processPayment($amount) {
        $this->paymentMethod->pay($amount);
    }
}
```

---

## Design Patterns Créationnels

Les **design patterns créationnels** se concentrent sur les mécanismes de création d'objets. Ils sont conçus pour instancier des objets de manière adaptée à la situation. Ces patterns offrent une flexibilité dans la création des objets tout en évitant le couplage strict dans le code.

### Principaux Design Patterns Créationnels :
- **Singleton** : Garantit qu'une classe n'a qu'une seule instance et fournit un point d'accès global à celle-ci.
- **Factory Method** : Définit une interface pour créer un objet, mais permet aux sous-classes de modifier le type d'objet créé.
- **Abstract Factory** : Crée des familles d'objets liés ou dépendants sans spécifier leurs classes concrètes.

### Exemple :
```php
// Exemple de Design Pattern Singleton
class DatabaseConnection {
    private static $instance;

    private function __construct() {
        // constructeur privé
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }
}
```

---

## Design Patterns Structuraux

Les **design patterns structuraux** concernent la composition des classes ou des objets. Ils aident à garantir que les classes et les objets de votre application travaillent ensemble de manière flexible et évolutive. Ces patterns sont utilisés pour simplifier la conception et la structure de votre logiciel.

### Principaux Design Patterns Structuraux :
- **Adapter** : Permet à des interfaces incompatibles de fonctionner ensemble.
- **Decorator** : Ajoute des fonctionnalités supplémentaires à un objet à l'exécution.
- **Facade** : Fournit une interface simplifiée pour un sous-système complexe.

### Exemple :
```php
// Exemple de Design Pattern Adapter
class WeatherAPI {
    public function getWeatherData() {
        return "Données météo depuis l'API";
    }
}

class WeatherAdapter {
    private $weatherAPI;

    public function __construct(WeatherAPI $weatherAPI) {
        $this->weatherAPI = $weatherAPI;
    }

    public function getTemperature() {
        $data = $this->weatherAPI->getWeatherData();
        return "Température extraite : " . $data;
    }
}
```

---

## Conclusion

Les design patterns sont des outils essentiels en génie logiciel qui résolvent des problèmes courants de conception et de maintenabilité. Comprendre ces patterns vous aide à écrire un code plus évolutif, flexible et réutilisable. 

### Explorez davantage :
- Pour les **design patterns comportementaux**, consultez des patterns spécifiques comme **Strategy** et **Observer**.
- Pour les **design patterns créationnels**, explorez **Singleton** et **Abstract Factory**.
- Pour les **design patterns structuraux**, plongez plus profondément dans **Adapter** et **Decorator**.
