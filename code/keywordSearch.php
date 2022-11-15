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
        // 쿼리 수정 필요
        $sql = "SELECT * 
                FROM movie_boxoffice 
                    LEFT JOIN director_id
                    ON movie_boxoffice.d_id = director_id.d_id
                WHERE title LIKE '%$keyword%' OR director LIKE '%$keyword%'";
        $result = mysqli_query($mysqli, $sql);
        $list = '';

        if (mysqli_num_rows($result) == 0) {
            $list = $list . "<tr><td colspan=\"6\">결과가 없습니다.</td></tr>";
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $m_title = $row['title'];
                $list = $list . "<tr>
                                    <td><a href='./detail2.php?m_title=$m_title'>{$m_title}</a></td>
                                    <td>{$row['released_date']}</td>
                                    <td>{$row['audience']}</td>
                                    <td>{$row['director']}</td>
                                    <td>{$row['genre']}</td>
                                </tr>";
            }
        }
        echo $list;

        ?>
</body>

</html>