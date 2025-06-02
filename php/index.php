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
    <?php require_once 'nav.php'; ?>

    <h3><strong>home</strong></h3>

    <h4>You are logged in as a user.</h4>

</body>

</html>