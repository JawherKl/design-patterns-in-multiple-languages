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

**Adapter** ist ein Struktur-Entwurfsmuster, das es Objekten mit inkompatiblen Schnittstellen ermöglicht, zusammenzuarbeiten.

Der Adapter fungiert als Wrapper zwischen zwei Objekten. Er fängt Aufrufe für ein Objekt ab und transformiert sie in ein Format sowie in eine Schnittstelle, die vom zweiten Objekt verstanden wird.

# Konzeptionelles Beispiel:
Dieses Beispiel veranschaulicht die Struktur des Adapter-Entwurfsmusters und konzentriert sich auf folgende Fragen:
* Aus welchen Klassen besteht es?
* Welche Rollen spielen diese Klassen?
* Wie sind die Elemente des Musters miteinander verbunden?

Nachdem du die Struktur des Musters verstanden hast, wird es dir leichter fallen, das folgende Beispiel nachzuvollziehen, das auf einem realen Anwendungsfall in PHP, Go, JavaScript und Java basiert.

# Praxisbeispiel:
## Benachrichtigung
Das Adapter-Muster ermöglicht es, Drittanbieter- oder Legacy-Klassen zu verwenden, selbst wenn sie nicht mit dem restlichen Code kompatibel sind. Anstatt beispielsweise die Benachrichtigungsschnittstelle deiner Anwendung neu zu schreiben, um jeden Drittanbieterdienst wie Slack, Facebook, SMS oder andere zu unterstützen, kannst du eine Reihe spezieller Wrapper erstellen. Diese passen die Aufrufe deiner Anwendung an die von jeder Drittanbieter-Klasse benötigte Schnittstelle und das erforderliche Format an.

## PayPalPayment
Ein Beispiel für das Adapter-Entwurfsmuster, bei dem ein Drittanbieter-Zahlungsdienst (PayPal) in eine bestehende Kreditkartenzahlungsschnittstelle integriert wird. Dieses Beispiel zeigt, wie das Adapter-Muster dabei hilft, inkompatible Schnittstellen im Zahlungsprozess einheitlich zu integrieren.

### Erklärung:
* Ziel-Schnittstelle (PaymentProcessor): Diese Schnittstelle definiert eine `pay`-Methode, damit der Client-Code Zahlungen einheitlich verarbeiten kann.
* Bestehende Klasse (CreditCardPayment): Eine Klasse, die Kreditkartenzahlungen verarbeitet und die PaymentProcessor-Schnittstelle direkt implementiert.
* Adaptee-Klasse (PayPalPayment): Repräsentiert einen Drittanbieter-PayPal-Zahlungsdienst, der PaymentProcessor nicht implementiert und andere Methoden (`login` und `makePayment`) besitzt.
* Adapter-Klasse (PayPalPaymentAdapter): Passt PayPalPayment an die PaymentProcessor-Schnittstelle an, indem sie die `pay`-Methode implementiert, welche intern `login` und `makePayment` verwendet.
* Client-Code: Kann jede Implementierung von PaymentProcessor verwenden und somit sowohl CreditCardPayment als auch PayPalPaymentAdapter nahtlos einsetzen.

## CurrencyConverter
Ein weiteres Beispiel für das Adapter-Entwurfsmuster, das die Integration eines Drittanbieter-Währungsumrechnungssystems (CurrencyConverterAPI) mit einer standardisierten Währungsberechnungsschnittstelle demonstriert. Dieser Ansatz ermöglicht es der Anwendung, Preise problemlos zwischen verschiedenen Währungen zu konvertieren.
### Erklärung:
* Ziel-Schnittstelle (CurrencyCalculator): Definiert eine `convert`-Methode zur Standardisierung der Währungsumrechnung.
* Bestehende Klasse (SimpleCurrencyConverter): Führt eine Währungsumrechnung mit einem festen Wechselkurs durch und entspricht bereits der Schnittstelle.
* Adaptee (CurrencyConverterAPI): Eine Drittanbieter-API für Währungsumrechnung mit einer inkompatiblen Schnittstelle. Sie verwendet die Methode `getConvertedAmount` mit anderen Parametern.
* Adapter (CurrencyConverterAPIAdapter): Macht die API mit CurrencyCalculator kompatibel, indem der `convert`-Aufruf an `getConvertedAmount` angepasst wird.
* Client-Code: Kann Währungen umrechnen, ohne die Quelle zu kennen – entweder über die einfache Umrechnung oder über die Drittanbieter-API mittels Adapter.

Diese Beispiele zeigen, wie das Adapter-Muster die Integration externer Systeme in eine standardisierte Schnittstelle ermöglicht, sodass der Client-Code mit mehreren Anbietern arbeiten kann, ohne angepasst werden zu müssen.