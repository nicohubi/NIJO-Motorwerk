<?php
session_start();
require_once 'autorisieren.php';

// Prüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'dbConnection.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Guitar Wars - Highscore Verwaltung</title>
</head>
<body>
    <h1>Guitar Wars - Highscore Verwaltung</h1>

    <p>Willkommen, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>!</p>
    <p><a href="logout.php">Abmelden</a></p>

    <?php
    try {
        $sql = "SELECT * FROM autos ORDER BY marke DESC";
        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Punkte</th>
                    <th>Datum</th>
                    <th>Screenshot</th>
                    <th>Löschen</th>
                  </tr>";

            foreach ($stmt as $row) {
                echo "<tr>";
                echo "<td>" . $row['hsid'] . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . $row['punkte'] . "</td>";
                echo "<td>" . $row['datum'] . "</td>";

                if (!empty($row['screenshot']) && file_exists($row['screenshot'])) {
                    echo "<td><img src='" . $row['screenshot'] . "' width='100'></td>";
                } else {
                    echo "<td>Kein Bild</td>";
                }

                echo "<td><a href='hsloeschen.php?id=" . $row['hsid'] . "&screenshot=" . urlencode($row['screenshot']) . "'>Löschen</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Keine Einträge vorhanden.</p>";
        }
    } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
    ?>

    <br>
    <a href="index.php">Zurück zur Startseite</a>
</body>
</html>
