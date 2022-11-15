<!--홍진서-->
<?php
session_start();
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");


$sql_update = "UPDATE compare_data SET input_sales = ?, input_audience = ? WHERE u_id = ?";

$user_id = $_SESSION['id'];
$modify_sales = $_POST['modify_sales'];
$modify_audience = $_POST['modify_audience'];

$stmt = $mysqli->prepare($sql_update);
$stmt->bind_param("sss", $modify_sales, $modify_audience, $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<script>window.close();</script>";
echo "<script>alert('Modified.');</script>";
?>