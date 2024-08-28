<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    // 로그인 폼 제출 후 처리
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // htmlspecialchars 함수를 사용하여 XSS 공격 방지
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        // 사용자에게 환영 메시지 출력 (인코딩된 사용자 입력을 사용)
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

