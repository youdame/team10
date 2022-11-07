<?php
    session_start();

    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $enter_id = $_POST['enter_id'];
    $enter_pw = $_POST['enter_pw'];
    $enter_name = $_POST['enter_name'];

    if($enter_id=="" || $enter_pw=="" || $enter_name==""){
        echo "<script>alert('입력되지 않은 정보가 있습니다.')</script>";
        echo "<script>history.back();</script>";
        exit;
    }

    $sql = "SELECT * FROM user WHERE id='$enter_id'";    
    $result = $mysqli->query($sql);

    //아이디가 이미 존재하면
    if(mysqli_num_rows($result)){
        echo "<script>alert('이미 존재하는 아이디입니다.')</script>";
        echo "<script>history.back();</script>";
        exit;
    }else{
        $sql2 = "INSERT INTO user(id, pwd, username) VALUES ('$enter_id', '$enter_pw', '$enter_name')";
        mysqli_query($mysqli, $sql2);

        echo "<script>alert('Sign up succeed.')</script>";
        echo "<script>location.href='../test.php';</script>";
        exit;
    }
?>