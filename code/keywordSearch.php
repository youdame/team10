<!--홍진서-->
<?php
session_start();
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

$keyword = $_GET['keyword']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <form action="keywordSearch.php" method="GET">
        <input type="textbox" name="keyword">
        <input type="submit" value="search">
    </form>

    <table>
        <tr>
            <td>Title</td>
            <td>Released date</td>
            <td>Number of audience</td>
            <td>Director</td>
            <td>Genre</td>
        </tr>

        <?php
        // 쿼리
        $sql = "SELECT * FROM movie_boxoffice WHERE title LIKE '%$keyword%' OR director LIKE '%$keyword%'";
        $result = mysqli_query($mysqli, $sql);
        $list = '';

        if (mysqli_num_rows($result) == 0) {
            $list = $list . "<tr><td colspan=\"6\">결과가 없습니다.</td></tr>";
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $m_title = $row['title'];
                $list = $list . "<tr><td><a href='./detail.php?title=$m_title'>{$m_title}</a></td><td>{$row['released_date']}</td><td>{$row['audience']}</td><td>{$row['director']}</td><td>{$row['genre']}</td></tr></br>";
            }
        }
        echo $list;

        ?>
</body>

</html>