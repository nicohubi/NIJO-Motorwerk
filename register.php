
<?php
session_start();
require_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = (htmlspecialchars($_POST['username'])) ?? '';
    $password = (htmlspecialchars($_POST['password'])) ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Bitte füllen Sie alle Felder aus.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwörter stimmen nicht überein.";
    } else {
        // Passwort hashen
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Benutzer hinzufügen
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $hashed_password]);
            $_SESSION['success'] = "Registrierung erfolgreich! Sie können sich jetzt anmelden.";
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $error = "Benutzername existiert bereits.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
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
        <h2 class="text-center">Registrieren</h2>
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
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Passwort bestätigen:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrieren</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Bereits registriert? Hier einloggen</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>