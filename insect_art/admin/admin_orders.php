<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

if (isset($_POST['update_order'])) {
    $id = $_POST['order_id'];
    $status = $_POST['status'];
    $sql = "UPDATE orders SET status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Ordre opdateret succesfuldt</div>";
    } else {
        echo "<div class='alert alert-danger'>Fejl: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Administrer Ordrer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Administrer Ordrer</h2>
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Tilbage til Dashboard</a>
        <h3>Ordrer</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produkt ID</th>
                    <th>Antal</th>
                    <th>Status</th>
                    <th>Handling</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["product_id"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>";
                        echo "<form action='admin_orders.php' method='post' style='display:inline-block;'>";
                        echo "<input type='hidden' name='order_id' value='" . $row["id"] . "'>";
                        echo "<select name='status' class='form-control' style='display:inline-block; width:auto;'>";
                        echo "<option value='Pending'" . ($row["status"] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                        echo "<option value='Completed'" . ($row["status"] == 'Completed' ? ' selected' : '') . ">Completed</option>";
                        echo "<option value='Cancelled'" . ($row["status"] == 'Cancelled' ? ' selected' : '') . ">Cancelled</option>";
                        echo "</select>";
                        echo "<button type='submit' name='update_order' class='btn btn-primary'>Opdater</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Ingen ordrer fundet</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
