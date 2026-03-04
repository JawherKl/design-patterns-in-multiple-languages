<table>
  <tr>
      <td align="center">
        <a href="README.md">🇬🇧 Zu Englisch wechseln</a>
      </td>
      <td align="center">
        <a href="README_de.md">🇩🇪 Zu Deutsch wechseln</a>
      </td>
  </tr>
</table>

# Verhaltensmuster (Behavioral Design Patterns)

Dieser Ordner enthält gängige Beispiele für **Verhaltensmuster** (Behavioral Design Patterns), implementiert in PHP, Go, JavaScript und Java. Verhaltensmuster konzentrieren sich auf die Interaktion zwischen Objekten, stellen sicher, dass sie effektiv zusammenarbeiten, und beschreiben häufig, wie Verantwortlichkeiten zwischen ihnen verteilt werden.

## Inhaltsverzeichnis

1. [Chain of Responsibility (Kette der Verantwortung)](#chain-of-responsibility-kette-der-verantwortung)
2. [Command (Befehl)](#command-befehl)
3. [Iterator (Iterator)](#iterator-iterator)
4. [Mediator (Vermittler)](#mediator-vermittler)
5. [Observer (Beobachter)](#observer-beobachter)
6. [State (Zustand)](#state-zustand)
7. [Strategy (Strategie)](#strategy-strategie)
8. [Template Method (Schablonenmethode)](#template-method-schablonenmethode)
9. [Visitor (Besucher)](#visitor-besucher)

---

### Chain of Responsibility (Kette der Verantwortung)

Das **Chain-of-Responsibility-Muster** leitet Anfragen entlang einer Kette von Handlern weiter. Jeder Handler entscheidet, ob er die Anfrage verarbeitet oder an den nächsten Handler weitergibt.

#### Beispiel: Anfrage-Handler

```php
<?php  
use Behavioral\ChainOfResponsibility\RealWorldExamples\Logger;  
use Behavioral\ChainOfResponsibility\RealWorldExamples\ErrorHandler;  

$logger = new Logger(Logger::INFO);  
$errorHandler = new ErrorHandler();  
$logger->setNext($errorHandler);  

$logger->handle("Dies ist eine Informationsnachricht", Logger::INFO);  
$logger->handle("Dies ist eine Fehlermeldung", Logger::ERROR);  
```

In diesem Beispiel:

* `Logger` und `ErrorHandler` bilden eine Handler-Kette.
* Jeder Handler entscheidet, ob er die Nachricht verarbeitet oder weiterleitet.

#### Anwendungsfälle

* Logging-Frameworks, bei denen verschiedene Log-Level von unterschiedlichen Handlern verarbeitet werden.
* Validierungsketten zur Verarbeitung von Benutzereingaben.

---

### Command (Befehl)

Das **Command-Muster** kapselt eine Anfrage als Objekt. Dadurch können Clients mit unterschiedlichen Anfragen parametrisiert, in Warteschlangen gestellt oder für eine spätere Verarbeitung protokolliert werden.

#### Beispiel: Lichtschalter-Befehle

```php
<?php  
use Behavioral\Command\RealWorldExamples\Light;  
use Behavioral\Command\RealWorldExamples\LightOnCommand;  
use Behavioral\Command\RealWorldExamples\RemoteControl;  

$light = new Light();  
$command = new LightOnCommand($light);  
$remote = new RemoteControl();  

$remote->setCommand($command);  
$remote->pressButton();  
```

In diesem Beispiel:

* `LightOnCommand` kapselt die Anfrage, das Licht einzuschalten.
* `RemoteControl` fungiert als Aufrufer (Invoker), der den Befehl ausführt.

#### Anwendungsfälle

* Warteschlangen für Aufgaben in Task-Managern.
* Undo-/Redo-Mechanismen in Anwendungen.

---

### Iterator

Das **Iterator-Muster** bietet eine Möglichkeit, eine Sammlung von Elementen zu durchlaufen, ohne deren interne Darstellung offenzulegen.

#### Beispiel: Iteration über eine Liste

```php
<?php  
use Behavioral\Iterator\RealWorldExamples\BookCollection;  

$books = new BookCollection();  
$books->add("Book 1");  
$books->add("Book 2");  

foreach ($books as $book) {  
    echo $book . "\n";  
}  
```

In diesem Beispiel:

* `BookCollection` implementiert eine iterierbare Sammlungsstruktur.
* Die Iteration erfolgt, ohne interne Details preiszugeben.

#### Anwendungsfälle

* Durchlaufen komplexer Objekt-Sammlungen.
* Dynamische Generierung von Sequenzen.

---

### Mediator (Vermittler)

Das **Mediator-Muster** zentralisiert die Kommunikation zwischen Objekten, um direkte Abhängigkeiten zwischen ihnen zu reduzieren.

#### Beispiel: Benutzeroberfläche

```php
<?php  
use Behavioral\Mediator\RealWorldExamples\UIComponent;  

$ui = new UIComponent();  
$ui->buttonClicked();  
```

In diesem Beispiel:

* `UIComponent` fungiert als Vermittler zwischen Buttons und anderen UI-Komponenten.

#### Anwendungsfälle

* Komplexe Benutzeroberflächen.
* Koordination verteilter Workflows.

---

### Observer (Beobachter)

Das **Observer-Muster** definiert eine Eins-zu-viele-Abhängigkeit zwischen Objekten. Wenn sich der Zustand eines Objekts ändert, werden alle abhängigen Objekte benachrichtigt.

#### Beispiel: Newsletter-Abonnement

```php
<?php  
use Behavioral\Observer\RealWorldExamples\Newsletter;  
use Behavioral\Observer\RealWorldExamples\User;  

$newsletter = new Newsletter();  
$user1 = new User("Alice");  
$user2 = new User("Bob");  

$newsletter->subscribe($user1);  
$newsletter->subscribe($user2);  

$newsletter->notify("Neue Ausgabe veröffentlicht!");  
```

In diesem Beispiel:

* `Newsletter` informiert alle abonnierten Benutzer über eine neue Ausgabe.
* `User`-Objekte reagieren auf die Benachrichtigung und zeigen die Nachricht an.

#### Anwendungsfälle

* Event-Listener in UI-Frameworks.
* Echtzeitsysteme wie Aktienkurs-Updates.

---

### State (Zustand)

Das **State-Muster** ermöglicht es einem Objekt, sein Verhalten zu ändern, wenn sich sein interner Zustand ändert.

#### Beispiel: Ampelsystem

```php
<?php  
use Behavioral\State\RealWorldExamples\TrafficLight;  

$trafficLight = new TrafficLight();  
$trafficLight->changeState(); // Grün  
$trafficLight->changeState(); // Gelb  
$trafficLight->changeState(); // Rot  
```

In diesem Beispiel:

* `TrafficLight` ändert sein Verhalten dynamisch abhängig vom aktuellen Zustand.

#### Anwendungsfälle

* Endliche Zustandsautomaten in Spielen oder Workflow-Engines.
* UI-Komponenten, die ihr Verhalten abhängig vom Zustand ändern.

---

### Strategy (Strategie)

Das **Strategy-Muster** definiert eine Familie von Algorithmen, kapselt diese und macht sie zur Laufzeit austauschbar.

#### Beispiel: Zahlungsstrategie

```php
<?php  
use Behavioral\Strategy\RealWorldExamples\PaymentContext;  
use Behavioral\Strategy\RealWorldExamples\CreditCardPayment;  

$payment = new PaymentContext(new CreditCardPayment());  
$payment->pay(100);  
```

In diesem Beispiel:

* `CreditCardPayment` implementiert eine spezifische Zahlungsstrategie.
* `PaymentContext` ermöglicht den dynamischen Wechsel der Zahlungsmethode.

#### Anwendungsfälle

* Implementierung verschiedener Sortier- oder Suchalgorithmen.
* Zahlungsabwicklung mit mehreren Zahlungsmethoden.

---

### Template Method (Schablonenmethode)

Das **Template-Method-Muster** definiert das Grundgerüst eines Algorithmus in einer Methode, während bestimmte Schritte von Unterklassen überschrieben werden können.

#### Beispiel: Berichtsgenerierung

```php
<?php  
use Behavioral\TemplateMethod\RealWorldExamples\ReportGenerator;  

$report = new ReportGenerator();  
$report->generate();  
```

In diesem Beispiel:

* `ReportGenerator` stellt eine Methode zur Verfügung, um einen Bericht mit anpassbaren Schritten zu generieren.

#### Anwendungsfälle

* Dokumenten- oder Berichtsgenerierung.
* Standardisierte Verarbeitungspipelines.

---

### Visitor (Besucher)

Das **Visitor-Muster** ermöglicht das Hinzufügen neuer Funktionalitäten zu bestehenden Objekten, ohne deren Struktur zu verändern.

#### Beispiel: Steuerberechnung für verschiedene Vermögensarten

```php
<?php  
use Behavioral\Visitor\RealWorldExamples\TaxVisitor;  
use Behavioral\Visitor\RealWorldExamples\Property;  
use Behavioral\Visitor\RealWorldExamples\Car;  

$taxVisitor = new TaxVisitor();  

$property = new Property(500000);  
$car = new Car(30000);  

echo $property->accept($taxVisitor);  
echo $car->accept($taxVisitor);  
```

In diesem Beispiel:

* `TaxVisitor` berechnet die Steuer für verschiedene Vermögensarten (`Property`, `Car`).
* Die Klassen `Property` und `Car` bleiben unverändert.

---

## Verwendung

1. Klonen oder laden Sie dieses Repository herunter.
2. Navigieren Sie zum gewünschten Muster (z. B. `Observer`, `Strategy`, `Command`).
3. Führen Sie die Beispiele im Terminal aus mit:

```bash
php pfad/zu/ihrem/beispiel.php
```

---

## Lizenz

Dieses Projekt steht unter der MIT-Lizenz.
