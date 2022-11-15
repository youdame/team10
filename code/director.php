 <!-- 김다희 Dahee Kim -->
 <!-- 감독 이름 검색 시 감독의 대표작 3개와 수상내역 보여줌, 그리고 제일 오른쪽에 수정버튼 만들어서 update사용하기// -->

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Director</title>
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
             display: grid;
             justify-content: center;
             align-items: center;
             padding: 0 30px;
             height: 800px;
             position: relative;
             z-index: 1;
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
     </style>
 </head>

 <body>
    <nav>
        <Container>
            <Logo><a href="main.php">Movie</a></Logo>
            <!-- <Button>
                <ButtonLink href="/"> Search</a></Button>
                <Button><ButtonLink href="/"> Director</a></Button>
                <Button><ButtonLink href="/"> My Page</a></Button> -->
        </Container>

        <ul>
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
                <li><a href="./sales_month_response.php"> sales</a></li>
            </Button>

            <?php
            session_start();
            if (isset($_SESSION['name'])) { ?>
                <Button>
                    <li><a href="./mypage.php"> My page</a></li>
                </Button>
                <Button>
                    <li><a href="./logout.php"> Log out</a></li>
                </Button>
            <?php
            } else { ?>
                <Button>
                    <li><a href="./login.php"> Login</a></li>
                </Button>
            <?php
            }
            ?>

      <form action = "director.php" method="GET">
                감독이름 검색: 
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
                <form action='director.php'>
                    <input type='button' value='감독정보 등록' onclick='location.href="newdirector.php"'/></form>
                <form action='director.php'>
                    <input type='button' value='감독정보 수정하기' onclick='location.href="modifydirector.php"'/></form>
                <form action='director.php'>
                    <input type='button' value='감독정보 삭제2' onclick='location.href="delete.php"'/></form>

    
        <?php
            session_start();
            $mysqli=mysqli_connect("localhost","team10","team10","team10","3307");
            if(isset($_GET['director'])){
                $director=$_GET['director'];
            }else{
                $director="7";
            }
        ?>        
      
     
        <?php
            // $sql ="SELECT * FROM director_table WHERE director LIKE '%$director%'";
            $sql ="SELECT di.d_id, dt.director, dt.film1, dt.film2, dt.film3, da.award FROM 
            director_table AS dt 
            join director_id as di on dt.director=di.director
            join director_award as da on di.d_id=da.d_id WHERE dt.director='$director'";//%$director%

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