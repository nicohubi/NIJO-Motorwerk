<?php
session_start();
require_once 'dbconnection.php';

// Wenn der Benutzer bereits eingeloggt ist, umleiten
if (isset($_SESSION['user'])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (!empty($username) && !empty($password)) {
        try {
            // Benutzer in der Datenbank suchen
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Login erfolgreich: Benutzer in Session speichern
                $_SESSION['user'] = $user['username'];
                header("Location: admin.php");
                exit();
            } else {
                $error = "Ungültiger Benutzername oder Passwort.";
            }
        } catch (PDOException $e) {
            $error = "Datenbankfehler: " . $e->getMessage();
        }
    } else {
        $error = "Bitte füllen Sie alle Felder aus.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffcc00; /* Gelb */
            color: #000; /* Schwarz */
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #000; /* Schwarz */
            border: none;
        }
        .btn-primary:hover {
            background-color: #333;
        }
        a {
            color: #000;
        }
        a:hover {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
        <h2 class="text-center">Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Benutzername:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Passwort:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="register.php">Noch nicht registriert? Hier registrieren</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
