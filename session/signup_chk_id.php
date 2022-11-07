<?php
    session_start();

    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $enter_id = $_POST['enter_id'];

    $sql = "SELECT * FROM user WHERE id='$enter_id'";
    $result = $mysqli->query($sql);
    if(mysqli_num_rows($result)){
        echo "<script>alert('이미 존재하는 아이디입니다');</script>";
        echo "<script>location.href='si.php';</script>";        exit;
        }
    }
    echo "<script>alert('Login failed.')</script>";
    echo "<script>location.href='login.php';</script>";
    exit;


?>