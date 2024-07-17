<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Produkt Detaljer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Produkt Detaljer</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Insekt Kunst</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Hjem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Produkter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container my-5">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<img class='card-img-top' src='" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row["name"] . "</h5>";
                echo "<p class='card-text'>" . $row["description"] . "</p>";
                echo "<p class='card-text'>Pris: " . $row["price"] . " DKK</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Produkt ikke fundet</p>";
        }
        $conn->close();
        ?>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        &copy; 2024 Insekt Kunst
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
