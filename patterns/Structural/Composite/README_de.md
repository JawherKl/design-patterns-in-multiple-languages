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

**Composite** (Kompositum) ist ein Struktur-Entwurfsmuster, das es ermöglicht, Objekte zu Baumstrukturen zusammenzusetzen und anschließend mit diesen Strukturen so zu arbeiten, als wären sie einzelne Objekte.

Composite ist eine sehr verbreitete Lösung für Probleme, bei denen Baumstrukturen aufgebaut werden müssen. Eine große Stärke dieses Musters ist die Möglichkeit, Methoden rekursiv über die gesamte Baumstruktur auszuführen und Ergebnisse zu aggregieren.

## Konzeptionelles Beispiel

Dieses Beispiel veranschaulicht die Struktur des Composite-Entwurfsmusters und konzentriert sich auf folgende Fragen:

* Aus welchen Klassen besteht es?
* Welche Rollen spielen diese Klassen?
* Wie sind die Elemente des Musters miteinander verbunden?

Nachdem du die Struktur verstanden hast, wird es einfacher sein, das folgende Praxisbeispiel in PHP, Go, JavaScript und Java nachzuvollziehen.

## Praxisbeispiel

### HTMLDOMTree

Der HTML-DOM-Baum ist ein typisches Beispiel für eine solche Struktur.
Während einfache Eingabeelemente als Blätter fungieren, übernehmen komplexe Elemente wie Formulare oder Fieldsets die Rolle von Kompositen.

### FileSystem

Dieses Beispiel demonstriert die Struktur und Funktionalität eines Dateisystems (Dateien und Ordner) mithilfe des Composite-Musters.

### Erklärung:

* **Basiskomponente (FilesystemItem):**

  * Definiert eine gemeinsame Schnittstelle für `File` und `Folder`.
  * Deklariert Methoden zur Größenberechnung und Darstellung.

* **Blattkomponente (File):**

  * Repräsentiert einzelne Dateien.
  * Implementiert die Logik zur Größenberechnung und Darstellung.

* **Kompositum (Folder):**

  * Repräsentiert Ordner, die andere `FilesystemItem`-Objekte enthalten können.
  * Implementiert das Hinzufügen, Entfernen und Berechnen der Gesamtgröße aller Kinder.
  * Kombiniert die Darstellungsausgaben der enthaltenen Elemente.

* **Client-Code:**

  * Erstellt eine hierarchische Struktur aus Dateien und Ordnern.
  * Arbeitet mit der Struktur über die abstrakte `FilesystemItem`-Schnittstelle.
