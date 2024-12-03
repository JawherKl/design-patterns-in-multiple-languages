[🇬🇧 Switch to English](README.md)

# Modèles de Conception Structurels

Ce dossier comprend des exemples courants de **Modèles de Conception Structurels** implémentés en PHP, Go, JavaScript et Java. Les modèles structurels se concentrent sur la manière dont les objets et les classes sont composés pour former des structures plus larges, garantissant flexibilité et efficacité dans leurs relations.

## Table des Matières  
1. [Modèle de Conception Adaptateur](#Adapter)  
2. [Modèle de Conception Pont](#Bridge)  
3. [Modèle de Conception Composite](#Composite)  
4. [Modèle de Conception Décorateur](#Decorator)  
5. [Modèle de Conception Façade](#Facade)  
6. [Modèle de Conception Poids-Mouche](#Flyweight)  
7. [Modèle de Conception Proxy](#Proxy)

---

### Modèle de Conception Adaptateur  
Le **Modèle de Conception Adaptateur** permet à des interfaces incompatibles de fonctionner ensemble en fournissant un adaptateur qui traduit une interface en une autre.

#### Exemple : Adaptateur de Lecteur Multimédia  
```php  
<?php  
use Structural\Adapter\RealWorldExamples\AudioPlayer;

$player = new AudioPlayer();
$player->play("mp3", "chanson.mp3");  
$player->play("mp4", "video.mp4");  
$player->play("vlc", "film.vlc");
```  
Dans cet exemple :  
- `AudioPlayer` utilise un adaptateur pour gérer différents formats multimédia.  
- L’adaptateur traduit les formats non pris en charge (`mp4`, `vlc`) pour les rendre compatibles avec `AudioPlayer`.

#### Cas d'utilisation  
- Intégrer du code hérité avec des systèmes modernes.  
- Permettre à des bibliothèques tierces de fonctionner avec des bases de code existantes.

---

### Modèle de Conception Pont  
Le **Modèle de Conception Pont** découple l'abstraction de son implémentation afin que les deux puissent évoluer indépendamment.

#### Exemple : Pont entre Formes et Couleurs  
```php  
<?php  
use Structural\Bridge\RealWorldExamples\Circle;  
use Structural\Bridge\RealWorldExamples\RedColor;  

$circle = new Circle(new RedColor());
$circle->draw();
```  
Dans cet exemple :  
- `Circle` et `RedColor` sont des abstractions séparées, reliées par un pont.  
- Vous pouvez changer les formes ou les couleurs de manière indépendante.

#### Cas d'utilisation  
- Lorsque vous devez combiner différentes variantes d’objets de manière flexible.  
- Utile dans les bibliothèques GUI avec plusieurs thèmes d'apparence.

---

### Modèle de Conception Poids-Mouche  
Le **Modèle de Conception Poids-Mouche** réduit l'utilisation de la mémoire en partageant autant de données que possible entre des objets similaires.

#### Exemple : Simulation de Forêt  
```php  
<?php  
use Structural\Flyweight\RealWorldExamples\Forest;

$forest = new Forest();
$forest->plantTree(10, 20, "Chêne", "vert", "texture-chene.png");
$forest->plantTree(30, 40, "Pin", "vert foncé", "texture-pin.png");
$forest->draw();
```  
Dans cet exemple :  
- Les arbres partagent des données intrinsèques (type, couleur) tout en conservant des positions uniques.  
- Le Poids-Mouche minimise l'utilisation de la mémoire en évitant les données dupliquées.

#### Cas d'utilisation  
- Rendu efficace de grandes quantités de données (par exemple, des arbres dans une forêt).  
- Lorsque de nombreux objets similaires doivent être créés.

---

### Modèle de Conception Proxy  
Le **Modèle de Conception Proxy** fournit un substitut pour un autre objet afin de contrôler l'accès, effectuer une mise en cache ou ajouter des fonctionnalités.

#### Exemple : Proxy d'Image  
```php  
<?php  
use Structural\Proxy\RealWorldExamples\ProxyImage;

$image = new ProxyImage("grande-photo.jpg");
$image->display(); // Charge et affiche l'image.
$image->display(); // Utilise l'image en cache pour un chargement plus rapide.
```  
Dans cet exemple :  
- `ProxyImage` contrôle l'accès à `RealImage`, ajoutant une mise en cache pour plus d'efficacité.  
- L'image est chargée une fois, puis réutilisée pour les appels suivants.

#### Cas d'utilisation  
- Contrôler l'accès aux objets nécessitant beaucoup de ressources (par exemple, objets distants).  
- Ajouter de la sécurité ou de la journalisation autour des objets réels.

---

## Comment Utiliser  
1. Clonez ou téléchargez ce dépôt.  
2. Accédez au modèle souhaité (par exemple, `Adapter`, `Proxy`, `Flyweight`).  
3. Exécutez les exemples dans le terminal avec la commande :  
   ```bash  
   php chemin/vers/votre/exemple.php  
   ```

---

## Licence  
Ce projet est sous licence MIT.
