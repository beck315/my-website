<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Admin Dashboard</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="admin_products.php">Administrer Produkter</a></li>
            <li class="list-group-item"><a href="admin_orders.php">Administrer Ordrer</a></li>
            <li class="list-group-item"><a href="admin_add_admin.php">Tilføj Administrator</a></li>
        </ul>
    </div>
</body>
</html>
