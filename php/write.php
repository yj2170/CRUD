<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$host = getenv('DB_HOST') ?: 'db';
$db = getenv('DB_NAME') ?: 'crud';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'yourpassword';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

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
    <h5><u><a href="index.php">home</a></u>
    <u><a href="write.php">write</a></u>
    <u><a href="list.php">list</a></u>
    <u><a href="logout.php">logout</a></u></h5>

    <h3><strong>Write</strong></h3>
    <form method="POST">
    Title <input type="text" name="title" required><br><br>
    Content <br>
    <textarea name="content" rows="10" cols="50" required></textarea><br><br>
    <button type="submit">submit</button>
</form>

</body>

</html>