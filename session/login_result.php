<?php
    session_start();

    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $input_id = $_POST['input_id'];
    $input_pw = $_POST['input_pw'];

    $sql = "SELECT * FROM user WHERE u_id=? and pwd=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $input_id, $input_pw);
    $stmt->execute();

    $result = $stmt->get_result();
    if(mysqli_num_rows($result)){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['id'] = $row['u_id'];
        $_SESSION['name'] = $row['username'];
        echo "<script>location.href='../test.php';</script>";
        exit;
    }
    echo "<script>alert('Login failed.')</script>";
    echo "<script>location.href='login.php';</script>";
    exit;
?>