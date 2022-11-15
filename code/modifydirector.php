<!-- 김다희 newdirector.php 감독정보 등록하기 page -->
<!-- 감독이름, 대표작 3개, 수상 등록할 수 있게 하기 update -->
<!-- 감독이름을 검색하면, list로 항목 가져오기, 그다음에 그 검색값으로 sql update하기 -->
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
    <style>
Logo{
    color: black;
    cursor: pointer;
    font-size: 2.7vw;
    display: flex;
    align-items: center;
    font-weight: bold;
    text-decoration: none;
    height: 4.16vw;
}
ButtonLink{
    display: flex;
    justify-content: end;

  }
nav{
    background-color: lightblue;
    width: 100%;
    height: 4.16vw;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    position: sticky;
    top: 0;
    z-index: 10;
  }
Container{
    display: inline;
    justify-content: space-between;
    height: 4.16vw;
    z-index: 1;
    width: 74vw;
    max-width: 1100px;

}
mainContainer{
    background: white;
    display: grid;
    justify-content: center;
    align-items: center;
    padding: 0 30px;
    height: 800px;
    position: relative;
    z-index: 1;
}
Button{
    display: inline;
    justify-content: end;

}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
}
</style>
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
        <ul>
        <Button>
                <li><a href="./.php"> Search</a></li>
            </Button>
            <Button>
                <li><a href="./genre.php"> Genre</a></li>
            </Button>
            <Button>
                <li><a href="./dash.php">DashBoard</a></li>
            </Button>
            <Button>
                <li><a href="./director.php"> Director</a></li>
            </Button>
            <Button>
                <li><a href="./mypage.php"> My page</a></li>
            </Button>
            <Button>
                <li><a href="./login.php"> Login</a></li>
            </Button>
        </ul>
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
                $sql ="SELECT di.d_id, dt.director, dt.film1, dt.film2, dt.film3, da.award FROM 
                director_table AS dt 
                join director_id as di on dt.director=di.director
                join director_award as da on di.d_id=da.d_id";//%$director%
    
                $result=mysqli_query($mysqli, $sql);      
                $list = '';
    
                if(mysqli_num_rows($result) == 0){
                    $list = $list."<tr><td colspan=\"5\">결과가 없습니다.</td></tr>";
                }else{
                    while($row = mysqli_fetch_array($result)){
                        $director = $row['director'];
                        
                        $list = $list."<tr><td><a href='./detail.php?director=$director'>{$director}</a></td><td>{$row['film1']}</td><td>{$row['film2']}</td><td>{$row['film3']}</td><td>{$row['award']}</td></tr>";
                    }
                }echo $list;  
?>
    <h1>감독 정보 수정</h1>
       <div>
        <p> 수정하고자 하는 감독 이름을 작성 후, <br/>
            모든 칸의 내용을 입력 후 제출 버튼을 누르세요</p>
        </div>


        <form method="GET" action="modifydirector.php">
            감독이름: <input type = "text" name = "director"/><br/>
            대표작1:<input type="text" name="film1"/><br/>
            대표작2:<input type="text" name="film2"/><br/>
            대표작3:<input type="text" name="film3"/><br/>
            수상내역:<input type = "text" name="award"/><br/>
            <input type= "submit" value="수정하기"/><br/>
        </form>
                    
      
        <?php
            
            $mysqli=mysqli_connect("localhost","team10","team10","team10","3307");
            // $sql ="INSERT INTO director_table (director,film1,film2,film3,award)"
            // ."values('".$_POST['director']."
            // ','".$_POST['film1']."',".$_POST['film2'].",
            // // ".$_POST['film3'].",".$_POST['award']."')";
            $sql_1="UPDATE director_table SET
            director='{$_GET['director']}',
            film1='{$_GET['film1']}', 
            film2='{$_GET['film2']}', 
            film3='{$_GET['film3']}'
            WHERE director = '{$_GET['director']}'";

            $sql_2="UPDATE director_award AS da 
            INNER JOIN director_id AS did 
            ON did.d_id=da.d_id 
            SET award='{$_GET['award']}' 
            WHERE director= '{$_GET['director']}'";
     


            // update director_table SET director="test1", film1="22",film2="33", film3="44" where director="test1";

            // update director_award da inner join director_id did
            // on did.d_id=da.d_id
            // set award="55"
            // where director="test1";
            // "UPDATE director_table SET film1=$_POST['film1']WHERE director='%$director%'";
            //      ".$_POST['film3'].",".$_POST['award']."')";
            //      $sql="UPDATE director_table SET 
            //      director=
            //      WHERE director like '$director%'";
                 
            // // UPDATE myMember SET phone = '010-1234-5678"', userId = 'yuna-kim' WHERE myMemberID = 5;
            $result_1=mysqli_query($mysqli,$sql_1);    
            $result_2=mysqli_query($mysqli,$sql_2);  
            if($result_1 === false){
                echo "<script>alert('오류.')</script>";
                error_log(mysqli_error($sql));
              } else {
                echo '성공했습니다. ';
              }
    
        ?>
 
</body>
</html>