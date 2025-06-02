<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $username = $_SESSION['username'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, username) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $username]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Write</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>

    <h3><strong>write</strong></h3>
    <form method="POST">
    Title <input type="text" name="title" required><br><br>
    Content <br>
    <textarea name="content" rows="10" cols="50" required></textarea><br><br>
    <button type="submit">submit</button>
    </form>
</body>

</html>