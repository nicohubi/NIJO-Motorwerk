<?php
session_start();
session_destroy();
echo "Erfolgreich ausgeloggt! <a href='login.php'>Zurück zum Login</a>";
?>