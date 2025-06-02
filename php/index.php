<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <h5><u><a href="index.php">home</a></u>
    <u><a href="write.php">write</a></u>
    <u><a href="list.php">list</a></u>
    <u><a href="logout.php">logout</a></u></h5>

    <h3><strong>home</strong></h3>

    <h4>You are logged in as user.</h4>

</body>

</html>