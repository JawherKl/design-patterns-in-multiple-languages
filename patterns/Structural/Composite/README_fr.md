Le **Composite** est un patron de conception structurel qui permet de composer des objets en structures arborescentes et de travailler avec ces structures comme s’il s’agissait d’objets individuels.

Le **Composite** est devenu une solution populaire pour les problèmes nécessitant la construction d'une structure en arbre. Sa principale caractéristique est la capacité d’exécuter des méthodes de manière récursive sur l’ensemble de la structure et de cumuler les résultats.

# Exemple conceptuel :  
Cet exemple illustre la structure du patron de conception **Composite** et se concentre sur les questions suivantes :  
- De quelles classes est-il composé ?  
- Quels rôles ces classes jouent-elles ?  
- De quelle manière les éléments du patron sont-ils liés ?  

Après avoir compris la structure du patron, il vous sera plus facile de saisir l'exemple suivant, basé sur un cas réel utilisant PHP, Go, JavaScript et Java.

# Exemple réel :  
## Arbre DOM HTML (**HTMLDOMTree**)  
L’arbre DOM HTML est un exemple typique de ce type de structure. Par exemple, les différents éléments d'entrée peuvent agir comme des feuilles, tandis que les éléments complexes comme les formulaires et les fieldsets jouent le rôle de composites.

## Système de fichiers (**FileSystem**)  
Cet exemple démontre la structure et la fonctionnalité d’un système de fichiers (fichiers et dossiers) en utilisant le patron **Composite**.

### Explication :  
1. **Composant de base (FilesystemItem) :**  
   - Fournit une interface commune pour les objets `File` et `Folder`.  
   - Déclare des méthodes pour obtenir la taille et effectuer le rendu.

2. **Composant Feuille (File) :**  
   - Représente des fichiers individuels.  
   - Implémente la logique de calcul de taille et de rendu pour les fichiers.

3. **Composant Composite (Folder) :**  
   - Représente les dossiers pouvant contenir d’autres objets **FilesystemItem**.  
   - Implémente la logique d’ajout, de suppression et de calcul de taille pour tous les éléments enfants.  
   - Combine les sorties de rendu de ses enfants.

4. **Code client :**  
   - Construit une structure hiérarchique de fichiers et de dossiers.  
   - Travaille avec la structure en utilisant l’interface abstraite **FilesystemItem**.
