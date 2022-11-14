 <!-- 김다희 Dahee Kim -->
 <!-- 감독 이름 검색 시 감독의 대표작 3개와 수상내역 보여줌, 그리고 제일 오른쪽에 수정버튼 만들어서 update사용하기// -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Director</title>
        <style></style>
    </head>

    <body>
        <nav>
            <Container>
                <Logo>Movie</Logo>
            </Container>
            <ul>
                <Button><li><a href="/"> Search</a></li></Button>
                <Button><li><a href="director.php"> Director</a></li></Button>
                <Button><li><a href="/"> My page</a></li></Button>
                <Button><li><a href="test.php"> Login</a></li></Button>
            </ul>
        </nav>



        <h1>Search Director Filmography</h1>
        <div>
        <p> 감독 필모그래피 검색해보세요~</p></div>
            
            <form action = "director.php" method="GET">
                감독이름 검색: <input type="textbox" name="director" placeholder="감독의 이름을 입력하세요">
                <input type="submit" value="검색하기">
            </form>

            <table>
                <tr>
                    <td>Director name</td>
                    <td>Film1</td>
                    <td>Film2 </td>
                    <td>Film3 </td>
                    <td>Award</td>
                    <td></td>
                </tr>
                <form action='director.php'>
                    <input type='button' value='감독정보 등록' onclick='location.href="newdirector.php"'/></form>
                <form action='director.php'>
                    <input type='button' value='감독정보 수정하기' onclick='location.href="modifydirector.php"'/></form>
                <form action='director.php'>
                    <input type='button' value='감독정보 삭제하기' onclick='location.href="delete.php"'/></form>                

        <?php
            session_start();
            $mysqli=mysqli_connect("localhost","team10","team10","team10","3307");
            if(isset($_GET['director'])){
                $director=$_GET['director'];
            }else{
                $director="김한민";
            }
        ?>        
      
        <?php
            $sql ="SELECT * FROM director_table WHERE director LIKE '%$director%'";
            $result=mysqli_query($mysqli, $sql);      
            $list = '';

            if(mysqli_num_rows($result) == 0){
                $list = $list."<tr><td colspan=\"5\">결과가 없습니다.</td></tr>";
            }else{
                while($row = mysqli_fetch_array($result)){
                    $director = $row['director'];
                    
                    $list = $list."<tr><td><a href='./detail.php?director=$director'>{$director}</a></td><td>{$row['film1']}</td><td>{$row['film2']}</td><td>{$row['film3']}</td><td>{$row['award']}</td></tr></br>";
                }
            }echo $list;  
        ?>
       
    </body>
    
</html>