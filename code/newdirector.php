<!-- 김다희 newdirector.php 감독정보 등록하기 page -->
<!-- 감독이름, 대표작 3개, 수상 등록할 수 있게 하기 update -->
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


    <h1>welcome to our page</h1>
       <div>
        <p> Let's see which movie is interesting</p>
        </div>


        <form method="POST" action="newdirector.php">
            감독이름:<input type="text" name="director"/><br/>
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
            // ".$_POST['film3'].",".$_POST['award']."')";
            $sql="INSERT INTO  director_table (director, film1, film2, film3)
            VALUES('{$_POST['director']}','{$_POST['film1']}','{$_POST['film2']}','{$_POST['film3']}')";
            $sql_1="INSERT into director_award(award) VALUES('{$_POST['award']}')";
            $sql_2="INSERT into director_id(director)
            VALUES('{$_POST['director']}')";
            
            //,'{$_POST['award']}'
            // Insert into director_table (director, film1, film2, film3)
            // values("test1","1","1","1");
            // Insert into director_award(award)
            // values("hi");
            // Insert into director_id(director)
            // values("test1");
            
            $result=mysqli_query($mysqli,$sql);      
            $result_1=mysqli_query($mysqli,$sql_1);    
            $result_2=mysqli_query($mysqli,$sql_2);
            // if($result === false){
            //     echo '오류';
            //     error_log(mysqli_error($sql));
            //   } else {
            //     echo '성공했습니다. <a href="newdirector.php">돌아가기</a>';
            //   }
        

          
        ?>
 
</body>
</html>