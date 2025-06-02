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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    $updateStmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $updateStmt->execute([$title, $content, $id]);

    header("Location: view.php?id=$id");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
</head>

<body>
    <h2>edit</h2>
    
    <form method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        <button type="submit">save</button>
    </form>
</body>

</html>