<?php
session_start();

$filename = 'users.txt';

// 폼이 제출되었을 때만 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $message = "아이디와 비밀번호를 입력하세요.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents($filename, "$username:$hashed_password\n", FILE_APPEND);
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
    <h5><u><a href="http://localhost/CRUD/login.php">home</a></u>
    <u><a href="http://localhost/CRUD/register.php">register</a></u>
    <u><a href="http://localhost/CRUD/login.php">login</a></u></h5>

    <h3><strong>register</strong></h3>

    <form action="register.php" method="POST">
        ID <input type="text" name="username" required><br><br>
        PASSWORD <input type="password" name="password" required><br><br>
        <button type="submit">register</button>
    </form>

</body>

</html>