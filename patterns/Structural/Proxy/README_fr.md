**Proxy** est un patron de conception structurel qui fournit un objet servant de substitut à un véritable objet de service utilisé par un client. Un proxy reçoit les requêtes du client, effectue certaines actions (contrôle d'accès, mise en cache, etc.) puis transmet la requête à un objet de service.

L'objet proxy possède la même interface qu'un service, ce qui le rend interchangeable avec un véritable objet lorsqu'il est transmis à un client.

# Exemple conceptuel :
Cet exemple illustre la structure du patron de conception **Bridge** et se concentre sur les questions suivantes :
* De quelles classes est-il composé ?
* Quels rôles ces classes jouent-elles ?
* De quelle manière les éléments du patron sont-ils liés ?

Après avoir appris la structure du patron, il vous sera plus facile de comprendre l'exemple suivant, basé sur un cas d'utilisation réel en PHP, Go, JS et Java.

# Exemple du monde réel :
## Downloader
Cet exemple montre comment le patron Proxy peut améliorer les performances d'un objet de téléchargement en mettant en cache ses résultats.

## Image
L'interface **Subject** définit l'interface commune à la fois pour le **RealSubject** et le **Proxy**. Dans cet exemple, nous simulons un service de chargement d'images en ligne.

### Explication :
1. **Interface Subject :**
   - `Image` : Définit la méthode `display()` que les classes `RealImage` et `ProxyImage` implémentent toutes deux.

2. **RealSubject :**
   - `RealImage` : Représente l'image réelle qui effectue le travail de chargement et d'affichage de l'image.

3. **Proxy :**
   - `ProxyImage` : Contrôle l'accès à `RealImage`. Il retarde le processus de chargement en mettant en cache l'image après le premier chargement. Il vérifie si l'image est déjà chargée et, dans ce cas, l'affiche simplement.

4. **Code Client :**
   - Le client interagit avec l'interface `Image`, ce qui signifie qu'il peut utiliser soit `RealImage`, soit `ProxyImage` sans connaître la différence. Dans le cas de `ProxyImage`, il économise des ressources en mettant en cache le résultat et en le réutilisant.

Cet exemple montre comment le patron **Proxy** peut optimiser le chargement des ressources et la mise en cache. Le **Proxy** fournit un moyen simplifié et efficace de gérer les opérations lourdes en ressources.
