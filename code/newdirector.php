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
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        
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
    <header id="main_header">
        <nav>
            <a id="logo" href="main.php"> Team10, MOVIE </a>
            
            <ul class="header_ul">
                <?php
                session_start();
                if (isset($_SESSION['name'])) { ?>
                    <li class="header_li"><a href="./logout.php"> Log out</a></li>
                    <li class="header_li"><a href="./mypage.php"> My page</a></li>
                    <li class="header_li"><a href="./sales_month.php"> Sales</a></li>
                    <li class="header_li"><a href="./director.php"> Director</a></li>
                    <li class="header_li"><a href="./dash.php">DashBoard</a></li>
                    <li class="header_li"><a href="./genre.php"> Genre</a></li>
                   
                   
                    <li class="header_li"><form action="filter.php" method="post">
                        <input type="hidden" name="country" value="Korea">
                        <input type="hidden" name="rate" value="5">
                        <input type="hidden" name="year" value="2020">
                        <input type="hidden" name="aud" value="all">
                        <input type="hidden" name="audMin" value="0">
                        <input type="hidden" name="audMax" value="20000000">
                        <input type="hidden" name="search_input" value="true">
                        <input type="submit" value="Filter" id="filter_submit">
                    </form></li>
                
                    <li class = "header_li"><a href="./newdirector.php"> 감독정보등록</a></li>
                    <li class = "header_li"><a href="./modifydirector.php"> 감독정보수정</a></li>
                    <li class = "header_li"><a href="./delete.php"> 감독정보삭제</a></li>
                <?php
                } else { ?>
                    <li class="header_li"><a href="./login.php"> Login</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>
  


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