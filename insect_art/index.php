<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Insekt Kunst</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Velkommen til Insekt Kunst</h1>
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
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php
            include 'db.php';
            $sql = "SELECT * FROM products LIMIT 3";
            $result = $conn->query($sql);
            $active = true;

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='carousel-item " . ($active ? 'active' : '') . "'>";
                    echo "<img class='d-block w-100 carousel-image' src='" . $row["image"] . "' alt='" . $row["name"] . "'>";
                    echo "<div class='carousel-caption d-none d-md-block'>";
                    echo "<h5>" . $row["name"] . "</h5>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    $active = false;
                }
            }
            $conn->close();
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container text-center my-5">
        <h2>Unikke kunstværker af insekter</h2>
        <p>Oplev vores unikke samling af kunstværker lavet af ægte insekter og andre døde dyr. Perfekt til at dekorere dit hjem eller give som en speciel gave.</p>
        <a href="products.php" class="btn btn-primary">Se vores produkter</a>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        &copy; 2024 Insekt Kunst
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
