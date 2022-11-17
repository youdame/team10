 <!-- 김다희 Dahee Kim -->
 <!-- 감독 이름 검색 시 감독의 대표작 3개와 수상내역 보여줌, 그리고 제일 오른쪽에 수정버튼 만들어서 update사용하기// -->

 <!DOCTYPE html>
 <html lang="en">

 <head>
    
    <link rel="stylesheet" type="text/css" href="css/header.css">
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Director</title>
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
    height: 200px;
    width:100%;
    position: relative;
    z-index: 1;
}
table{
            background: lightblue;
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
        button{
            background-color:lightgray;

            border: 1px solid black;

            color: black;

            padding: 15px 30px;

            text-align: center;

            text-decoration: none;
            height:60px;

            display: inline-block;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;
            border-radius: 5px;
        }
        #searchdirector{
            width:300px;
            height:50px;
            background-color:white;
            border: 2px solid black;
            border-radius:5px;

        }

         
     </style>
 </head>

 <body>
 <header id="main_header">
        <nav>

            
            <ul class="header_ul">
            <a id="logo" href="main.php"> Team10, MOVIE </a>
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
    <div class="center-button">
                
                <h1>감독이름 검색 </h1>
                <form action = "director.php" method="GET">
                <input id="searchdirector" type="textbox" name="director" placeholder="감독의 이름을 입력하세요">
                <button type="submit" value="검색하기">검색하기</button>

                
                </form></div>
                </mainContainer>
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
                if(isset($_GET['director'])){
                    $director=$_GET['director'];
                }else{
                    $director="7";
                }
            ?>        
        
        
            <?php
                // $sql ="SELECT * FROM director_table WHERE director LIKE '%$director%'";
                $sql ="SELECT di.d_id1, dt.director, dt.film1, dt.film2, dt.film3, da.award FROM 
                director_table AS dt 
                join director_id as di on dt.director=di.director
                join director_award as da on di.d_id1=da.d_id2 WHERE dt.director='$director'";//%$director%
    // 감독코드로 ㄱ검색해서 box_office 에서 감독 이름으로 group by..
                $result=mysqli_query($mysqli, $sql);      

                $list = '';

                if (mysqli_num_rows($result) == 0) {
                    $list = $list . "<tr><td colspan=\"5\">결과가 없습니다.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_array($result)) {

                        
                        $list = $list."<tr><td><a href='./detail.php?director=$director'>{$director}</a></td><td>{$row['film1']}</td><td>{$row['film2']}</td><td>{$row['film3']}</td><td>{$row['award']}</td></tr>";


                    }
                }
                echo $list;
                ?>
   

  
 </body>

 </html>