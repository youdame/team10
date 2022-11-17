<!--이유림-->
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENRE</title>

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
            <?php $selected = $_POST['genre']; ?>
            <label><input type="radio" name="genre" value="액션" <?php if ($selected == '액션') { ?>checked="checked" <?php } ?> />Action</label>
            <label><input type="radio" name="genre" value="SF" <?php if ($selected == 'sf') { ?>checked="checked" <?php } ?> />SF</label>
            <label><input type="radio" name="genre" value="드라마" <?php if ($selected == '드라마') { ?>checked="checked" <?php } ?> />Drama</label>
            <label><input type="radio" name="genre" value="스릴러" <?php if ($selected == '스릴러') { ?>checked="checked" <?php } ?> />Thriller</label>
            <label><input type="radio" name="genre" value="코미디" <?php if ($selected == '코미디') { ?>checked="checked" <?php } ?> />Comedy</label>
            <label><input type="radio" name="genre" value="애니메이션" <?php if ($selected == '애니메이션') { ?>checked="checked" <?php } ?> />Animation</label><br>
            <label><input style="margin: 20px;" type="submit" name="submit" value="SEARCH">
        </form>
    </div>


    <div>
        <p style="font-size: 25px;text-align:center;margin:30px">Result</p>
        <table align="center">
            <thead>
                <tr>
                    <th width=200></th>
                    <th width=100></th>
                    <th width=100></th>
                </tr>
            </thead>
            <div align="center" style="padding-left:100px;padding-right:100px">
                <?php
                $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");
                $post_genre = $_POST['genre']; ?> <p style="text-align: center;"><?php echo $post_genre ?></p>

                <?php
                $sql = "SELECT poster,title, released_date, genre
                    FROM movie_boxoffice WHERE movie_boxoffice.genre = '$post_genre'";

                $res = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($res)) {
                ?>
                    <div style="display:inline-block;margin:20px;text-align:center;">
                        <form action="mypage_like_insert.php">
                            <input type="image" src="<?= $row['poster'] ?>" width="150px">
                            <p><?php echo $row['title'] ?></p>
                        </form>
                    </div>

                <?php } ?>
            </div>
        </table>
    </div>
</body>

</html>