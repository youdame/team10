<!--조유담-->

<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<?php

session_start();
$user_id = $_SESSION['id'];



$conn = mysqli_connect("localhost", "team10", "team10", "team10");


$movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);


$movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);

$user_rating = mysqli_real_escape_string($conn, $_POST['num']);



$sql = "INSERT INTO user_rating VALUES ('$user_id', '$movie_id', '$user_rating')";

$result = mysqli_query($conn, $sql);


if ($result == false){
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
    error_log(mysqli_error($sql));
} else {

    //header("Location : detail2.php?m_title=$movie_title");
    echo "<script>location.href='detail2.php?m_title=$movie_title';</script>";
    
}







?>
