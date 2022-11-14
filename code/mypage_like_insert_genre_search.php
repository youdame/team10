<!--이유림-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENRE</title>
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

        #genre_type_radio {
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
    <nav>
        <Container>
            <Logo>Movie</Logo>
            <!-- <Button>
                <ButtonLink href="/"> Search</a></Button>
                <Button><ButtonLink href="/"> Director</a></Button>
                <Button><ButtonLink href="/"> My Page</a></Button> -->
        </Container>
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
    <header style="text-align: center;margin:40px;font-size:30px">
        <p>ADD LIST</p>
    </header>
    <?php $selected = $_POST['genre']; ?>
    <div id="genre_type_radio" style="text-align: center;">
        <form action="mypage_like_insert_genre_search.php" method="POST">
            <label><input type="radio" name="genre" value="액션" <?php if ($selected == '액션') { ?>checked="checked" <?php } ?> />Action</label>
            <label><input type="radio" name="genre" value="SF" <?php if ($selected == 'sf') { ?>checked="checked" <?php } ?> />SF</label>
            <label><input type="radio" name="genre" value="드라마" <?php if ($selected == '드라마') { ?>checked="checked" <?php } ?> />Drama</label>
            <label><input type="radio" name="genre" value="스릴러" <?php if ($selected == '스릴러') { ?>checked="checked" <?php } ?> />Thriller</label>
            <label><input type="radio" name="genre" value="코미디" <?php if ($selected == '코미디') { ?>checked="checked" <?php } ?> />Comedy</label>
            <label><input type="radio" name="genre" value="로맨스" <?php if ($selected == '로맨스') { ?>checked="checked" <?php } ?> />Romance</label>
            <label><input type="radio" name="genre" value="애니메이션" <?php if ($selected == '애니메이션') { ?>checked="checked" <?php } ?> />Animation</label><br>
            <label><input style="margin: 20px;" type="submit" name="submit" value="SEARCH">
        </form>
    </div>


    <div>
        <p style="font-size: 25px;text-align:center;margin-top:30px;padding-bottom:5px">Result</p>
        <table align="center">
            <thead>
                <tr>
                    <th id="audience_table_th" width=200></th>
                    <th id="audience_table_th" width=100></th>
                    <th id="audience_table_th" width=100></th>
                </tr>
            </thead>
        </table>
    </div>

    <?php
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");
    $post_genre = $_POST['genre']; ?>

    <div align="Center">
        <?php
        $sql = "SELECT poster,title, released_date, genre
                    FROM movie_boxoffice WHERE movie_boxoffice.genre = '$post_genre'";
        $res = mysqli_query($mysqli, $sql);

        while ($row = mysqli_fetch_array($res)) {
        ?>
            <div style="display:inline-block;margin:20px;text-align:center">
                <form action="mypage_like_insert.php" method="POST">
                    <input type="image" src="<?= $row['poster'] ?>" name="movie_title" width="150px">
                    <br><input style="width:150px;" type="submit" name="movie_title" value="<?php echo $row['title'] ?>">
                </form>
            </div>
        <?php } ?>
    </div>

</body>

</html>