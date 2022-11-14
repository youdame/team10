<?php



// session_start();
// $user_id = $_SESSION['id'];


// $user_id = $_POST['user_id'];
// $movie_id = $_POST['movie'];
// $user_rating = $_POST['num'];
// echo $user_id;
// echo $movie_id;
// echo $user_rating;


$conn = mysqli_connect("localhost", "team10", "team10", "team10");


$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

$movie_id = mysqli_real_escape_string($conn, $_POST['movie']);

$user_rating = mysqli_real_escape_string($conn, $_POST['num']);



// $sql = "INSERT INTO 
// user_rating (u_id, m_id, u_rating)
// VALUES (?, ?, ?)";


// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param("sii", $user_id, $movie_id, $user_rating);
// $stmt->execute();
// $result = $stmt->get_result();

// $result = mysqli_query($conn, $sql);
// 유저 아이디 문제 없음
// 유저 평점 문제없음

// $sql = "SELECT * FROM user_rating  WHERE m_id = '$movie_id'";
// $result = mysqli_query($conn, $sql);
// print_r(mysqli_fetch_array($result));
// // $row = mysqli_fetch_array($result);
// // echo $row[0];

$sql = "INSERT INTO user_rating ('u_id', 'm_id', u_rating') VALUES ('$user_id', '$movie_id', '$user_rating')";

$result = mysqli_query($conn, $sql);


// if ($result == false){
//     echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
//     error_log(mysqli_error($sql));
// } else {
    
//     header('Location : detail2.php');
// }



?>
