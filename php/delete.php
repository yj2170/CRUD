<?php
session_start();
require_once 'db.php';

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