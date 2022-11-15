<!--조유담-->
<?php

$conn = mysqli_connect("localhost", "team10", "team10", "team10");

$title = $_GET['m_title'];
$sql = "SELECT * FROM movie_boxoffice WHERE title = '$title'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$id = $row['m_id'];

$sql_d = "SELECT * FROM director WHERE m_id = '$id'";
$result_d = mysqli_query($conn, $sql_d);
$row_d = mysqli_fetch_array($result_d);

$sql_r = "SELECT * FROM rating WHERE m_id = '$id'";
$result_r = mysqli_query($conn, $sql_r);
$row_r = mysqli_fetch_array($result_r);


?>


<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_GET['m_title']; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
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
            <Logo><a href="main.php">Movie</a></Logo>
            <!-- <Button>
                <ButtonLink href="/"> Search</a></Button>
                <Button><ButtonLink href="/"> Director</a></Button>
                <Button><ButtonLink href="/"> My Page</a></Button> -->
        </Container>

        <ul>
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
                <li><a href="./sales_month_response.php"> sales</a></li>
            </Button>

            <?php
            session_start();
            if (isset($_SESSION['name'])) { ?>
                <Button>
                    <li><a href="./mypage.php"> My page</a></li>
                </Button>
                <Button>
                    <li><a href="./logout.php"> Log out</a></li>
                </Button>
            <?php
            } else { ?>
                <Button>
                    <li><a href="./login.php"> Login</a></li>
                </Button>
            <?php
            }
            ?>
            
        </ul>
    </nav>

    <div class=content>
        <!-- 포스터  -->
        <div id=codeit>
            <img src="<?= $row['poster'] ?>">
        </div>
        <!-- 제목 -->
        <p class="title">
            <?php echo $title; ?>
        </p>

        <!-- 정보 -->
        <p> 장르 : <?php echo $row['genre']; ?></p>
        <p> 국적 : <?php echo $row['country']; ?> </p>
        <p> 개봉일 : <?php echo $row['released_date']; ?> </p>
        <p> 매출액 : <?php echo number_format($row['sales']); ?>원 </p>
        <p> 관객수 : <?php echo number_format($row['audience']); ?>명</p>
        <p> 스크린 수: <?php echo number_format($row['screen_num']); ?>개</p>
        <p> 감독: <?php echo $row_d['director']; ?></p>
        <p> 배급사: <?php echo $row_d['distributor']; ?></p>
        <p> 평점: <?php echo $row_r['rating']; ?></p>



        <form action="ratingInput.php" method="post">
            <input type="hidden" name="movie" value="<?php echo $id; ?>" />
            <input type="text" name="user_id">
            <select name="num">
                <option selected value="">내 평점 등록하기</option>
                <option value="1">1점</option>
                <option value="2">2점</option>
                <option value="3">3점</option>
                <option value="4">4점</option>
                <option value="5">5점</option>
                <option value="6">6점</option>
                <option value="7">7점</option>
                <option value="8">8점</option>
                <option value="9">9점</option>
                <option value="10">10점</option>
            </select>
            <input type="submit" value="등록">
        </form>







</body>

</html>