<?php
    date_default_timezone_set("UTC");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['test-upload']))
        {
            #Database variables preparation
            $fileInput = $_POST['test-upload'];
            $uploadDate = time();
            
        }
    }
?>