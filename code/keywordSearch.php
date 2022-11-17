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
    <style>

        #main_div{ display: flex; }
        #div_search{
            padding-top: 30px;
            width:100%;
            text-align: center;
        }

        #textbox_search{
            margin-left:auto; 
            margin-right:auto;

            width:50%;
            height:35px;
            font-size:25px;
        }

        table{
            padding: 10px;
            margin-left:auto; 
            margin-right:auto;
            margin-top: 30px;
            margin-bottom: 30px;

            border-collapse: separate;
            border-spacing: 0 10px;

            border-top: 1px solid #bcbcbc;
            border-bottom: 1px solid #bcbcbc;
        }

        table td{
            padding-left: 50px;
            padding-right: 50px;
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

    
    <div id="div_search">
        <form action="keywordSearch.php" method="GET">
            <input id="textbox_search" type="textbox" name="keyword" placeholder="Please enter your keyword here">
            <input type="submit" value="search">
        </form>
    </div>

    <div id="main_div">
    <table>
        <tr>
            <td><b>Title</b></td>
            <td><b>Released date</b></td>
            <td><b>Number of audience</b></td>
            <td><b>Director</b></td>
            <td><b>Genre</b></td>
        </tr>

        <?php
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
        $list = $list."</table>";
        echo $list;
        ?>
    </div>
</body>

</html>