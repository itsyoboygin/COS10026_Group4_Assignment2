<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

$status_message = "";
if (isset($_SESSION['update_status'])) {
    $status_message = $_SESSION['update_status'];
    unset($_SESSION['update_status']);
}

include "header.inc";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <meta name="description" content="Manager Portal">
</head>
<body>
    <main>
        <h1>Manager Portal</h1>
        <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
        <p>Your email address is: <?php echo htmlspecialchars($email); ?></p>

        <br>
        
        <button><a href="manage.php">EOIs Management</a></button>

        <br>
        
        <a href="logout.php">Logout</a>
    </main>
    <footer>
        <?php include "footer.inc"; ?>
    </footer>
</body>