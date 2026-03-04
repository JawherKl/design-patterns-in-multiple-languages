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

# Überblick über Entwurfsmuster (Design Patterns)

![design-patterns](https://github.com/JawherKl/design-patterns-in-multiple-languages/blob/main/docs/design-patterns.jpeg)

Dieses Repository bietet einen umfassenden Leitfaden zu **Entwurfsmustern (Design Patterns)** in der Softwareentwicklung. Entwurfsmuster sind bewährte Lösungen für häufig auftretende Probleme im Softwaredesign. Sie fördern die Wiederverwendbarkeit, Flexibilität und Wartbarkeit von Code. Im Folgenden betrachten wir die drei Hauptkategorien von Entwurfsmustern:

---

## Inhaltsverzeichnis

1. [Verhaltensmuster](#verhaltensmuster)
2. [Erzeugungsmuster](#erzeugungsmuster)
3. [Strukturmuster](#strukturmuster)

---

## Verhaltensmuster

**Verhaltensmuster** befassen sich mit Algorithmen und der Verteilung von Verantwortlichkeiten zwischen Objekten. Sie helfen dabei, die Kommunikation zwischen Objekten zu steuern und erleichtern die Wartung sowie die Skalierung von Softwaresystemen.

### Wichtige Verhaltensmuster:
- **Strategy**: Definiert eine Familie von Algorithmen und macht sie austauschbar.
- **Observer**: Ermöglicht es einem Objekt (dem Subjekt), andere Objekte (Beobachter) über Änderungen seines Zustands zu informieren.
- **Command**: Kapselt eine Anfrage als Objekt und entkoppelt dadurch Sender und Empfänger.

### Beispiel:
```php
// Beispiel für das Strategy-Muster
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

## Erzeugungsmuster

**Erzeugungsmuster** konzentrieren sich auf Mechanismen zur Objekterstellung. Sie stellen sicher, dass Objekte situationsgerecht instanziiert werden. Diese Muster bieten Flexibilität bei der Erstellung von Objekten und vermeiden eine enge Kopplung im Code.

### Wichtige Erzeugungsmuster:
* **Singleton**: Stellt sicher, dass eine Klasse nur eine Instanz besitzt, und bietet einen globalen Zugriffspunkt darauf.
* **Factory Method**: Definiert eine Schnittstelle zur Erstellung eines Objekts, erlaubt es jedoch Unterklassen, den Typ der erstellten Objekte zu bestimmen.
* **Abstract Factory**: Erzeugt Familien verwandter oder voneinander abhängiger Objekte, ohne deren konkrete Klassen anzugeben.

### Beispiel:
```php
// Beispiel für das Singleton-Muster
class DatabaseConnection {
    private static $instance;

    private function __construct() {
        // privater Konstruktor
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

## Strukturmuster

**Strukturmuster** befassen sich mit der Zusammensetzung von Klassen und Objekten. Sie stellen sicher, dass Klassen und Objekte innerhalb einer Anwendung flexibel und skalierbar zusammenarbeiten. Diese Muster helfen dabei, das Design und die Struktur von Software zu vereinfachen.

### Wichtige Strukturmuster:
* **Adapter**: Ermöglicht die Zusammenarbeit inkompatibler Schnittstellen.
* **Decorator**: Fügt einem Objekt zur Laufzeit zusätzliche Funktionalität hinzu.
* **Facade**: Bietet eine vereinfachte Schnittstelle zu einem komplexen Subsystem.

### Beispiel:
```php
// Beispiel für das Adapter-Muster
class WeatherAPI {
    public function getWeatherData() {
        return "Weather data from API";
    }
}

class WeatherAdapter {
    private $weatherAPI;

    public function __construct(WeatherAPI $weatherAPI) {
        $this->weatherAPI = $weatherAPI;
    }

    public function getTemperature() {
        $data = $this->weatherAPI->getWeatherData();
        return "Extrahierte Temperatur: " . $data;
    }
}
```

---

## Fazit

Entwurfsmuster sind essenzielle Werkzeuge in der Softwareentwicklung, um wiederkehrende Probleme im Design und in der Wartbarkeit zu lösen. Das Verständnis dieser Muster hilft dabei, skalierbaren, flexiblen und wiederverwendbaren Code zu schreiben.

### Mehr entdecken:
* Für **Verhaltensmuster** siehe spezifische Muster wie **Strategy** und **Observer**.
* Für **Erzeugungsmuster** erkunde **Singleton** und **Abstract Factory**.
* Für **Strukturmuster** vertiefe dich in **Adapter** und **Decorator**.
