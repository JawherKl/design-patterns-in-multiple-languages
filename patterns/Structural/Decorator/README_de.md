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

**Decorator** ist ein Struktur-Entwurfsmuster, das es ermöglicht, Objekten zur Laufzeit neue Verhaltensweisen hinzuzufügen, indem sie in spezielle Wrapper-Objekte eingebettet werden.

Ein anschauliches Beispiel ist das Tragen von Kleidung:
Wenn dir kalt ist, ziehst du einen Pullover an. Wenn das nicht reicht, ziehst du eine Jacke darüber. Wenn es regnet, kommt ein Mantel dazu. Diese Kleidungsstücke erweitern dein Verhalten, sind aber nicht dauerhaft Teil von dir – und können jederzeit entfernt werden.

## Konzeptionelles Beispiel

Dieses Beispiel erläutert die Struktur des Decorator-Musters anhand folgender Fragen:

* Aus welchen Klassen besteht es?
* Welche Rollen spielen sie?
* Wie sind sie miteinander verbunden?

## Praxisbeispiel

### TextFiltering

Das Decorator-Muster hilft hier dabei, komplexe Textfilter-Regeln zu kombinieren, um Inhalte vor der Darstellung auf einer Webseite zu bereinigen.
Unterschiedliche Inhalte wie Kommentare, Forenbeiträge oder private Nachrichten benötigen verschiedene Filterkombinationen.

### MessageTransformation

In diesem Beispiel wird eine einfache `Message`-Klasse dekoriert, um Texttransformationen wie Verschlüsselung, Umkehrung oder Großschreibung hinzuzufügen.

### Erklärung:

* **Komponenten-Schnittstelle (Message):**

  * Definiert die Methode `getText()`.

* **Konkrete Komponente (SimpleMessage):**

  * Gibt die ursprüngliche Nachricht zurück.

* **Basis-Dekorierer (MessageDecorator):**

  * Implementiert dieselbe Schnittstelle.
  * Enthält eine Referenz auf ein `Message`-Objekt.

* **Konkrete Dekorierer:**

  * `ReverseTextDecorator`: Kehrt den Text um.
  * `UppercaseDecorator`: Wandelt Text in Großbuchstaben um.
  * `EncryptionDecorator`: Wendet eine ROT13-Verschlüsselung an.

* **Client-Code:**

  * Demonstriert die dynamische Kombination mehrerer Dekorierer.
