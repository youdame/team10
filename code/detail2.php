
<?php

$conn = mysqli_connect("localhost", "team10", "team10", "team10");

$title = $_GET['m_title'];
$sql = "SELECT * FROM movie_boxoffice WHERE title = '$title'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$id = $row['m_id'];

$sql_d = "SELECT * FROM director WHERE m_id = '$id'";
$result_d = mysqli_query($conn, $sql_d);
$row_d = mysqli_fetch_array($result_d);

$sql_r = "SELECT * FROM rating WHERE m_id = '$id'";
$result_r = mysqli_query($conn, $sql_r);
$row_r = mysqli_fetch_array($result_r);


?>


<!DOCTYPE html>
<html>
<head>
  <title><?php echo $_GET['m_title'];?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">

</head>


<body>
	
<div class = content>
    <!-- 포스터  -->
	<div id = codeit>
		<img src="<?=$row['poster']?>">
	</div>
    <!-- 제목 -->
    <p class = "title">
        <?php echo $title;?>
    </p>

    <!-- 정보 -->
    <p> 장르 : <?php echo $row['genre'];?></p>
    <p> 국적 : <?php echo $row['country'];?> </p>
    <p> 개봉일 : <?php echo $row['released_date'];?> </p>
    <p> 매출액 : <?php echo number_format( $row['sales']);?>원 </p>
    <p> 관객수 : <?php echo number_format($row['audience']);?>명</p>
    <p> 스크린 수: <?php echo number_format($row['screen_num']);?>개</p>
    <p> 감독: <?php echo $row_d['director'];?></p>
    <p> 배급사: <?php echo $row_d['distributor'];?></p>
    <p> 평점: <?php echo $row_r['rating'];?></p>
    
    
    
    <form action = "ratingInput.php" method ="post">
        <input type= "hidden" name= "movie" value= "<?php echo $id;?>"/>
        <input type="text" name= "user_id">
        <select name = "num">
            <option selected value= "">내 평점 등록하기</option>
            <option value= "1">1점</option>
            <option value= "2">2점</option>
            <option value= "3">3점</option>
            <option value="4">4점</option>
            <option value="5">5점</option>
            <option value="6">6점</option>
            <option value="7">7점</option>
            <option value="8">8점</option>
            <option value="9">9점</option>
            <option value="10">10점</option>
        </select>
        <input type = "submit" value= "등록">
    </form>
    






</body>
</html>
