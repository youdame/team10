<!--이유림-->
<?php
if (!session_id()) {
    session_start();
}

$prevPage = 'mypage.php';
$selected_title = $_POST['movie_title'];
$nickname = $_SESSION['name'];
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

/*user id 구하기 */
$user_id_query = "SELECT user.u_id from user where user.username = '$nickname'";
$user_id_result = mysqli_query($mysqli, $user_id_query);
$user_id_row = mysqli_fetch_row($user_id_result);

$user_id = $user_id_row[0];

/*movie id 구하기*/
$m_id_query = "SELECT movie_boxoffice.m_id FROM movie_boxoffice WHERE title='$selected_title'";
$m_id_result = mysqli_query($mysqli, $m_id_query);
$m_id_row = mysqli_fetch_row($m_id_result);

$movie_id = $m_id_row[0];

$insert_query = "DELETE FROM user_like WHERE m_id='$movie_id' AND u_id='$user_id'";
$insert_res = mysqli_query($mysqli, $insert_query);

header('location:' . $prevPage);
