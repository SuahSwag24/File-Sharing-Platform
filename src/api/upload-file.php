<?php
    session_start();

    date_default_timezone_set("UTC");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_FILES['file-upload']))
        {
            $ext = pathinfo($_FILES['file-upload']['name'], PATHINFO_EXTENSION);

            if(isset($_POST['upload-name']))
                $originalName = $_POST['upload-name'] . '.' . $ext;
            else
                $originalName = $_FILES['file-upload']['name'] . '.' . $ext;

            $uploadDate = time();
            $expiryDate = $uploadDate + 604800;
            
            $userID = $_SESSION['userID'];
            $uniqueID = bin2hex(random_bytes(16));

            #---------------AWS S3 INTEGRATION HERE-------------------------------

            #---FOR TESTING---
            $tmp = $_FILES['file-upload']['tmp_name'];
            $storeName = uniqid() . '.'. $ext;

            $targetDir = "../../aws/";
            $targetPath = $targetDir . $storeName;
            #---FOR TESTING---

            #----------------------------------------------------------------------

            if(move_uploaded_file($tmp, $targetPath))
            {
                $conn = mysqli_connect("localhost", "root", "", "file_sharing_platform");
                $sql = "INSERT INTO uploaded_files (store_name, original_name, upload_date, file_key, expiry_date, user_id) VALUES (?, ?, ?, ?, ?, ?)";
                $addEntry = $conn->prepare($sql);
                $addEntry->bind_param("ssisii", $storeName, $originalName, $uploadDate, $uniqueID, $expiryDate, $userID);

                if($addEntry->execute())
                {
                    header("Location: ../home.php?msg=upload_success");
                }
                else
                {
                    header("Location: ../home.php?err=upload_failed");
                }
                $conn->close();
            }
            else
            {
                header("Location: ../home.php?err=upload_failed");
                exit;
            }

        }
    }
    exit;
?>