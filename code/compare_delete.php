<!--홍진서-->

<?php
session_start();
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

$sql_delete = "DELETE FROM compare_data WHERE u_id = ?";
//$user_id = $_SESSION['id'];
$user_id = "JINSEO";

$stmt = $mysqli->prepare($sql_delete);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<script>alert('Deleted.');</script>";
echo "<script>location.href='compare.php';</script>";
?>