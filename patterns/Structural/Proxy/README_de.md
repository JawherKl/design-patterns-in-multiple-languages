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

**Proxy** ist ein Struktur-Entwurfsmuster, das ein Objekt bereitstellt, das als Stellvertreter für ein reales Service-Objekt fungiert.

Der Proxy empfängt Client-Anfragen, führt zusätzliche Aufgaben aus (z. B. Zugriffskontrolle oder Caching) und leitet die Anfrage anschließend weiter.

## Praxisbeispiele

### Downloader

Verbessert die Performance durch Zwischenspeicherung von Ergebnissen.

### Image

Simuliert einen Online-Bildlade-Service.

### Erklärung:

1. **Subject-Schnittstelle:**

   * `Image` mit `display()`.

2. **RealSubject:**

   * `RealImage` lädt und zeigt das Bild an.

3. **Proxy:**

   * `ProxyImage` kontrolliert den Zugriff.
   * Lädt das Bild nur einmal und speichert es im Cache.

4. **Client-Code:**

   * Arbeitet mit der `Image`-Schnittstelle.
   * Kann `RealImage` oder `ProxyImage` verwenden, ohne den Unterschied zu kennen.

Dieses Beispiel demonstriert das Proxy-Muster zur Optimierung ressourcenintensiver Operationen durch Caching und Zugriffskontrolle.
