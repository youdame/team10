<!--이유림-->
/*mypage_like_delete*/


<?php
if (!session_id()) {
    session_start();
}

$prevPage = 'mypage.php';
$selected_title = $_POST['movie_title'];
$nickname = $_SESSION['name'];
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

/*user id 구하기 */
$user_id = $_SESSION['id'];

/*movie id 구하기*/
$m_id_query = "SELECT movie_boxoffice.m_id FROM movie_boxoffice WHERE title='$selected_title'";
$m_id_result = mysqli_query($mysqli, $m_id_query);
$m_id_row = mysqli_fetch_row($m_id_result);

$movie_id = $m_id_row[0];

$insert_query = "INSERT INTO user_like(u_id, m_id) VALUES (?, ?)";
$stmt = $mysqli->prepare($insert_query);
$stmt->bind_param("si", $user_id, $movie_id);
$insert_res = $stmt->execute();

header('location:' . $prevPage);
