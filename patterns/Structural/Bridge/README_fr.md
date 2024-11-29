<!--**Bridge - Modèle de conception structurel**-->
Le Bridge est un modèle de conception structurel qui permet de diviser une grande classe ou un ensemble de classes étroitement liées en deux hiérarchies distinctes : abstraction et implémentation. Ces deux parties peuvent être développées indépendamment l'une de l'autre.  

Ce modèle est particulièrement utile lorsque vous devez gérer plusieurs types de serveurs de bases de données ou travailler avec plusieurs fournisseurs d'API d'un même type (par exemple, des plateformes cloud, des réseaux sociaux, etc.).  

---

### **Exemple conceptuel :**  
Cet exemple illustre la structure du modèle de conception Bridge et répond aux questions suivantes :  
- De quelles classes est-il composé ?  
- Quels rôles ces classes jouent-elles ?  
- Comment les éléments du modèle sont-ils liés entre eux ?  

Après avoir compris la structure du modèle, il vous sera plus facile de saisir l'exemple suivant, basé sur un cas d'utilisation réel en PHP.  

---

### **Exemple réel :**  

#### **DeviceController**  
Cet exemple montre comment le modèle Bridge découple l'abstraction `DeviceController` de l'implémentation `Device`, permettant à chacun d'évoluer indépendamment.  

---

#### **Page**  
Dans cet exemple, la hiérarchie `Page` agit comme une abstraction, tandis que la hiérarchie `Renderer` agit comme une implémentation. Les objets de la classe `Page` peuvent assembler des pages web spécifiques en utilisant les éléments de base fournis par un objet `Renderer` attaché à cette page.  

Comme les deux hiérarchies de classes sont séparées, vous pouvez ajouter une nouvelle classe `Renderer` sans modifier aucune des classes `Page`, et vice versa.  

---

#### **Système de paiement (PaymentSystem)**  
Cet exemple illustre comment le modèle Bridge permet de séparer l'abstraction (Payment) de l'implémentation (PaymentGateway), offrant ainsi la flexibilité d'ajouter de nouveaux types de paiements ou passerelles sans affecter le code existant.  

**Explication :**  
- **Abstraction (Payment)** :  
  - Représente les principales opérations du système de paiement.  
  - Délègue le traitement des paiements à l'implémentation `PaymentGateway`.  
- **Abstractions raffinées (OnlinePayment, InStorePayment)** :  
  - Fournissent des implémentations spécifiques pour les types de paiements (en ligne ou en magasin).  
- **Implémentation (Interface PaymentGateway)** :  
  - Représente l'interface pour les passerelles de paiement comme PayPal ou Stripe.  
- **Implémentations concrètes (PayPalGateway, StripeGateway)** :  
  - Implémentations spécifiques pour différentes passerelles de paiement.  
- **Code client** :  
  - Ne travaille qu'avec l'abstraction, sans se préoccuper de l'implémentation spécifique.  

---

#### **Convertisseur de devise (CurrencyConverter)**  
Dans cet exemple, nous mettrons en œuvre un outil de dessin où l'abstraction représente différentes formes (comme des cercles et des rectangles), et l'implémentation se concentre sur différentes méthodes de rendu (comme le rendu vectoriel et le rendu raster).  

**Explication :**  
- **Abstraction (Shape)** :  
  - Représente le concept d'une forme.  
  - Délègue la logique de rendu à l'implémentation `Renderer`.  
- **Abstractions raffinées (Circle, Rectangle)** :  
  - Étendent l'abstraction pour inclure des formes spécifiques.  
- **Implémentation (Interface Renderer)** :  
  - Représente l'interface pour les différentes méthodes de rendu.  
- **Implémentations concrètes (VectorRenderer, RasterRenderer)** :  
  - Implémentent la logique de rendu pour les graphiques vectoriels et raster, respectivement.  
- **Code client** :  
  - Fonctionne avec n'importe quelle combinaison de formes et de moteurs de rendu.  