<?php

    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(isset($username) && isset($password))
        {
            $conn = new mysqli("localhost", "root", "", "file_sharing_platform");
            if($conn->connect_error)
            {
                header("../register.php?err={$conn->connect_error}");
                die("Connection failed");
            }
            
            $sql = "SELECT * FROM user WHERE username = ?";
            $checkUser = $conn->prepare($sql);
            $checkUser->bind_param("s", $username);
            $checkUser->execute();
            $results = $checkUser->get_result();

            if($results->num_rows > 0)
            {
                header("Location: ../register.php?err=username_taken");
            }
            else
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
                $insertStmt = $conn->prepare($sql);
                $insertStmt->bind_param("ss", $username, $hashedPassword);

                if($insertStmt->execute())
                {
                    header("Location: ../login.php?msg=register_success");
                }
                else
                {
                    header("Location: ../register.php?err=register_failed");
                }
            }
        }

        $conn->close();
    }

?>