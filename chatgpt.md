# ChatGPT Briefing

## Ziel
Ein Chatbot-Projekt soll mit Hilfe von ChatGPT erstellt werden, um auf Nutzeranfragen zu antworten. Der Bot soll als Webanwendung in PHP entwickelt werden.

## Ordnerstruktur
- core/
- classes/
    - file.class.php
    - request.class.php
    - response.class.php
    - supermodel.class.php
    - universe.class.php
    - utilities.class.php
- lib/
    - variables.php
- modes/
    - css.php
    - file.php
    - html.php
    - image.php
    - js.php
- plugins/
- .gitignore
- conventions.md
- execute.php
- install.php
- introduction.md
- readme.md

## Schichten
Das Projekt ist in vier Schichten aufgeteilt:

1. Controller
2. View
3. Supermodel
4. Template

## Controller
Der Controller empfängt die Nutzeranfragen und leitet sie an die passende Stelle weiter. Hier wird die Logik der Anwendung implementiert.

## View
Der View ist für die Darstellung der Nutzeroberfläche zuständig. Hier wird das Aussehen der Anwendung gestaltet.

## Supermodel
Das Supermodel enthält die Geschäftslogik der Anwendung. Hier findet die Datenverarbeitung statt.

## Template
Das Template ist für die Strukturierung des HTML-Codes zuständig.

## Setup
Das Setup des Projekts besteht aus:

1. Einrichten der Ordnerstruktur
2. Hinzufügen der Schichten
3. Implementierung der Geschäftslogik
4. Erstellen der Routen
5. Erstellen der Templates
6. Erstellen der Views
7. Erstellen der Controller
8. Erstellen des Eingabeformulars

## Weiterlesen
### Aufgabe: Lese die folgenden MD Dateien durch, um das Framework kennenzulernen:
https://github.com/HTML42/U42_UniversePHP/blob/master/conventions.md
