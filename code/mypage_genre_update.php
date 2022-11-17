<!--이유림-->
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
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


    <header style="text-align: center;margin:40px;font-size:30px">
        <p>MY PAGE</p>
    </header>
    <div>
        <form style="text-align:center" action="mypage_genre_update_response.php" method="POST">
            <p style="text-align: center;margin:20px;font-size:20px">Update Preferred Genre</p>
            <label><input type="radio" name="genre" value="액션">Action</label>
            <label><input type="radio" name="genre" value="SF">SF</label>
            <label><input type="radio" name="genre" value="드라마">Drama</label>
            <label><input type="radio" name="genre" value="스릴러">Thriller</label>
            <label><input type="radio" name="genre" value="코미디">Comedy</label>
            <label><input type="radio" name="genre" value="로맨스">Romance</label>
            <label><input type="radio" name="genre" value="애니메이션">Animation</label>
            <br>
            <div style="display: inline-block;">
                <label><input style="margin:30px" type="submit" name="submit" value="OK">
            </div>
            <hr width="80%">
        </form>

    </div>
</body>

</html>