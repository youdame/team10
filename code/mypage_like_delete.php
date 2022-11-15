<!--이유림-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
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

        [type="submit"] {
            background-color: lightgray;
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
        <p>DELETE LIST</p>
    </header>

    <div align="center" style="border:1px solid grey;border-radius:10px;width:70%;margin:auto;padding:20px">
        <p style="text-align:center;margin: 10px;margin-bottom:30px;padding:10px;font-size:17px;width:200px;border-radius:10px;background-color:lightslategrey">Select Movies to Delete</p>
        <?php
        if (!session_id()) {
            session_start();
        }
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
                <form action="mypage_like_delete_response.php" method="POST">
                    <input type="image" src="<?= $row['poster'] ?>" width="130px">
                    <br><input style="width:150px;" type="submit" name="movie_title" value="<?php echo $row['title'] ?>">
                </form>
            </div>
        <?php } ?>


    </div>
</body>

</html>