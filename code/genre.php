<!--이유림-->
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        #sales_type_radio {
            border: 1px solid grey;
            width: 60%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        label {
            font-size: 15px;
            line-height: 2rem;
            padding: 0.2em 0.4em;
        }

        span {
            vertical-align: middle;
        }

        [type="radio"] {
            vertical-align: middle;
        }

        [type="submit"] {
            background-color: lightslategray;
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
        <p>Search By GENRE</p>
    </header>

    <div id="sales_type_radio" align="center">
        <form action="genre_response.php" method="POST">
            <label><input type="radio" name="genre" value="액션"><span>Action</span></label>
            <label><input type="radio" name="genre" value="SF"><span>SF</span></label>
            <label><input type="radio" name="genre" value="드라마"><span>Drama</span></label>
            <label><input type="radio" name="genre" value="스릴러"><span>Thriller</span></label>
            <label><input type="radio" name="genre" value="코미디"><span>Comedy</span></label>
            <label><input type="radio" name="genre" value="애니메이션"><span>Animation</span></label><br>
            <label><input style="margin: 20px;" type="submit" name="submit" value="SEARCH">
        </form>
    </div>
</body>
<footer align="center" style="position : absolute;bottom : 0;margin:20px auto; text-align:center;">
    <p></p>
</footer>

</html>