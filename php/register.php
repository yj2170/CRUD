<?php
$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'crud';
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

    if (!$username || !$password) {
        $message = "Please enter your username and password.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password_hash) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $hashed]);

        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h5><u><a href="login.php">home</a></u>
    <u><a href="register.php">register</a></u>
    <u><a href="login.php">login</a></u></h5>

    <h3><strong>register</strong></h3>

    <form action="register.php" method="POST">
        username <input type="text" name="username" required><br><br>
        password <input type="password" name="password" required><br><br>
        <button type="submit">register</button>
    </form>

</body>

</html>