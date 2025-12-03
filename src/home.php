<html>
    <link rel="stylesheet" href="./script/style.css">
    <head>
        <title>File Sharing Platform</title>
    </head>
    <body>
        <h2>File Sharing Platform</h2>
        <div class="account-button">
            <?php
            
                if(isset($_GET['msg']) == "login_success")
                {
                    
                }
                else
                {
                    echo "<a href='login.php'>Please login before uploading...</a>";
                }
            
            ?>
        </div>
        <div>
            <form action="src/api/upload-file.php" method="POST" class="form-class">
                <h2>Upload your files here</h2>
                <input type="file" name="file-upload" disabled>
                <input type="text" name="test-upload" required>
                <div><button type="submit">Upload File</button></div>
            </form>
        </div>
    </body>
    <footer class="footer-credit">
        <span>Created by: Suah, Aden, Jun Yan</span>
    </footer>
</html>