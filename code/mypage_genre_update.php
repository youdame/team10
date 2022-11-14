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