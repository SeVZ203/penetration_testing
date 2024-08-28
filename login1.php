<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    // 로그인 폼 제출 후 처리
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 여기서 사용자 입력에 대한 유효성 검사가 없기 때문에 XSS 공격에 취약합니다.
        echo "<p>Welcome, $username!</p>";
    }
    ?>

    <!-- 로그인 폼 -->
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

