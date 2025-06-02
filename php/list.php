<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>List</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>

    <h3><strong>list</strong></h3>
    <a href="write.php">[write]</a><br><br>
</form>

</body>

</html>

<?php foreach ($posts as $post): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <a href="view.php?id=<?= $post['id'] ?>">
            <strong><?= htmlspecialchars($post['title']) ?></strong>
        </a><br>
        <small>writer : <?= htmlspecialchars($post['username']) ?> | <?= $post['created_at'] ?></small>
    </div>
<?php endforeach; ?>