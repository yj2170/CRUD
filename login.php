<?php
session_start();
$message = "";

$filename = 'users.txt';

// 로그인 폼이 제출되었을 때만 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // users.txt 파일에서 사용자 찾기
    $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $login_success = false;

    foreach ($users as $user) {
        list($stored_user, $stored_hash) = explode(':', $user);
        if ($stored_user === $username && password_verify($password, $stored_hash)) {
            $login_success = true;
            break;
        }
    }

    if ($login_success) {
        $_SESSION['username'] = $username;  // 세션에 로그인 정보 저장
        header("Location: index.php");
        exit;
    } else {
        $message = "You've got wrong id or password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h5><u><a href="http://localhost/CRUD/login.php">home</a></u>
    <u><a href="http://localhost/CRUD/register.php">register</a></u>
    <u><a href="http://localhost/CRUD/login.php">login</a></u></h5>

    <h3><strong>login</strong></h3>

    <form action="login.php" method="POST">
        ID <input type="text" name="username" required><br><br>
        PASSWORD <input type="password" name="password" required><br><br>
        <button type="submit">login</button>
    </form>

    <?php if (isset($message)) echo "<p>$message</p>"; ?>

</body>

</html>