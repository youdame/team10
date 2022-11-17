    <!--조유담-->
    <?php
    session_start();
    $user_id = $_SESSION['id'];
    // $user = '도레미';

    $conn = mysqli_connect("localhost", "team10", "team10", "team10");

    $title = $_GET['m_title'];
    $sql = "SELECT * FROM movie_boxoffice WHERE title = '$title'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
 

    $id = $row['m_id'];

    $sql_d = "SELECT d_id FROM movie_boxoffice WHERE m_id = '$id'";
    $result_d = mysqli_query($conn, $sql_d);
    $row_d = mysqli_fetch_array($result_d);
    $d_id= $row_d['d_id'];


    $sql_director_name = "SELECT * FROM director_id WHERE d_id1 = '$d_id'";
    $result_director_name = mysqli_query($conn, $sql_director_name);
    $row_director_name = mysqli_fetch_array($result_director_name);

    $sql_r = "SELECT * FROM rating WHERE m_id = '$id'";
    $result_r = mysqli_query($conn, $sql_r);
    $row_r = mysqli_fetch_array($result_r);


    $sql_user_rating = "SELECT * FROM user_rating WHERE u_id = '$user_id' AND m_id = '$id'";
    $result_user_rating = mysqli_query($conn, $sql_user_rating);
    $row_user_rating = mysqli_fetch_array($result_user_rating);    
    

    ?>


    <!DOCTYPE html>
    <html>
    <head>
    <title><?php echo $_GET['m_title'];?></title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        * {
            box-sizing: border-box;
        } 

        body{
            /* background-color: #f0e8d9; */
            margin: 0;
            font-family: 'Roboto', sans-serif;
            
        } 

        img{
            width: 400px;
            height: 580px;  
        }


        /* 기사 본문 */
        .content {
            
            font-size: 18px;
            width: 70%;
            max-width: 900px;
            margin: 50px auto;
        }
        /* 코드잇 광고 */
        #codeit {
            float: left;
            /* margin-right: auto;
            margin-left: auto; */
            margin-right: 15px; 
            margin-bottom: 15px;
        
        }

        .content .title{
            font-size: 40px;
        }



        .content .text{
            font-size: 23px;
        }




        </style>
    </head>


    <body>
    <header id="main_header">
        <nav>
            <a id="logo" href="main.php"> Team10, MOVIE </a>
            
            <ul class="header_ul">
                <?php
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
                <?php
                } else { ?>
                    <li class="header_li"><a href="./login.php"> Login</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>
        
    <div class = content>
        <!-- 포스터  -->
        <div id = codeit>
            <img src="<?=$row['poster']?>">
        </div>
        <!-- 제목 -->
        <p class = "title">
            <?php echo $title;?>
        </p>

        <div class = text>
        <!-- 정보 -->
        <p> 장르 : <?php echo $row['genre'];?></p>
        <p> 국적 : <?php echo $row['country'];?> </p>
        <p> 개봉일 : <?php echo $row['released_date'];?> </p>
        <p> 매출액 : <?php echo number_format($row['sales']);?>원 </p>
        <p> 관객수 : <?php echo number_format($row['audience']);?>명</p>
        <p> 스크린 수: <?php echo number_format($row['screen_num']);?>개</p>
        <p> 감독: <?php echo $row_director_name['director'];?></p>
        <p> 배급사: <?php echo $row['distributor'];?></p>
        <p> 평점: <?php echo $row_r['rating'];?>점</p>
        


        <?php if($row_user_rating == 0){ ?>
            <form action = "ratingInput.php" method ="post">
                <input type= "hidden" name= "movie_id" value= "<?php echo $id;?>"/>
                <input type= "hidden" name= "movie_title" value= "<?php echo $title;?>"/>
                <!-- <input type="text" name= "user_id"> -->
                <select name = "num">
                    <option selected value= "">내 평점 등록하기</option>
                    <option value= "1">1점</option>
                    <option value= "2">2점</option>
                    <option value= "3">3점</option>
                    <option value="4">4점</option>
                    <option value="5">5점</option>
                    <option value="6">6점</option>
                    <option value="7">7점</option>
                    <option value="8">8점</option>
                    <option value="9">9점</option>
                    <option value="10">10점</option>
                </select>
                <input type = "submit" value= "등록">

            </form>
        <?php
        } else { ?>
            나의 평점 : <?php echo $row_user_rating['u_rating']?>점 
            <form action = "ratingInput_update_form.php" method = "post">
            <input type= "hidden" name= "movie_title" value= "<?php echo $title;?>"/>
            <input type= "hidden" name= "movie_id" value= "<?php echo $id;?>"/>  
            <input type = "submit" value = "Update my rating"> 
        </form>

            
            
            <form action = "ratingInput_delete.php" method = "post">
            <input type= "hidden" name= "movie_title" value= "<?php echo $title;?>"/>
            <input type= "hidden" name= "user_id" value= "<?php echo $user_id;?>"/>  
            <input type= "hidden" name= "movie_id" value= "<?php echo $id;?>"/>  
            <input type = "submit" value = "Delete my rating"> 

        </form>


        <?php }?>

    </div>

        </div>
</body>
</html>
