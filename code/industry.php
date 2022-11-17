<!--홍진서-->
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php
session_start();
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

$sql_select = "SELECT * FROM compare_data WHERE u_id = ?";

$user_id = $_SESSION['id'];
$stmt = $mysqli->prepare($sql_select);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result_main = $stmt->get_result();

$sql_y = "SELECT year(reference_date) AS 'Year', country, FORMAT(sum(attendance), 0) AS sum_attendance, FORMAT(avg(attendance), 0) AS avg_attendance
                FROM film_industry
                WHERE year(reference_date) > 1000
                GROUP BY year(reference_date), country WITH ROLLUP";

$sql_m = "SELECT month(reference_date) AS 'Month', country, FORMAT(sum(attendance), 0) AS sum_attendance, FORMAT(avg(attendance), 0) AS avg_attendance 
                FROM film_industry
                WHERE year(reference_date) = ?
                GROUP BY month(reference_date), country WITH ROLLUP";

$sql_d = "SELECT day(reference_date) AS 'Day', country, FORMAT(sum(attendance), 0) AS attendance, FORMAT(sum(sales), 0) AS sales
                FROM film_industry
                WHERE year(reference_date) = ? AND  month(reference_date) = ?
                GROUP BY day(reference_date), country WITH ROLLUP";

