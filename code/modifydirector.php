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
    
<link rel="stylesheet" type="text/css" href="css/header.css">
    <meta charset="UTF-8">
    <title>Document</title>
    <style>

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
    /* padding: 0 30px; */
    height: 400px;
    width:100%;
    position: relative;
    z-index: 1;
}
table{
            background: lightgray;
            display: grid;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: auto;
            margin-top: 100px;
            /* padding: 60px; */
            border-radius: 10px;
            border: 1px solid lightslategray;
        }

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}
td{font-size: 15px;
            line-height: 2rem;
            padding: 0.2em 0.4em;}
            
li {
    float: left;
}
        
h1{
            color: black; font-size: 40px;text-align: center;
        }
        h2{
            color:black; text-align:center;
        }
        .center-button{
            text-align:center;
        }
        Button{
            background-color: lightgray;

            border: 1px solid black;

            color: black;

            padding: 15px 30px;

            text-align: center;

            text-decoration: none;



            display: inline-block;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;
            border-radius: 5px;
        
        }
        #searchdirector{
            width:300px;
            height:40px;
            background-color:white;
            border: 2px solid black;
            border-radius:5px;
            margin:10px;

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
     
    </header>
  

    <!-- <form action = "modifydirector.php" method="GET">
                정보를 수정할 감독이름을 검색하세요: <br/><br/>
                <input type="textbox" name="director" placeholder="감독의 이름을 입력하세요">
                <input type="submit" value="검색하기">
            </form> -->
            <mainContainer>
            <h1>감독 정보 수정</h1>
       <div>
        <h2> 수정하고자 하는 감독 이름을 작성 후, <br/>
            모든 칸의 내용을 입력 후 제출 버튼을 누르세요</p>
        </div>

        <div class="center-button">
        <form method="GET" action="modifydirector.php">
            감독이름:<input id="searchdirector"  type = "text" name = "director" placeholder="감독의 이름을 입력하세요"><br/>
            대표작1: <input id="searchdirector" type="text" name="film1" placeholder="감독의 대표작을 입력하세요"/><br/>
            대표작2: <input id="searchdirector" type="text" name="film2" placeholder="감독의 대표작을 입력하세요"/><br/>
            대표작3: <input id="searchdirector" type="text" name="film3" placeholder="감독의 대표작을 입력하세요"/><br/>
            수상내역:<input id="searchdirector" type = "text" name="award" placeholder="감독의 수상내역을 입력하세요"/><br/>
          
                    <Button type="submit">수정하기</Button></div>
          
                </form>
            </div>

            <table>
                <tr>
                    <td>Director name</td>
                    <td>Film1</td>
                    <td>Film2 </td>
                    <td>Film3 </td>
                    <td>Award</td>
                    <td></td>
                </tr>
                </mainContainer>

            <?php
                
                $mysqli=mysqli_connect("localhost","team10","team10","team10");
                $sql ="SELECT di.d_id1, dt.director, dt.film1, dt.film2, dt.film3, da.award FROM 
                director_table AS dt 
                join director_id as di on dt.director=di.director
                join director_award as da on di.d_id1=da.d_id2";//%$director%
    
                $result=mysqli_query($mysqli, $sql);      
                $list = '';
    
                if(mysqli_num_rows($result) == 0){
                    $list = $list."<tr><td colspan=\"5\">결과가 없습니다.</td></tr>";
                }else{
                    while($row = mysqli_fetch_array($result)){
                        $director = $row['director'];
                        
                        $list = $list."<tr><td>{$director}</td><td>{$row['film1']}</td><td>{$row['film2']}</td><td>{$row['film3']}</td><td>{$row['award']}</td></tr>";
                    }
                }echo $list;  
?>
  
                    
      
        <?php
            
            $mysqli=mysqli_connect("localhost","team10","team10","team10");
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
            ON did.d_id1=da.d_id2 
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
                echo "";
              }
    
        ?>
 
</body>
</html>