<!--홍진서-->
<?php
    session_start();

    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $enter_id = $_POST['enter_id'];
    $enter_pw = $_POST['enter_pw'];
    $enter_name = $_POST['enter_name'];
    $enter_gender = $_POST['gender'];
    $enter_age = $_POST['age'];
    $enter_genre = $_POST['genre'];

    $sql = "SELECT * FROM user WHERE u_id=?";    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $enter_id);
    $stmt->execute();
    
    $result = $stmt->get_result();


    //아이디가 이미 존재하면
    if(mysqli_num_rows($result)){
        echo "<script>alert('이미 존재하는 아이디입니다.')</script>";
        echo "<script>history.back();</script>";
        exit;
    }else{
        $sql2 = "INSERT INTO user(u_id, pwd, username, preferred) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql2);
        $stmt->bind_param("ssss", $enter_id, $enter_pw, $enter_name, $enter_genre);
        $stmt->execute();

        $sql3 = "INSERT INTO user_info(u_id, usersex, userage) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql3);
        $stmt->bind_param("ssi", $enter_id, $enter_gender, $enter_age);
        $stmt->execute();

        echo "<script>alert('Sign up succeed.')</script>";
        echo "<script>location.href='main.php';</script>";
        exit;
    }
?>