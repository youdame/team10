<!--조유담-->


<?php



session_start();
$user_id = $_SESSION['id'];



$conn = mysqli_connect("localhost", "team10", "team10", "team10");


//$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

$movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);


$movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);

$user_rating = mysqli_real_escape_string($conn, $_POST['num']);



$sql = "UPDATE user_rating SET u_rating = '$user_rating' WHERE u_id = '$user_id' AND m_id = '$movie_id'";

$result = mysqli_query($conn, $sql);
echo $movie_title;

if ($result == false){
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
    error_log(mysqli_error($sql));
} else {
    echo $movie_title;

    //header("Location : detail2.php?m_title=$movie_title");
    echo "<script>location.href='detail2.php?m_title=$movie_title';</script>";
    
}







?>
