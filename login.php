<?php
session_start();
$host = '192.168.0.110';
$db   = 'test_db';
$user = 'sevz';
$pass = 'qhdks1!'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL Injection에 취약한 코드 (Prepared Statement를 사용하지 않음)
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username; // 로그인한 사용자 이름을 세션에 저장
        setcookie('username', $username, time() + 3600, "/"); // 1시간 동안 쿠키 저장
        // 추가로 취약하게 할 수 있는 곳
        echo "Your password is: " . $password . "<br>";
        echo '<form action="board.php" method="GET">';
        echo '<button type="submit">Go to Board</button>';
        echo '</form>';
    }else {
        echo "Invalid login.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
