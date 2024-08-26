<?php
$host = '192.168.0.110';
$db   = 'test_db';
$user = 'sevz';
$pass = 'qhdks1!';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 게시글 추가 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // SQL Injection에 취약한 코드
    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "New post created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 게시글 목록 조회
$sql = "SELECT id, title, content FROM posts";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
</head>
<body>
    <h1>Simple Board</h1>

    <!-- 로그아웃 버튼 -->
    <form method="POST" action="login.php">
        <button type="submit">Logout</button>
    </form>

    <!-- 게시글 작성 폼 -->
    <form method="POST" action="board.php">
        <p>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </p>
        <p>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
        </p>
        <button type="submit">Post</button>
    </form>

    <hr>

    <!-- 게시글 목록 -->
    <h2>Posts</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>
</body>
</html>
