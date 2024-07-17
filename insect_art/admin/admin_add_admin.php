<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

if (isset($_POST['add_admin'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Administrator tilføjet succesfuldt</div>";
    } else {
        echo "<div class='alert alert-danger'>Fejl: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Tilføj Administrator</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Tilføj Administrator</h2>
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Tilbage til Dashboard</a>
        <form action="admin_add_admin.php" method="post">
            <div class="form-group">
                <label for="username">Brugernavn:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Kodeord:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="add_admin" class="btn btn-primary">Tilføj Administrator</button>
        </form>
    </div>
</body>
</html>
