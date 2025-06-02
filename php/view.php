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
if (!$id) {
    die("Invalid post ID");
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found");
}
?>

<!DOCTYPE html>
<html>
<head><title>View Post</title></head>
<body>
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <small>writer : <?= htmlspecialchars($post['username']) ?> | <?= $post['created_at'] ?></small><br><br>

    <a href="list.php">Back to list</a><br><br>

    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $post['username']): ?>
        <a href="edit.php?id=<?= $post['id'] ?>">[edit]</a>
        <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?')">[delete]</a>
    <?php endif; ?>

</body>
</html>