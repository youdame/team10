<!-- 김다희 newdirector.php 감독정보 등록하기 page -->
<!-- 감독이름, 대표작 3개, 수상 등록할 수 있게 하기 update -->
<!-- 감독이름을 검색하면, list로 항목 가져오기, 그다음에 그 검색값으로 sql update하기 -->
<?php
        session_start();
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
        <Container>
            <Logo>Movie</Logo>
            <!-- <Button>
                <ButtonLink href="/"> Search</a></Button>
                <Button><ButtonLink href="/"> Director</a></Button>
                <Button><ButtonLink href="/"> My Page</a></Button> -->
        </Container>
        <ul>
        <Button><li><a href="/"> Search</a></li></Button>
        <Button><li><a href="director.php"> Director</a></li></Button>
        <Button><li><a href="/"> My page</a></li></Button>
        <Button><li><a href="test.php"> Login</a></li></Button>
        </ul>
    </nav>

    <form action = "modifydirector.php" method="GET">
                정보를 수정할 감독이름을 검색하세요: <br/><br/>
                <input type="textbox" name="director" placeholder="감독의 이름을 입력하세요">
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
            <?php
                
                $mysqli=mysqli_connect("localhost","team10","team10","team10","3307");
                // if(isset($_GET['director'])){
                //     $director=$_GET['director'];
                // }else{
                //     $director=" ";
                // }
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
    <h1>감독 정보 수정</h1>
       <div>
        <p> 모든 칸의 내용을 입력 후 제출 버튼을 누르세요</p>
        </div>


        <form method="POST" action="modifydirector.php">
            <!-- 감독이름:<input type="text" name="director"/><br/> -->
            대표작1:<input type="text" name="film1"/><br/>
            대표작2:<input type="text" name="film2"/><br/>
            대표작3:<input type="text" name="film3"/><br/>
            수상내역:<input type = "text" name="award"/><br/>
            <input type= "submit" name="register"/><br/>
        </form>
                    
      
        <?php
            
            $mysqli=mysqli_connect("localhost","team10","team10","team10","3307");
            // $sql ="INSERT INTO director_table (director,film1,film2,film3,award)"
            // ."values('".$_POST['director']."
            // ','".$_POST['film1']."',".$_POST['film2'].",
            // // ".$_POST['film3'].",".$_POST['award']."')";
            $sql_modify=
            "UPDATE director_table SET
            film1=$_POST['film1'], 
            film2=$_POST['film2'], 
            film3=$_POST['film3'],
            award=$_POST['award'] WHERE director = '%$director%'";
            // "UPDATE director_table SET film1=$_POST['film1']WHERE director='%$director%'";
            //      ".$_POST['film3'].",".$_POST['award']."')";
            //      $sql="UPDATE director_table SET 
            //      director=
            //      WHERE director like '$director%'";
                 
            // // UPDATE myMember SET phone = '010-1234-5678"', userId = 'yuna-kim' WHERE myMemberID = 5;
            $result_1=mysqli_query($mysqli,$sql_modify);      
            if($result_1 === false){
                echo '오류.';
                error_log(mysqli_error($sql_modify));
              } else {
                echo '성공했습니다. ';
              }
    
        ?>
 
</body>
</html>