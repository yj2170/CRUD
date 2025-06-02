<?php
session_start();
$host = getenv('DB_HOST') ?: 'db';
$db = getenv('DB_NAME') ?: 'crud';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'yourpassword';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid post ID");

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) die("Post not found");

if (!isset($_SESSION['username']) || $_SESSION['username'] !== $post['username']) {
    die("You don't have permission.");
}

$deleteStmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$deleteStmt->execute([$id]);

header("Location: list.php");
exit;
?>