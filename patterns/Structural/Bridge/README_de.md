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

**Bridge** ist ein Struktur-Entwurfsmuster, das es ermöglicht, eine große Klasse oder eine Gruppe eng miteinander verbundener Klassen in zwei getrennte Hierarchien aufzuteilen — Abstraktion und Implementierung — die unabhängig voneinander weiterentwickelt werden können.

Das Bridge-Muster ist besonders nützlich, wenn mehrere Typen von Datenbankservern unterstützt werden sollen oder wenn mit verschiedenen API-Anbietern einer bestimmten Art gearbeitet wird (zum Beispiel Cloud-Plattformen, soziale Netzwerke usw.).

# Konzeptionelles Beispiel:
Dieses Beispiel veranschaulicht die Struktur des Bridge-Entwurfsmusters und konzentriert sich auf folgende Fragen:
* Aus welchen Klassen besteht es?
* Welche Rollen spielen diese Klassen?
* Wie sind die Elemente des Musters miteinander verbunden?

Nachdem du die Struktur des Musters verstanden hast, wird es dir leichter fallen, das folgende Beispiel nachzuvollziehen, das auf einem realen Anwendungsfall in PHP, Go, JavaScript und Java basiert.

# Praxisbeispiel:

## DeviceController
Dieses Beispiel zeigt, wie das Bridge-Entwurfsmuster die Abstraktion `DeviceController` von der Implementierung `Device` entkoppelt, sodass sich beide unabhängig voneinander weiterentwickeln können.

## Page
In diesem Beispiel fungiert die `Page`-Hierarchie als Abstraktion, während die `Renderer`-Hierarchie die Implementierung darstellt. Objekte der Klasse `Page` können Webseiten eines bestimmten Typs zusammenstellen, indem sie grundlegende Elemente verwenden, die von einem der Seite zugeordneten `Renderer`-Objekt bereitgestellt werden.  
Da beide Klassenhierarchien voneinander getrennt sind, kann eine neue `Renderer`-Klasse hinzugefügt werden, ohne die `Page`-Klassen zu verändern – und umgekehrt.

## PaymentSystem
Dieses Beispiel zeigt, wie das Bridge-Entwurfsmuster die Abstraktion (Payment) von der Implementierung (PaymentGateway) trennt. Dadurch entsteht die Flexibilität, neue Zahlungsarten oder Gateways hinzuzufügen, ohne bestehenden Code zu beeinflussen.

### Erklärung:
* Abstraktion (Payment):  
  - Repräsentiert die Hauptoperationen des Zahlungssystems.  
  - Delegiert die Zahlungsabwicklung an die PaymentGateway-Implementierung.  
* Verfeinerte Abstraktionen (OnlinePayment, InStorePayment):  
  - Stellen spezifische Implementierungen für verschiedene Zahlungsarten bereit (online oder vor Ort).  
* Implementierung (PaymentGateway-Schnittstelle):  
  - Definiert die Schnittstelle für Zahlungs-Gateways wie PayPal oder Stripe.  
* Konkrete Implementierungen (PayPalGateway, StripeGateway):  
  - Konkrete Implementierungen für unterschiedliche Zahlungsanbieter.  
* Client-Code:  
  - Arbeitet ausschließlich mit der Abstraktion und ist unabhängig von der konkreten Implementierung.  

## CurrencyConverter
In diesem Szenario implementieren wir ein Zeichenwerkzeug, bei dem die Abstraktion verschiedene Formen (z. B. Kreise und Rechtecke) repräsentiert und die Implementierung unterschiedliche Rendering-Methoden (z. B. Vektor-Rendering und Raster-Rendering) übernimmt.
### Erklärung:
* Abstraktion (Shape):  
  - Repräsentiert das Konzept einer Form.  
  - Delegiert die Rendering-Logik an die Renderer-Implementierung.  
* Verfeinerte Abstraktionen (Circle, Rectangle):  
  - Erweitern die Abstraktion um spezifische Formen.  
* Implementierung (Renderer-Schnittstelle):  
  - Definiert die Schnittstelle für verschiedene Rendering-Mechanismen.  
* Konkrete Implementierungen (VectorRenderer, RasterRenderer):  
  - Implementieren die Rendering-Logik für Vektor- bzw. Rastergrafiken.  
* Client-Code:  
  - Kann mit jeder Kombination aus Formen und Renderern arbeiten.