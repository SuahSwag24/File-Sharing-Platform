<html>
    <head>
        <title>Register Account</title>
        <link rel="stylesheet" href="./script/style.css">
    </head>
    <body>
        <a href="login.php">Back to login</a>
        <form action="./api/register-account.php" class="login-form" method="POST">
            <label for="username">Account Username: </label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Register Account</button>
        </form>
        <span class="error-text"><?php if(isset($_GET['err'])) echo $_GET['err']?></span>
    </body>
</html>