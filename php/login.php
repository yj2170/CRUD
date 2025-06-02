<?php
session_start();
$message = "";

$host = getenv('DB_HOST') ?: 'db';
$db = getenv('DB_NAME') ?: 'crud';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'yourpassword';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("DB connect failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $message = "You've got wrong username or password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h5><u><a href="login.php">home</a></u>
    <u><a href="register.php">register</a></u>
    <u><a href="login.php">login</a></u></h5>

    <h3><strong>login</strong></h3>

    <form action="login.php" method="POST">
        username <input type="text" name="username" required><br><br>
        password <input type="password" name="password" required><br><br>
        <button type="submit">login</button>
    </form>

    <?php if (isset($message)) echo "<p>$message</p>"; ?>

</body>

</html>