<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIJO Motorwerk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 20px;
            font-size: 28px;
            position: relative;
        }
        .auth-links {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .auth-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .brand-section {
            width: 100%;
            margin-bottom: 20px;
        }
        .brand-section h2 {
            background-color: #333;
            color: white;
            padding: 10px;
            margin: 0;
            text-align: left;
            padding-left: 20px;
        }
        .car-card {
            background: white;
            padding: 15px;
            margin: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
        }
        .car-card img {
            width: 100%;
            border-radius: 10px;
        }
        .car-card h2 {
            font-size: 20px;
            margin: 10px 0;
        }
        .car-card p {
            font-size: 16px;
            color: #555;
        }
        .car-card .price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="header">
        NIJO Motorwerk
        <div class="auth-links">
            <a href="login.php">Login</a>
            <a href="register.php">Registrieren</a>
        </div>
    </div>
    <h2>Hier finden Sie Ihr Traumfahrzeug</h2>
    <div class="container">
        <?php
        $cars = [
            "BMW" => [
                ["name" => "M3", "image" => "bmw_m3.jpg", "description" => "Sportliches Fahrzeug mit 480 PS.", "price" => "€75,000"],
                ["name" => "X5", "image" => "bmw_x5.jpg", "description" => "Luxus-SUV mit viel Platz.", "price" => "€85,000"],
                ["name" => "i4", "image" => "bmw_i4.jpg", "description" => "Elektro-Sportlimousine.", "price" => "€60,000"]
            ],
            "Audi" => [
                ["name" => "A6", "image" => "audi_a6.jpg", "description" => "Luxus-Limousine mit Quattro-Antrieb.", "price" => "€50,000"],
                ["name" => "Q7", "image" => "audi_q7.jpg", "description" => "Großer Familien-SUV.", "price" => "€70,000"],
                ["name" => "e-tron", "image" => "audi_etron.jpg", "description" => "Elektro-SUV mit hoher Reichweite.", "price" => "€80,000"]
            ],
            "Mercedes" => [
                ["name" => "C-Klasse", "image" => "mercedes_c.jpg", "description" => "Elegante Limousine mit Power.", "price" => "€55,000"],
                ["name" => "E-Klasse", "image" => "mercedes_e.jpg", "description" => "Luxus und Komfort vereint.", "price" => "€65,000"],
                ["name" => "GLE", "image" => "mercedes_gle.jpg", "description" => "Großer SUV mit 367 PS.", "price" => "€80,000"]
            ],
            "Porsche" => [
                ["name" => "911", "image" => "porsche_911.jpg", "description" => "Legendärer Sportwagen mit über 500 PS.", "price" => "€120,000"],
                ["name" => "Cayenne", "image" => "porsche_cayenne.jpg", "description" => "Sport-SUV mit starkem Motor.", "price" => "€95,000"],
                ["name" => "Taycan", "image" => "porsche_taycan.jpg", "description" => "Vollelektrischer Supersportler.", "price" => "€150,000"]
            ]
        ];

        foreach ($cars as $brand => $models) {
            echo "<div class='brand-section'>";
            echo "<h2>" . $brand . "</h2>";
            echo "<div class='container'>";
            foreach ($models as $car) {
                echo "<div class='car-card'>";
                echo "<img src='images/" . $car['image'] . "' alt='" . $car['name'] . "'>";
                echo "<h2>" . $car['name'] . "</h2>";
                echo "<p>" . $car['description'] . "</p>";
                echo "<p class='price'>" . $car['price'] . "</p>";
                echo "</div>";
            }
            echo "</div></div>";
        }
        ?>
    </div>
</body>
</html>
