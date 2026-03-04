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

**Facade** ist ein Struktur-Entwurfsmuster, das eine vereinfachte (aber eingeschränkte) Schnittstelle zu einem komplexen System aus Klassen, Bibliotheken oder Frameworks bereitstellt.

Es reduziert die Gesamtkomplexität der Anwendung und bündelt Abhängigkeiten an einer zentralen Stelle.

## Praxisbeispiele

### SubSystem

Die Fassade verbirgt die Komplexität der YouTube-API und der FFmpeg-Bibliothek.
Der Client verwendet lediglich eine einfache Methode, anstatt mit zahlreichen Klassen zu arbeiten.

### MealOrder

Demonstriert die Vereinfachung komplexer Interaktionen durch eine einheitliche Schnittstelle.

#### Erklärung:

1. **Subsysteme:**

   * `Restaurant`: Essenszubereitung.
   * `DeliveryService`: Lieferung.
   * `PaymentProcessor`: Zahlungsabwicklung.

2. **Fassade:**

   * `MealOrderFacade` bietet die Methode `placeOrder`.

3. **Client-Code:**

   * Interagiert ausschließlich mit der Fassade.

### HomeAutomation

Steuert ein komplexes Smart-Home-System über eine einfache Schnittstelle.

Subsysteme:

* `SmartLights`
* `Thermostat`
* `SecuritySystem`

Fassade:

* `SmartHomeFacade` mit Methoden wie `startMorningRoutine()` und `startNightRoutine()`.
