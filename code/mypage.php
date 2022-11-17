<!--이유림-->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        [type="submit"] {
            background-color: lightgray;
            border: 0px;
            padding: 8px;
            border-radius: 10px;
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

                    <li class="header_li">
                        <form action="filter.php" method="post">
                            <input type="hidden" name="country" value="Korea">
                            <input type="hidden" name="rate" value="5">
                            <input type="hidden" name="year" value="2020">
                            <input type="hidden" name="aud" value="all">
                            <input type="hidden" name="audMin" value="0">
                            <input type="hidden" name="audMax" value="20000000">
                            <input type="hidden" name="search_input" value="true">
                            <input type="submit" value="Filter" id="filter_submit">
                        </form>
                    </li>
                <?php
                } else { ?>
                    <li class="header_li"><a href="./login.php"> Login</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>

    <header style="text-align: center;margin:40px;font-size:30px">
        <p>MY PAGE</p>
    </header>


    <?php
    $nickname = $_SESSION['name'];
    $mysqli = mysqli_connect('localhost', 'team10', 'team10', 'team10');
    $sql = "SELECT u_id, pwd, preferred FROM user WHERE user.username = '$nickname'";
    $row = mysqli_fetch_array(mysqli_query($mysqli, $sql));
    $id = $row[0];
    $pwd = $row[1];
    $genre = $row[2];

    $sql2 = "SELECT user_info.usersex,user_info.userage from user_info 
            LEFT JOIN user ON user_info.u_id=user.u_id
            where user_info.u_id = '" . $_SESSION['id'] . "'";
    $user_info_row = mysqli_fetch_array(mysqli_query($mysqli, $sql2));
    $user_sex = $user_info_row[0];
    $user_age = $user_info_row[1];

    mysqli_close($mysqli);
    ?>
    <!--현재 회원 정보 -> 닉네임, 아이디, 선호 장르 -->
    <div id="user info" style="text-align: center;width:100%;">
        <p style="margin:auto;padding:7px;font-size:17px;width:200px;border-radius:10px;background-color:lightslategray">USER INFORMATION</p>

        <form action="mypage_genre_update.php" method="POST">
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>ID</p>
                <hr style="width:80%"><?= $id ?>
                <br>
            </div>
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>Nickname</p>
                <hr style="width:80%"><?= $nickname ?>
            </div>
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>Preferred Genre</p>
                <hr style="width:80%"><?= $genre ?>
            </div>
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>Age</p>
                <hr style="width:80%"><?= $user_age ?>'s
            </div>
            <div style="margin:10px;margin-bottom:40px">
                <input type="submit" value="Edit Preferred Genre">
            </div>
        </form>
    </div>

    <div align="center" style="border:1px solid grey;border-radius:10px;margin:150px;margin-top:10px">
        <p style="margin: 10px;margin-top:30px;padding:7px;font-size:17px;width:100px;border-radius:10px;background-color:lightslategray">LIKES</p>
        <?php
        //$nickname = '$_SESSION['name']';
        $nickname = $_SESSION['name'];
        $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");
        $sql = "SELECT poster, title
                FROM movie_boxoffice               
                LEFT JOIN user_like ON movie_boxoffice.m_id=user_like.m_id
                WHERE u_id = (SELECT user.u_id
                              FROM user
                              WHERE user.username='$nickname')";

        $res = mysqli_query($mysqli, $sql);

        while ($row = mysqli_fetch_array($res)) {
        ?>
            <div style="justify-content: center;display:inline-block;margin:10px">
                <form action="mypage_like_update.php">
                    <input type="image" src="<?= $row['poster'] ?>" width="130px">
                    <br><?= $row['title'] ?>
                </form>
            </div>
        <?php } ?>
        <div style="text-align:center">
            <div style="display:inline-block;">
                <form style="margin: 20px;" action="mypage_like_delete.php">
                    <input type="submit" value="DELETE">
                </form>
            </div>
            <div style="display:inline-block">
                <form style="margin: 20px;" action="mypage_like_insert_genre.php">
                    <input type="submit" value="ADD">
                </form>
            </div>
        </div>
    </div>
</body>



</html>