$clicked_year = $_GET['yearOfData'];
$clicked_month = $_GET['monthOfData'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Movie Industry Statistics</title>

    <script type="text/javascript">
        function updateMonth($yearOfData) {
            var mp = document.form_year;
            mp.yearOfData.value = $yearOfData;
            mp.action = "industry.php";
            mp.method = "get";
            mp.submit();
        }

        function updateDay($yearOfData, $monthOfData) {
            var dp = document.form_month;
            dp.yearOfData.value = $yearOfData;
            dp.monthOfData.value = $monthOfData;
            dp.action = "industry.php";
            dp.method = "get";
            dp.submit();
        }
    </script>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        body {
            background-color: white;
        }

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

        [type="radio"] {
            vertical-align: middle;
        }

        [type="submit"] {
            background-color: lightslategray;
            border: 0px;
            padding: 8px;
            border-radius: 10px;
        }

        #main_div {
            display: flex;
        }

        #main_table {
            width: 70%;
            margin: 0 auto;
        }

        #div_compare {
            text-align: left;
            font-weight: bold; 
            font-size: large;
        }

        .td_compare {
            text-align: center;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        td {
            vertical-align: top;
        }

        #div_table_month {
            margin-left: 30px;
            margin-right: 30px;
        }

        tr,
        td {
            padding: 5px;
        }

        #div_table_year {
            background-color: #C6C6C6;
        }

        #div_table_month {
            background-color: #D8D8D8;
        }

        #div_table_day {
            background-color: #EAEAEA;
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
        <p>Movie Industry Statistics</p>
    </header>

    <div id="sales_type_radio" align="center">
        <form action="sales_month_response.php" method="POST">
            <label><input type="radio" name="type" value="sum_yearly_sales" />Sum of Yearly Sales</label>
            <label><input type="radio" name="type" value="Quarterly Comparison" />Quarterly Sales Average</label>
            <label><input type="radio" name="type" value="Film_industry_of_all_time" checked />Film industry of all time</label>
            <br><input style="margin:20px;width:100px" type="submit" value="OK">
        </form>
    </div>


    <div id="main_div">
        <table id="main_table">
            <!-- 영화 데이터 비교 -->
            <tr>
                <td colspan='3' class="td_compare">
                    <div id="div_compare">
                        <?php
                        if (mysqli_num_rows($result_main) > 0) { ?>
                            <div>
                                <?php
                                while ($row = mysqli_fetch_array($result_main)) {
                                    $i_title = $row['input_title'];
                                    $i_sales = $row['input_sales'];
                                    $i_audience = $row['input_audience'];

                                    // 비교할 데이터 임시로 삽입
                                    $sql_1 = "INSERT INTO movie_profit VALUES ('temp', ?, ?)";
                                    $stmt = $mysqli->prepare($sql_1);
                                    $stmt->bind_param("ss", $i_sales, $i_audience);
                                    $stmt->execute();

                                    // 비교 데이터의 백분위 알아내기 (관객수, 수익)
                                    $sql_rank1 = "SELECT m_title, FORMAT(PERCENT_RANK() OVER (ORDER BY m_audience), 2) AS audience_percent FROM movie_profit";
                                    $sql_rank2 = "SELECT m_title, FORMAT(PERCENT_RANK() OVER (ORDER BY m_sales), 2) AS sales_percent FROM movie_profit WHERE m_sales != 0";

                                    $result_rank1 = mysqli_query($mysqli, $sql_rank1);
                                    $result_rank2 = mysqli_query($mysqli, $sql_rank2);
                                    $audience_rank = 0;
                                    $sales_rank = 0;

                                    do {
                                        $row_rank1 = mysqli_fetch_array($result_rank1);
                                        $title_temp = $row_rank1['m_title'];
                                        $audience_rank = 100 - $row_rank1['audience_percent'] * 100;
                                    } while ($title_temp != 'temp');

                                    do {
                                        $row_rank2 = mysqli_fetch_array($result_rank2);
                                        $title_temp = $row_rank2['m_title'];
                                        $sales_rank = 100 - $row_rank2['sales_percent'] * 100;
                                    } while ($title_temp != 'temp');

                                    // 화면에 출력
                                    echo "<p>{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) :<br><br>";
                                    echo "The sales of the movie are in the top {$sales_rank}%, and the audience is in the top {$audience_rank}% ";

                                    // 비교 데이터 삭제
                                    $sql_2 = "DELETE FROM movie_profit WHERE m_title = 'temp'";
                                    mysqli_query($mysqli, $sql_2);
                                };
                                ?>
                                <button type="button" onclick="window.open('compare_modify.php', 'Modify compare data', 'width=600, height=400');">Modify</button>
                                <button type="button" onclick="location.href='compare_delete.php'">Delete</button></p>
                            </div>
                        <?php
                        } else { ?>
                            <div>
                                Insert movie data! <br><br>
                                <form action="compare_result.php" method="post">
                                    Title <input type="textbox" name="input_title" required>&nbsp&nbsp&nbsp&nbsp
                                    Sales <input type="textbox" name="input_sales" required>&nbsp&nbsp&nbsp&nbsp
                                    Audience <input type="textbox" name="input_audience" required>&nbsp&nbsp&nbsp&nbsp
                                    <input type="submit" value="Compare">
                                </form>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </td>

            </tr>

            <!-- 영화 산업 규모 비교 -->
            <tr>
                <td>
                    <div id="div_table_year" class="upper_table">
                        <form name="form_year">
                            <input type="hidden" name="yearOfData" />
                            <input type="hidden" name="monthOfData" />

                            <div id="table_year">

                                <input type="hidden" name="page" />
                                <?php
                                //년
                                $result = mysqli_query($mysqli, $sql_y);
                                $list_year = "<table id='table_year'>
                                                <tr style='text-align:center;'>
                                                    <td><b>Year</b></td>
                                                    <td><b>Country</b></td>
                                                    <td><b>Sum of Attendance</b></td>
                                                    <td><b>Avg of Attendance</b></td>
                                                </tr>";
                                while ($row = mysqli_fetch_array($result)) {
                                    $y = $row['Year'];
                                    if($row['country']==""){ 
                                        $country_value = "<b><i>TOTAL</i></b>";
                                    }else{
                                        $country_value = $row['country'];
                                    }
                                    if($row['Year']==""){ 
                                        $y = "<b><i>TOTAL</i></b>";
                                    }
                                    $list_year = $list_year."<tr>
                                                                <td onclick='javascript:updateMonth($y)'>$y</td>
                                                                <td>$country_value</td>
                                                                <td style='text-align:right;'>{$row['sum_attendance']}</td>
                                                                <td style='text-align:right;'>{$row['avg_attendance']}</td>
                                                            </tr>";
                                    }
                                $list_year = $list_year . "</table>";
                                echo "<br>";
                                echo $list_year;
                                ?>
                            </div>
                        </form>
                    </div>
                </td>

                <td>
                    <div id="div_table_month" class="upper_table">
                        <form name="form_month">
                            <input type="hidden" name="yearOfData" />
                            <input type="hidden" name="monthOfData" />

                            <?php
                            //월
                            $stmt = $mysqli->prepare($sql_m);
                            $stmt->bind_param("i", $clicked_year);
                            $stmt->execute();
                            $result_m = $stmt->get_result();

                            $list_month = "<table id='table_month'>
                                                <tr style='text-align:center;'>
                                                    <td><b>Month</b></td>
                                                    <td><b>Country</b></td>
                                                    <td><b>Sum of Attendance</b></td>
                                                    <td><b>Avg of Attendance</b></td>
                                                </tr>";

                            while ($row_m = mysqli_fetch_array($result_m)) {
                                $m = $row_m['Month'];
                                if($row_m['country']==""){ 
                                    $country_value = "<b><i>TOTAL</i></b>";
                                }else{
                                    $country_value = $row_m['country'];
                                }
                                if($row_m['Month']==""){ $m = "<b><i>TOTAL</i></b>"; }
                                $list_month = $list_month . "<tr>
                                                            <td onclick='javascript:updateDay($clicked_year, $m)'>$m</td>
                                                            <td>$country_value</td>
                                                            <td style='text-align:right;'>{$row_m['sum_attendance']}</td>
                                                            <td style='text-align:right;'>{$row_m['avg_attendance']}</td>
                                                        </tr>";
                            }
                            $list_month = $list_month . "</table>";
                            echo "Referenced Date : $clicked_year 년";
                            echo $list_month;

                            ?>
                        </form>
                    </div>
                </td>

                <td>
                    <div id="div_table_day" class="upper_table">
                        <?php
                        //일
                        $stmt_d = $mysqli->prepare($sql_d);
                        $stmt_d->bind_param("ii", $clicked_year, $clicked_month);
                        $stmt_d->execute();
                        $result_d = $stmt_d->get_result();

                        $list_day = "<table id='table_day'>
                                        <tr style='text-align:center;'>
                                            <td><b>Day</b></td>
                                            <td><b>Country</b></td>
                                            <td><b>Number of Attendance</b></td>
                                            <td><b>Sales</b></td>
                                        </tr>";

                        while ($row_d = mysqli_fetch_array($result_d)) {
                            if($row_d['country']==""){ 
                                $country_value = "<b><i>TOTAL</i></b>";
                            }else{
                                $country_value = $row_d['country'];
                            }
                            if($row_d['Day']==""){ $d = "<b><i>TOTAL</i></b>"; }
                            else { $d = $row_d['Day']; }
                            $list_day = $list_day . "<tr>
                                                        <td>$d</td>
                                                        <td>$country_value</td>
                                                        <td style='text-align:right;'>{$row_d['attendance']}</td>
                                                        <td style='text-align:right;'>{$row_d['sales']}</td>
                                                    </tr> ";
                        }
                        $list_day = $list_day . "</table>";
                        echo "Referenced Date : $clicked_year 년 $clicked_month 월";
                        echo $list_day;
                        ?>
                    </div>
                </td>
            </tr>
        </table>
        <div>

</body>

</html>