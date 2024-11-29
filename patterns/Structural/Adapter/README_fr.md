<!--**Adapter - Modèle de conception structurel** -->

L'Adapter est un modèle de conception structurel qui permet à des objets ayant des interfaces incompatibles de collaborer.  

L'Adapter agit comme un intermédiaire entre deux objets. Il intercepte les appels destinés à un objet et les transforme dans un format ou une interface compréhensible par le second objet.  

---

### **Exemple conceptuel :**  
Cet exemple illustre la structure du modèle de conception Adapter et répond aux questions suivantes :  
- De quelles classes est-il composé ?  
- Quels rôles ces classes jouent-elles ?  
- Comment les éléments du modèle sont-ils liés entre eux ?  

Après avoir compris la structure du modèle, il vous sera plus facile de saisir l'exemple suivant, basé sur un cas d'utilisation réel en PHP, Go, Js and Java.  

---

### **Exemple réel :**  

#### **Notification**  
Le modèle Adapter permet d'utiliser des classes tierces ou héritées, même si elles sont incompatibles avec la majorité de votre code.  
Par exemple, au lieu de réécrire l'interface de notification de votre application pour chaque service tiers (Slack, Facebook, SMS, etc.), vous pouvez créer un ensemble d'intermédiaires spéciaux qui adaptent les appels de votre application au format requis par chaque classe tierce.  

---

#### **PayPalPayment**  
Cet exemple illustre l'utilisation du modèle Adapter pour intégrer un service tiers de paiement PayPal avec une interface de paiement par carte de crédit existante.  

**Explication :**  
- **Interface cible (PaymentProcessor)** :  
  - Requiert une méthode `pay`, permettant au code client de traiter les paiements de manière cohérente.  
- **Classe existante (CreditCardPayment)** :  
  - Traite les paiements par carte de crédit en implémentant directement l'interface `PaymentProcessor`.  
- **Classe Adaptee (PayPalPayment)** :  
  - Représente un service tiers de paiement PayPal qui n'implémente pas `PaymentProcessor` et possède des méthodes différentes (`login` et `makePayment`).  
- **Classe Adapter (PayPalPaymentAdapter)** :  
  - Adapte `PayPalPayment` pour être compatible avec `PaymentProcessor` en implémentant la méthode `pay`, qui utilise `login` et `makePayment` en interne.  
- **Code client** :  
  - Peut gérer n'importe quelle implémentation de `PaymentProcessor`, ce qui signifie qu'il peut utiliser `CreditCardPayment` et `PayPalPaymentAdapter` sans problème.  

---

#### **Convertisseur de devises (CurrencyConverter)**  
Cet exemple montre comment le modèle Adapter permet d'intégrer un système tiers de conversion de devises (`CurrencyConverterAPI`) avec une interface de calcul standardisée pour les devises. Cela permet à l'application de convertir les prix entre diverses devises de manière transparente.  

**Explication :**  
- **Interface cible (CurrencyCalculator)** :  
  - Définit une méthode `convert` pour standardiser la conversion des devises.  
- **Classe existante (SimpleCurrencyConverter)** :  
  - Effectue la conversion des devises avec un taux fixe, tout en respectant déjà l'interface cible.  
- **Classe Adaptee (CurrencyConverterAPI)** :  
  - Une API tierce pour la conversion des devises avec une interface incompatible. Elle utilise `getConvertedAmount` avec des paramètres différents.  
- **Classe Adapter (CurrencyConverterAPIAdapter)** :  
  - Rend l'API compatible avec `CurrencyCalculator` en adaptant l'appel `convert` pour utiliser `getConvertedAmount`.  
- **Code client** :  
  - Peut convertir des devises sans connaître la source, qu'il s'agisse d'une conversion simple ou de l'utilisation de l'API tierce via l'adapter.  

---

Ces exemples illustrent comment le modèle Adapter permet d'intégrer des API ou des services tiers dans une interface standardisée, offrant ainsi au code client la possibilité d'interagir avec plusieurs fournisseurs sans modification.  