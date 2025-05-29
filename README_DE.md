# Markdown_XH

Dieses Plugin ist ein Hilfsplugin für andere Plugins. Es stellt einen
[normgerechten Editor](https://wiki.cmsimple-xh.org/archiv/doku.php/plugin_interfaces#editors)
für Markdown, und einen Markdown zu HTML Wandler zur Verfügung.

- [Voraussetzungen](#voraussetzungen)
- [Download](#download)
- [Installation](#installation)
- [Einstellungen](#einstellungen)
- [Verwendung](#verwendung)
  - [Editor](#editor)
- [Einschränkungen](#einschränkungen)
- [Fehlerbehebung](#fehlerbehebung)
- [Lizenz](#lizenz)
- [Danksagung](#danksagung)

## Voraussetzungen

Markdown_XH ist ein Plugin für [CMSimple_XH](https://cmsimple-xh.org/de/).
Es benötigt CMSimple_XH ≥ 1.7.0 und PHP ≥ 7.4.0.
Markdown_XH benötigt weiterhin [Plib_XH](https://github.com/cmb69/plib_xh) ≥ 1.10;
ist dieses noch nicht installiert (siehe `Einstellungen` → `Info`),
laden Sie das [aktuelle Release](https://github.com/cmb69/plib_xh/releases/latest)
herunter, und installieren Sie es.

## Download

Das [aktuelle Release](https://github.com/cmb69/markdown_xh/releases/latest)
kann von Github herunter geladen werden.

## Installation

Die Installation erfolgt wie bei vielen anderen CMSimple_XH-Plugins auch.

1. Sichern Sie die Daten auf Ihrem Server.
1. Entpacken Sie die ZIP-Datei auf Ihrem Rechner.
1. Laden Sie das ganzen Ordner `markdown/` auf Ihren Server in das
   `plugins/` Verzeichnis von CMSimple_XH  hoch.
1. Machen Sie die Unterordner `config/`, `css/` und `languages/`
   beschreibbar.
1. Verschieben Sie die Datei `plugins/markdown/filebrowser/internal.php` nach
   `plugins/filebrowser/editorhooks/markdown/script.php`, so dass der interne
   Dateibrowser vom Editor verwendet werden kann.
1. Prüfen Sie unter `Plugins` → `Markdown` im Administrationsbereich,
   ob alle Voraussetzungen erfüllt sind.

## Einstellungen

Die Plugin-Konfiguration erfolgt wie bei vielen anderen
CMSimple_XH-Plugins auch im Administrationsbereich der Website.
Gehen Sie zu `Plugins` → `Markdown`.

Sie können die Voreinstellungen von Markdown_XH unter
`Konfiguration` ändern. Hinweise zu den Optionen werden beim
Überfahren der Hilfe-Icons mit der Maus angezeigt.

Die Lokalisierung wird unter `Sprache` vorgenommen. Sie können die
Sprachtexte in Ihre eigene Sprache übersetzen, falls keine
entsprechende Sprachdatei zur Verfügung steht, oder diese Ihren
Wünschen gemäß anpassen.

Das Aussehen von Markdown_XH kann unter `Stylesheet` angepasst werden.

## Verwendung

Um Markdown in HTML zu konvertieren, muss nur folgendes aufgerufen werden:

    \Markdown\Plugin::markdown()->toHtml($markdown)

Es sind keine weiteren Vorbereitungen nötig, da alle Komponenten automatisch
geladen werden.

### Editor

Damit Anwender das Markdown in einem einfachen Textfeld eingeben müssen, kann der
der gebündelte Markdown-Editor genutzt werden. Dies geschieht prinzipiell wie für
andere normgerechte Editoren, aber die Funktionen sollten direkt aufgerufen werden,
anstatt die allgemeinen Editor-Funktionen von CMSimple_XH zu verwenden.
Also sollten statt

    include_editor();
    editor_replace(…);
    init_editor(…);

die folgenden Aufrufe erfolgen:

    include_markdown();
    markdown_replace(…);
    init_markdown(…);

Es ist zu beachten, dass (noch) keine Konfiguration unterstützt wird, so dass
die entsprechenden Argumente ausgelassen werden können.

## Einschränkungen

Andere Dateibrowser als der interne Dateibrowser von CMSimple_XH werden nicht
unterstützt.

## Fehlerbehebung

Melden Sie Programmfehler und stellen Sie Supportanfragen entweder auf
[Github](https://github.com/cmb69/markdown_xh/issues) oder im
[CMSimple_XH Forum](https://cmsimpleforum.com/).

## Lizenz

Markdown_XH ist freie Software. Sie können es unter den Bedingungen der
GNU General Public License, wie von der Free Software Foundation
veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren Version.

Die Veröffentlichung von Markdown_XH erfolgt in der Hoffnung, dass es
Ihnen von Nutzen sein wird, aber ohne irgendeine Garantie, sogar ohne
die implizite Garantie der Marktreife oder der Verwendbarkeit für einen
bestimmten Zweck. Details finden Sie in der GNU General Public License.

Sie sollten ein Exemplar der GNU General Public License zusammen mit
Markdown_XH erhalten haben. Falls nicht, siehe <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

## Danksagung

Das Plugin wird angetrieben von [Parsedown](https://parsedown.org/) und
[TinyMDE](https://jefago.github.io/tiny-markdown-editor/).
Vielen Dank für die Bereitstellung dieser großartigen Tools unter der MIT Lizenz!

Das Plugin-Icon wurde von
[Markdown icons created by brajaomar_j - Flaticon](https://www.flaticon.com/free-icons/markdown)
gestaltet. Vielen Dank für die freie Verfügbarkeit dieses Icons.

Vielen Dank an die Community im
[CMSimple_XH-Forum](https://www.cmsimpleforum.com/) für Hinweise,
Anregungen und das Testen.

Und zu guter letzt vielen Dank an [Peter Harteg](https://www.harteg.dk/),
den „Vater“ von CMSimple, und allen Entwicklern von [CMSimple_XH](https://www.cmsimple-xh.org/de/)
ohne die es dieses phantastische CMS nicht gäbe.
