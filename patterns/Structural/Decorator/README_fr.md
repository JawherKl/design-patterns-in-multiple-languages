Le **Decorator** est un patron de conception structurel qui permet d’ajouter dynamiquement de nouveaux comportements à des objets en les enveloppant dans des objets spéciaux (wrappers) qui contiennent ces comportements.

Porter des vêtements est un exemple d’utilisation des **decorators**. Quand il fait froid, vous mettez un pull. Si vous avez encore froid, vous ajoutez une veste. S’il pleut, vous enfilez un imperméable. Tous ces vêtements "étendent" votre comportement de base sans faire partie intégrante de vous, et vous pouvez les enlever facilement lorsque vous n'en avez plus besoin.

# Exemple conceptuel :  
Cet exemple illustre la structure du patron de conception **Decorator** et se concentre sur les questions suivantes :  
- De quelles classes est-il composé ?  
- Quels rôles ces classes jouent-elles ?  
- De quelle manière les éléments du patron sont-ils liés ?  

Après avoir compris la structure du patron, il vous sera plus facile de saisir l'exemple suivant, basé sur un cas réel utilisant PHP, Go, JavaScript et Java.

# Exemple réel :  
## Filtrage de texte (**TextFiltering**)  
Dans cet exemple, le patron **Decorator** aide à construire des règles complexes de filtrage de texte pour nettoyer le contenu avant de l’afficher sur une page web. Différents types de contenu, comme les commentaires, les messages de forum ou les messages privés, nécessitent des ensembles de filtres différents.

## Transformation de message (**MessageTransformation**)  
Dans ce cas, nous allons décorer une classe de base **Message** pour ajouter diverses transformations de texte comme le chiffrement, l'inversion et la mise en majuscules.

### Explication :  
1. **Interface Composant (Message) :**  
   - Déclare la méthode `getText()` pour traiter le texte.

2. **Composant Concret (SimpleMessage) :**  
   - Implémente l’interface pour retourner le message original.

3. **Décorateur de base (MessageDecorator) :**  
   - Implémente la même interface et maintient une référence à un objet **Message**.

4. **Décorateurs Concrets :**  
   - `ReverseTextDecorator` : Inverse le texte.  
   - `UppercaseDecorator` : Convertit le texte en majuscules.  
   - `EncryptionDecorator` : Applique un chiffrement ROT13.

5. **Code client :**  
   - Démontre la composition dynamique des **decorators** pour modifier le message.
