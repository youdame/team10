<!--홍진서-->
<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");
    
    $keyword = $_GET['keyword']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="keywordSearch.php" method="GET">
        <input type="textbox" name="keyword">
        <input type="submit" value="search">
    </form>
    
    <table>
        <tr>
            <td>Title</td>
            <td>Released date</td>
            <td>Number of audience</td>
            <td>Director</td>
            <td>Genre</td>
        </tr>

        <?php
            // 쿼리
            $sql = "SELECT * FROM movie_boxoffice WHERE title LIKE '%$keyword%' OR director LIKE '%$keyword%'";
            $result = mysqli_query($mysqli, $sql);
            $list = '';

            if(mysqli_num_rows($result) == 0){
                $list = $list."<tr><td colspan=\"6\">결과가 없습니다.</td></tr>";
            }else{
                while($row = mysqli_fetch_array($result)){
                    $m_title = $row['title'];
                    $list = $list."<tr><td><a href='./detail.php?title=$m_title'>{$m_title}</a></td><td>{$row['released_date']}</td><td>{$row['audience']}</td><td>{$row['director']}</td><td>{$row['genre']}</td></tr></br>";
                }
            }echo $list;           
            
        ?>
</body>
</html>