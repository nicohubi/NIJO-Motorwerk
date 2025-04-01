<?php
//Benutzername und Passwort für die Authentifizierung
$benutzername = 'auto';
$passwort = 'kauf';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
    $_SERVER['PHP_AUTH_USER'] != $benutzername || ($_SERVER['PHP_AUTH_PW'] != $passwort)){
    
    //Zugangsdaten falsch, Authentifizierungs-Header senden
    //Gibt der Benutzer eine falsche Benutzername-Passwort-Kombination ein,
    //wird einfach das Authenfizierungsfenster angezeigt.

    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm = "Autoportal"');

    //exit wird nur ausgeführt, wenn der Benutzer auf Abbrechen klickt

    exit('<h2> Autoportal</h2> Tut uns wirklich Leid, aber auf diese Seite können ' . 
        'Sie nur mit den richtigen Zugansdaten zugreifen');

    }
    //Wenn Benutzername u- Passwort korrekt eingegeben wurden,
    //dann wird die Admin-Seite angezeigt.
