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
    <style>
        Logo {
            color: black;
            cursor: pointer;
            font-size: 2.7vw;
            display: flex;
            align-items: center;
            font-weight: bold;
            text-decoration: none;
            height: 4.16vw;
        }

        ButtonLink {
            display: flex;
            justify-content: end;

        }

        nav {
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

        Container {
            display: inline;
            justify-content: space-between;
            height: 4.16vw;
            z-index: 1;
            width: 74vw;
            max-width: 1100px;

        }

        mainContainer {
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 30px;
            height: 800px;
            position: relative;
            z-index=1;
        
        }

        Button {
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

        [type="submit"] {
            background-color: lightgray;
            border: 0px;
            padding: 8px;
            border-radius: 10px;
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
    </nav>



    <mainContainer>
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
        </mainContainer>
  </Container>

</body>

</html>