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

**Flyweight** ist ein Struktur-Entwurfsmuster, das es Programmen ermöglicht, eine große Anzahl von Objekten mit geringem Speicherverbrauch zu verwalten.

Es erreicht dies durch das Teilen gemeinsamer Zustandsdaten zwischen mehreren Objekten.

## Praxisbeispiele

### CatsFeatures

In einer Tierarztpraxis-Datenbank für Katzen wird RAM gespart, indem:

* **Extrinsische Daten** (Name, Alter, Besitzer) im `Cat`-Objekt gespeichert werden.
* **Intrinsische Daten** (Rasse, Farbe, Fellstruktur) in `CatVariation` gespeichert und von mehreren Katzen geteilt werden.

### ForestSimulation

Baumobjekte in einer Waldsimulation:

1. **TreeType (Flyweight)** → intrinsische Daten (`name`, `color`, `texture`)
2. **Tree (Kontext)** → extrinsische Daten (`x`, `y`)
3. **TreeFactory** → verwaltet geteilte Instanzen
4. **Forest** → Client
5. **Singleton TreeFactory** → stellt eine einzige Instanz sicher
