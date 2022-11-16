<!--조유담-->
<?php
session_start();
$user_id = $_SESSION['id'];
$movie_id = $_POST['movie_id'];
$title = $_POST['movie_title'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>
<body>

<form action = "ratingInput_update.php" method ="post">
    <input type= "hidden" name= "movie_id" value= "<?php echo $movie_id;?>"/>
    <input type= "hidden" name= "movie_title" value= "<?php echo $title;?>"/>
    <!-- <input type="text" name= "user_id"> -->
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