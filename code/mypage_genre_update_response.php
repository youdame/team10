<!--이유림-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
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
        <p>MY PAGE</p>
    </header>



    <?php
    if (!session_id()) {
        session_start();
    }

    $prevPage = "mypage.php";
    $mysqli = mysqli_connect('localhost', 'team10', 'team10', 'team10');
    if (mysqli_connect_errno()) {
        echo 'Failed to connect to My SQL';
    }

    mysqli_begin_transaction($mysqli);

    try {
        //$sql1 = "SELECT id, preferred FROM user WHERE user.username = '$_SESSION['name']";
        $user_info = "SELECT u_id, preferred FROM user WHERE user.username = '" . $_SESSION['name'] . "'";
        $row = mysqli_fetch_array(mysqli_query($mysqli, $user_info));
        $id = $row[0];
        $genre = $row[1];

        $genre_update = "UPDATE user SET preferred='" . $_POST['genre'] . "' WHERE user.u_id= '" . $_SESSION['id'] . "'";
        $res = mysqli_query($mysqli, $genre_update);

        mysqli_commit($mysqli);
        echo 'commit';
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($mysqli);
        echo 'rollback';
    }

    mysqli_commit($mysqli);

    Header('location:' . $prevPage);

    ?>



</body>
<footer align="center" style="position : absolute;bottom : 0;margin:20px auto; text-align:center;">
    <p></p>
</footer>


</html>