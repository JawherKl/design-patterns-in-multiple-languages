**Flyweight** est un patron de conception structurel qui permet aux programmes de supporter une grande quantité d'objets en gardant leur consommation mémoire faible.

Le patron y parvient en partageant des parties de l'état des objets entre plusieurs objets. En d'autres termes, le Flyweight économise de la RAM en mettant en cache les mêmes données utilisées par différents objets.

# Exemple conceptuel :
Cet exemple illustre la structure du patron de conception Bridge et se concentre sur les questions suivantes :
* De quelles classes est-il composé ?
* Quels rôles ces classes jouent-elles ?
* De quelle manière les éléments du patron sont-ils liés ?

Après avoir appris la structure du patron, il vous sera plus facile de comprendre l'exemple suivant, basé sur un cas d'utilisation réel en PHP, Go, JS et Java.

# Exemple du monde réel :
## CatsFeatures
Dans cet exemple, le patron Flyweight est utilisé pour minimiser l'utilisation de la RAM des objets dans une base de données animale d'une clinique vétérinaire exclusivement pour les chats. Chaque enregistrement dans la base de données est représenté par un objet `Cat`. Ses données sont composées de deux parties :

1. Des données uniques (extrinsèques) telles que le nom de l'animal, l'âge, et les informations sur le propriétaire.
2. Des données partagées (intrinsèques) telles que le nom de la race, la couleur, la texture, etc.

La première partie est stockée directement dans la classe `Cat`, qui agit comme un contexte. La deuxième partie, en revanche, est stockée séparément et peut être partagée par plusieurs chats. Ces données partagées se trouvent dans la classe `CatVariation`. Tous les chats ayant des caractéristiques similaires sont liés à la même classe `CatVariation`, au lieu de stocker les données en double dans chacun de leurs objets.

## ForestSimulation
Des objets `Tree` dans une simulation de forêt. Cet exemple met en évidence la façon dont les données intrinsèques (état partagé comme le type et la texture) sont séparées des données extrinsèques (données uniques comme la position).

### Explication :

1. **TreeType (Flyweight)** : Stocke les données intrinsèques comme `nom`, `couleur`, et `texture`.
2. **Tree (Contexte)** : Stocke les données extrinsèques telles que `x` et `y` (position).
3. **TreeFactory (Flyweight Factory)** : Gère les instances partagées de `TreeType` pour éviter les objets redondants.
4. **Forest** : Agit comme le client qui gère la collection d'arbres.
5. **Singleton TreeFactory** : Garantit qu'il n'existe qu'une seule instance de la fabrique.
