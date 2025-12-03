<?php

    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(isset($username) && isset($password))
        {
            $conn = mysqli_connect("localhost", "root", "", "file_sharing_platform");

            if($conn->connect_error)
            {
                header("../login.php?err={$conn->connect_error}");
                die("Connection failed");
            }

            $sql = "SELECT * FROM User WHERE Username = ?";
            $checkUser = $conn->prepare($sql);
            $checkUser->bind_param("s", $username);
            $checkUser->execute();
            $result = $checkUser->get_result();

            if($result->num_rows === 1)
            {
                $row = $result->fetch_assoc();
                if(password_verify($password, $row['Password']))
                {
                    header("Location: ../home.php?msg=login_success");
                }
                else
                {
                    header("Location: ../login.php?err=bad_credentials");
                }
            }
            else
            {
                header("Location: ../login.php?err=bad_credentials");
            }
        }
    }

    $conn->close();

?>