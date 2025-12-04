<?php

    session_start();

    if(isset($_SESSION['username']))
    {
        $sessionUser = $_SESSION['username'];
    }

?>

<html>
    <link rel="stylesheet" href="./script/style.css">
    <head>
        <title>File Sharing Platform</title>
    </head>
    <body>
        <h2>File Sharing Platform</h2>
        <div class="account-button">
            <?php
            
                if(isset($_SESSION['username']))
                {
                    echo "<span>Welcome, '$sessionUser'</span>";
                    echo "<a href='./api/logout.php'>Click here to logout</a>";
                }
                else
                {
                    echo "<a href='login.php'>Please login before uploading...</a>";
                }
            
            ?>
        </div>
        <div>
            <form action="./api/upload-file.php" method="POST" class="form-class" enctype="multipart/form-data">
                <h2>Upload your files here</h2>
                    <input type="text" name="upload-name" placeholder="Name of File (optional)">
                <input type="file" name="file-upload" required>
                <div><button type="submit">Upload File</button></div>
                <?php
                    if(isset($_GET['msg']))
                        echo "<span>{$_GET['msg']}</span>";
                    if(isset($_GET['err']))
                        echo "<span>{$_GET['err']}</span>";
                ?>
            </form>
        </div>
    </body>
    <footer class="footer-credit">
        <span>Created by: Suah, Aden, Jun Yan</span>
    </footer>
</html>