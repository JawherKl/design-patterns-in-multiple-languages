<table>
  <tr>
    <td align="center">
      <a href="README_fr.md">🇫🇷 Zur französischen Version wechseln</a>
    </td>
    <td align="center">
      <a href="README_de.md">🇩🇪 Zur deutschen Version wechseln</a>
    </td>
  </tr>
</table>

# Struktur-Entwurfsmuster

Dieser Ordner enthält Beispiele für gängige **Struktur-Entwurfsmuster (Structural Design Patterns)**, implementiert in PHP, Go, JavaScript und Java. Strukturmuster befassen sich damit, wie Objekte und Klassen zusammengesetzt werden, um größere Strukturen zu bilden und dabei Flexibilität sowie Effizienz in ihren Beziehungen sicherzustellen.

## Inhaltsverzeichnis  
1. [Adapter-Entwurfsmuster](#adapter-entwurfsmuster)  
2. [Bridge-Entwurfsmuster](#bridge-entwurfsmuster)  
3. [Composite-Entwurfsmuster](#composite-entwurfsmuster)  
4. [Decorator-Entwurfsmuster](#decorator-entwurfsmuster)  
5. [Facade-Entwurfsmuster](#facade-entwurfsmuster)  
6. [Flyweight-Entwurfsmuster](#flyweight-entwurfsmuster)  
7. [Proxy-Entwurfsmuster](#proxy-entwurfsmuster)

---

### Adapter-Entwurfsmuster  
Das **Adapter-Entwurfsmuster** ermöglicht die Zusammenarbeit inkompatibler Schnittstellen, indem es einen Wrapper bereitstellt, der eine Schnittstelle in eine andere übersetzt.

#### Beispiel: Media-Player-Adapter  
```php
<?php  
use Structural\Adapter\RealWorldExamples\AudioPlayer;

$player = new AudioPlayer();
$player->play("mp3", "song.mp3");  
$player->play("mp4", "video.mp4");  
$player->play("vlc", "movie.vlc");
```
In diesem Beispiel:
* `AudioPlayer` verwendet einen Adapter, um verschiedene Medienformate zu verarbeiten.
* Der Adapter übersetzt nicht unterstützte Formate (`mp4`, `vlc`) in ein Format, das der `AudioPlayer` verstehen kann.

#### Anwendungsfälle
* Integration von Legacy-Code in moderne Systeme.
* Einbindung von Drittanbieter-Bibliotheken in bestehende Codebasen.

---

### Bridge-Entwurfsmuster
Das **Bridge-Entwurfsmuster** entkoppelt eine Abstraktion von ihrer Implementierung, sodass sich beide unabhängig voneinander verändern lassen.

#### Beispiel: Formen und Farben (Bridge)
```php
<?php  
use Structural\Bridge\RealWorldExamples\Circle;  
use Structural\Bridge\RealWorldExamples\RedColor;  

$circle = new Circle(new RedColor());
$circle->draw();
```
In diesem Beispiel:
* `Circle` und `RedColor` sind getrennte Abstraktionen, die über eine Bridge verbunden sind.
* Formen oder Farben können unabhängig voneinander ausgetauscht werden.

#### Anwendungsfälle
* Wenn unterschiedliche Objektvarianten flexibel kombiniert werden sollen.
* Nützlich in GUI-Toolkits mit mehreren Look-and-Feel-Themes.

---

### Flyweight-Entwurfsmuster
Das **Flyweight-Entwurfsmuster** reduziert den Speicherverbrauch, indem möglichst viele Daten zwischen ähnlichen Objekten geteilt werden.

#### Beispiel: Waldsimulation
```php
<?php  
use Structural\Flyweight\RealWorldExamples\Forest;

$forest = new Forest();
$forest->plantTree(10, 20, "Oak", "green", "oak-texture.png");
$forest->plantTree(30, 40, "Pine", "dark green", "pine-texture.png");
$forest->draw();
```
In diesem Beispiel:
* Bäume teilen intrinsische Daten (Typ, Farbe), behalten jedoch ihre individuellen Positionen.
* Flyweight minimiert den Speicherverbrauch, indem doppelte Daten vermieden werden.

#### Anwendungsfälle
* Effizientes Rendering großer Datenmengen (z. B. Bäume in einem Wald, Partikel in einem Spiel).
* Wenn viele ähnliche Objekte erzeugt werden müssen.

---

### Proxy-Entwurfsmuster
Das **Proxy-Entwurfsmuster** stellt ein Stellvertreterobjekt für ein anderes Objekt bereit, um den Zugriff zu kontrollieren, Caching durchzuführen oder zusätzliche Funktionalität hinzuzufügen.

#### Beispiel: Image-Proxy
```php
<?php  
use Structural\Proxy\RealWorldExamples\ProxyImage;

$image = new ProxyImage("large-photo.jpg");
$image->display(); // Lädt und zeigt das Bild an.
$image->display(); // Verwendet das zwischengespeicherte Bild für schnelleres Laden.
```
In diesem Beispiel:
* `ProxyImage` kontrolliert den Zugriff auf `RealImage` und fügt Caching zur Effizienzsteigerung hinzu.
* Das Bild wird nur einmal geladen und bei weiteren Aufrufen wiederverwendet.

#### Anwendungsfälle
* Kontrolle des Zugriffs auf ressourcenintensive Objekte (z. B. Remote-Objekte).
* Hinzufügen von Sicherheits- oder Logging-Funktionalität um reale Objekte herum.

---

## Verwendung
1. Klone oder lade dieses Repository herunter.
2. Navigiere zum gewünschten Muster (z. B. `Adapter`, `Proxy`, `Flyweight`).
3. Führe die Beispiele im Terminal mit folgendem Befehl aus:
   ```bash
   php path/to/your/example.php  
   ```

---

## Lizenz
Dieses Projekt steht unter der MIT-Lizenz.
