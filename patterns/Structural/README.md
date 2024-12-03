[🇫🇷 Switch to French](README_fr.md)

# Structural Design Patterns

This folder includes examples of common **Structural Design Patterns** implemented in PHP, Go, JavaScript, and Java. Structural patterns focus on how objects and classes are composed to form larger structures, ensuring flexibility and efficiency in their relationships.

## Table of Contents  
1. [Adapter Design Pattern](#adapter-design-pattern)  
2. [Bridge Design Pattern](#bridge-design-pattern)  
3. [Composite Design Pattern](#composite-design-pattern)  
4. [Decorator Design Pattern](#decorator-design-pattern)  
5. [Facade Design Pattern](#facade-design-pattern)  
6. [Flyweight Design Pattern](#flyweight-design-pattern)  
7. [Proxy Design Pattern](#proxy-design-pattern)

---

### Adapter Design Pattern  
The **Adapter Design Pattern** allows incompatible interfaces to work together by providing a wrapper that translates one interface into another.

#### Example: Media Player Adapter  
```php
<?php  
use Structural\Adapter\RealWorldExamples\AudioPlayer;

$player = new AudioPlayer();
$player->play("mp3", "song.mp3");  
$player->play("mp4", "video.mp4");  
$player->play("vlc", "movie.vlc");
```  
In this example:  
- `AudioPlayer` uses an adapter to handle different media formats.
- The adapter translates unsupported formats (`mp4`, `vlc`) to something the `AudioPlayer` can understand.

#### Use Cases  
- Integrating legacy code with modern systems.  
- Allowing third-party libraries to work with existing codebases.

---

### Bridge Design Pattern  
The **Bridge Design Pattern** decouples abstraction from its implementation so that the two can vary independently.

#### Example: Shapes and Colors Bridge  
```php
<?php  
use Structural\Bridge\RealWorldExamples\Circle;  
use Structural\Bridge\RealWorldExamples\RedColor;  

$circle = new Circle(new RedColor());
$circle->draw();
```  
In this example:  
- `Circle` and `RedColor` are separate abstractions, connected via a bridge.  
- You can change shapes or colors independently.

#### Use Cases  
- When you need to combine different variations of objects flexibly.  
- Useful in GUI toolkits with multiple look-and-feel themes.

---

### Flyweight Design Pattern  
The **Flyweight Design Pattern** reduces memory usage by sharing as much data as possible with similar objects.

#### Example: Forest Simulation  
```php
<?php  
use Structural\Flyweight\RealWorldExamples\Forest;

$forest = new Forest();
$forest->plantTree(10, 20, "Oak", "green", "oak-texture.png");
$forest->plantTree(30, 40, "Pine", "dark green", "pine-texture.png");
$forest->draw();
```  
In this example:  
- Trees share intrinsic data (type, color) while maintaining unique positions.  
- Flyweight minimizes memory use by avoiding duplicate data.

#### Use Cases  
- Rendering large datasets efficiently (e.g., trees in a forest, particles in a game).  
- When many similar objects need to be created.

---

### Proxy Design Pattern  
The **Proxy Design Pattern** provides a substitute for another object to control access, perform caching, or add functionality.

#### Example: Image Proxy  
```php
<?php  
use Structural\Proxy\RealWorldExamples\ProxyImage;

$image = new ProxyImage("large-photo.jpg");
$image->display(); // Loads and displays the image.
$image->display(); // Uses cached image for faster loading.
```  
In this example:  
- `ProxyImage` controls access to the `RealImage`, adding caching for efficiency.  
- Only loads the image once, reusing it on subsequent calls.

#### Use Cases  
- Controlling access to resource-intensive objects (e.g., remote objects).  
- Adding security or logging around real objects.

---

## How to Use  
1. Clone or download this repository.  
2. Navigate to the desired pattern (e.g., `Adapter`, `Proxy`, `Flyweight`).  
3. Run examples in the terminal by executing:  
   ```bash  
   php path/to/your/example.php  
   ```

---

## License  
This project is licensed under the MIT License.
