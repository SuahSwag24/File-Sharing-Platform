<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="./script/style.css">
    </head>
    <body>
        <a href="home.php">Back to home</a>
        <form action="./api/get-account.php" class="login-form" method="POST">
            <label for="username">Account Username: </label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <span class="message"><?php if(isset($_GET['msg'])) echo $_GET['msg'] ?></span><br>
        <span class="error-text"><?php if(isset($_GET['err'])) echo $_GET['err'] ?></span><br>
        <a href="register.php">Don't have an account?</a>
    </body>
</html>