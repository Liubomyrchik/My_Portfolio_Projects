<?php
    $mysql = new mysqli("localhost", "root", "root", "newsblog");
    $mysql->set_charset("utf8");
    $mysql->query("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(12) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    $mysql->query("
        CREATE TABLE IF NOT EXISTS comments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            comment TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )");

    if ($mysql->connect_error) {
        die("DB Error: " . $mysql->connect_error);
    }

    $user_id = 1;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $comment = $_POST['comment'];

        if ($comment !== "") {
            $last_user_result = $mysql->query("SELECT id FROM users ORDER BY created_at DESC LIMIT 1");
            if ($last_user_result && $last_user_result->num_rows > 0) {
                $last_user = $last_user_result->fetch_assoc();
                $user_id = $last_user['id'];
                $mysql->query(
                    "INSERT INTO comments (user_id, comment) VALUES ($user_id, '$comment')"
                );
            }
        }
    }

    $result = $mysql->query("
        SELECT c.comment, c.created_at, u.username
        FROM comments c
        JOIN users u ON c.user_id = u.id
        ORDER BY c.created_at DESC
    ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Newsblog Project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__container">
                <p class="header__logo">Logo</p>
                <nav class="header__nav">
                    <ul class="header__list">
                        <li class="header__item"><a href="#" class="header__link">Home</a></li>
                        <li class="header__item"><a href="#" class="header__link">About</a></li>
                        <li class="header__item"><a href="http://localhost/Newsblog/login.php" class="header__link">Login / Register</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="page">
            <section class="page__hero hero">
                <div class="hero__container">
                    <div class="hero__wrapper">
                        <h1 class="hero__title">Newsblog</h1>
                        <p class="hero__subtitle">Write your comment below:</p>
                        <form method="POST" class="hero__form">
                            <textarea cols="50"rows="7" placeholder="Write your comment here" class="hero__input" name="comment" required></textarea>
                            <button class="hero__submit" type="submit">Send Comment</button>
                        </form>
                    </div>
                    <div class="hero__comments">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="hero__comment comment">
                                <div class="comment__info">
                                    <h3 class="comment__user"><?= $row['username'] ?></h3>
                                    <p class="comment__date">
                                        <?= date("d.m.Y", strtotime($row['created_at'])) ?>
                                    </p>
                                </div>
                                <p class="comment__text"><?= $row['comment'] ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        </main>
        <footer class="footer"></footer>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
