
<!-- 김다희 dahee kim-->
<?php
        session_start();
        error_reporting(E_ALL);
        ini_set("display_errors", 0);
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
<!--네비게이션 바-->
    <nav>
        
        <ul>
        <Button><li><a href="/"> Search</a></li></Button>
        <Button><li><a href="director.php"> Director</a></li></Button>
        <Button><li><a href="/"> My page</a></li></Button>
        <Button><li><a href="test.php"> Login</a></li></Button>
        </ul>
    </nav>

        <form action="delete.php" method="GET">
                        감독이름 검색: 
                        <input type="textbox" name="di" placeholder="감독의 이름을 입력하세요">
                        <input type="submit" value="검색하기">
                    </form>



<?php 
   
        $mysqli=mysqli_connect("localhost","team10","team10","team10","3307");
   
        // if(isset($_GET['director'])){
        //     $director=$_GET['director'];
        // }else{
        //     $director="2";
        // }
        // DELETE FROM dt, da ,di
        // using director_table as dt 
        //             join director_id as di 
        //             on dt.director=di.director
        //             join director_award as da 
        //             on di.d_id=da.d_id 
        //             WHERE dt.director='test1'//여기만 바꾸기..가능?
        // $sql="DELETE FROM 
        // director_table 
        // WHERE director='$director'";

        $sql="DELETE FROM dt, da ,did using director_table as dt 
            join director_id as did 
            on dt.director=did.director
            join director_award as da 
            on did.d_id=da.d_id 
            WHERE dt.director='{$_GET['di']}'";
        //$sql="DELETE FROM director_table,director award WHERE director={$_GET['di']}";
        $result=mysqli_query($mysqli,$sql);
        // $list = '';

        // if(mysqli_num_rows($result) == 0){
        //     $list = $list."<tr><td colspan=\"5\">결과가 없습니다.</td></tr>";
        // }else{
        //     while($row = mysqli_fetch_array($result)){
        //         $director = $row['director'];

                
        //         $list = $list."<tr><td><a href='./detail.php?director=$director'>{$director}</a></td><td>{$row['film1']}</td><td>{$row['film2']}</td><td>{$row['film3']}</td><td>{$row['award']}</td></tr></br>";
        //     }
        // }echo $list;  
       
// 물어보는거 구현...ㅅㅂ..
        // if($result=mysqli_query($mysqli,$sql)){
        //     echo "<script>alert('감독정보가 삭제되었습니다.')</script>";
        // }else{
        //     echo "<script>alert('오류.')</script>";
        // }
?>
</body>
</html>