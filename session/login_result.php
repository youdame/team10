<?php
    session_start();

    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $input_id = $_POST['input_id'];
    $input_pw = $_POST['input_pw'];

    $sql = "SELECT * FROM user WHERE id='$input_id'";
    $result = $mysqli->query($sql);
    if(mysqli_num_rows($result)){
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if($row!=null && $row['pwd']==$input_pw){
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['username'];
            echo "<script>location.href='../test.php';</script>";
            exit;
        }
    }
    echo "<script>alert('Login failed.')</script>";
    echo "<script>location.href='login.php';</script>";
    exit;
?>