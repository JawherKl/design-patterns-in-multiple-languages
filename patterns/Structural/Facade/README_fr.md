Le **Facade** est un patron de conception structurel qui fournit une interface simplifiée (mais limitée) à un système complexe de classes, de bibliothèques ou de frameworks.

Bien que le **Facade** réduise la complexité globale de l'application, il aide également à regrouper les dépendances indésirables en un seul endroit.

# Exemple conceptuel :  
Cet exemple illustre la structure du patron de conception **Facade** et se concentre sur les questions suivantes :  
- De quelles classes est-il composé ?  
- Quels rôles ces classes jouent-elles ?  
- De quelle manière les éléments du patron sont-ils liés ?  

Après avoir compris la structure du patron, il vous sera plus facile de saisir l'exemple suivant, basé sur un cas réel utilisant PHP, Go, JavaScript et Java.

# Exemple réel :  
## Sous-système  
Dans cet exemple, le **Facade** masque la complexité de l'API YouTube et de la bibliothèque FFmpeg par rapport au code client. Au lieu de manipuler des dizaines de classes, le client utilise une méthode simple sur le **Facade**.

## Commande de repas (**MealOrder**)  
Cet exemple démontre comment simplifier les interactions avec un sous-système complexe en créant une interface unifiée (**Facade**) qui permet un accès facile aux fonctionnalités du sous-système.

### Explication :  
1. **Sous-systèmes :**  
   - `Restaurant` gère la préparation des repas.  
   - `DeliveryService` s'occupe de la livraison des repas.  
   - `PaymentProcessor` traite les paiements.  

2. **Classe Facade :**  
   - `MealOrderFacade` fournit une méthode unique `placeOrder` pour encapsuler les interactions avec les sous-systèmes.  

3. **Code client :**  
   - Le client interagit uniquement avec `MealOrderFacade`, simplifiant ainsi le processus de commande.

## Domotique (**HomeAutomation**)  
Cet exemple démontre comment contrôler un système de domotique complexe via une interface simple en utilisant le patron **Facade**.

### Explication :  
1. **Sous-systèmes :**  
   - `SmartLights` contrôle les lumières (allumer/atténuer).  
   - `Thermostat` régule la température de la maison.  
   - `SecuritySystem` gère la sécurité (activer/désactiver).  

2. **Classe Facade :**  
   - `SmartHomeFacade` fournit des méthodes telles que `startMorningRoutine` et `startNightRoutine` qui combinent les opérations des sous-systèmes en routines simples.  

3. **Code client :**  
   - Le client appelle des méthodes de haut niveau sur `SmartHomeFacade` au lieu d'interagir directement avec les sous-systèmes individuels.