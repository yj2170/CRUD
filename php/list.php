<?php
$host = getenv('DB_HOST') ?: 'db';
$db = getenv('DB_NAME') ?: 'crud';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'yourpassword';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>List</title>
</head>

<body>
    <h5><u><a href="index.php">home</a></u>
    <u><a href="write.php">write</a></u>
    <u><a href="list.php">list</a></u>
    <u><a href="logout.php">logout</a></u></h5>

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