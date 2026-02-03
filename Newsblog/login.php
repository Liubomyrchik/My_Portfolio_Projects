<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysql = new mysqli("localhost", "root", "root", "newsblog");
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        password_verify("DB HASH", $userinput_password);
        $mysql->query("INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$password')");
        $mysql->close();
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Newsblog Login</title>
</head>
<body>
    <div class="wrapper">
        <main class="page">
            <section class="page__login login">
                <div class="login__container">
                    <div class="login__wrapper">
                        <h2 class="login__title">Register</h2>
                        <form method="POST" class="login__form">
                            <input type="text" class="login__input" name="username" placeholder="Username" required>
                            <input type="password" class="login__input" name="password" placeholder="Password" required>
                            <button type="submit" class="login__submit">Register</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>