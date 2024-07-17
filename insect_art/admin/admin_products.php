<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = "../images/" . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Produkt tilføjet succesfuldt</div>";
        } else {
            echo "<div class='alert alert-danger'>Fejl: " . $sql . "<br>" . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Fejl ved upload af billede</div>";
    }
}

if (isset($_POST['delete_product'])) {
    $id = $_POST['product_id'];
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Produkt slettet succesfuldt</div>";
    } else {
        echo "<div class='alert alert-danger'>Fejl: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Administrer Produkter</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Administrer Produkter</h2>
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Tilbage til Dashboard</a>
        <h3>Tilføj Produkt</h3>
        <form action="admin_products.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Navn:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Beskrivelse:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Pris:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Billede:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">Tilføj Produkt</button>
        </form>

        <h3>Produkter</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Navn</th>
                    <th>Beskrivelse</th>
                    <th>Pris</th>
                    <th>Billede</th>
                    <th>Handling</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td><img src='../" . $row["image"] . "' alt='" . $row["name"] . "' style='max-width: 100px;'></td>";
                        echo "<td>";
                        echo "<form action='admin_products.php' method='post' style='display:inline-block;'>";
                        echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' name='delete_product' class='btn btn-danger'>Slet</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Ingen produkter fundet</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
