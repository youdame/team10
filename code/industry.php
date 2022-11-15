<!--홍진서-->
<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $sql_select = "SELECT * FROM compare_data WHERE u_id = ?";

    $user_id = $_SESSION['id'];
    $stmt = $mysqli->prepare($sql_select);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result_main = $stmt->get_result();


    $sql_y = "SELECT year(reference_date) AS 'Year', country, sum(sales) as sum_sales, avg(sales) as avg_sales 
                FROM film_industry
                WHERE year(reference_date) > 1000
                GROUP BY year(reference_date), country WITH ROLLUP";

    //sum(sales) as sum_sales, avg(sales) as avg_sales 
    $sql_m = "SELECT month(reference_date) AS 'Month', country, sum(sales) as sum_sales, avg(sales) as avg_sales 
                FROM film_industry
                WHERE year(reference_date) = ?
                GROUP BY month(reference_date), country WITH ROLLUP";

    $sql_d = "SELECT day(reference_date) AS 'Day', country, sum(sales) as sum_sales, avg(sales) as avg_sales 
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
    <title>Document</title>

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
        body{
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

        /* table {
            padding: 10px;
        }

        th {
            background-color: lightslategray;
        }

        th,
        td {
            border: 1px solid grey;
            padding: 10px;
            border-collapse: collapse;
        } */
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

    <header style="text-align: center;margin:40px;font-size:30px">
        <p>Yearly Sales Statistics</p>
    </header>

    <div id="sales_type_radio" align="center">
        <form action="sales_month_response.php" method="POST">
            <label><input type="radio" name="type" value="sum_yearly_sales" />Sum of Yearly Sales</label>
            <label><input type="radio" name="type" value="Quarterly Comparison" />Quarterly Sales Average</label>
            <label><input type="radio" name="type" value="Film_industry_of_all_time" checked />Film industry of all time</label>
            <br><input style="margin:20px;width:100px" type="submit" value="OK">
        </form>
    </div>


    <div>
        <?php
            if(mysqli_num_rows($result_main)>0){ ?>
                <div>
                    <?php 
                    while($row = mysqli_fetch_array($result_main)){
                        $i_title = $row['input_title'];
                        $i_sales = $row['input_sales'];
                        $i_audience = $row['input_audience'];
                        
                        // 비교 데이터 삽입
                        $sql_1 = "INSERT INTO movie_profit VALUES ('temp', ?, ?)";
                        $stmt = $mysqli->prepare($sql_1);
                        $stmt->bind_param("ss", $i_sales, $i_audience);
                        $stmt->execute();

                        // 비교 데이터 퍼센트 알아내기
                        $sql_rank1 = "SELECT m_title, PERCENT_RANK() OVER (ORDER BY m_audience) AS audience_percent FROM movie_profit";
                        $sql_rank2 = "SELECT m_title, PERCENT_RANK() OVER (ORDER BY m_sales) AS sales_percent FROM movie_profit";

                        $result_rank1 = mysqli_query($mysqli, $sql_rank1);
                        $result_rank2 = mysqli_query($mysqli, $sql_rank2);
                        $audience_rank = 0;
                        $sales_rank = 0;


                        $row_rank1 = mysqli_fetch_array($result_rank1);
                        $title_temp = $row_rank1['m_title'];
                        $audience_rank = $row_rank1['audience_percent'] * 100;
                        while($title_temp != 'temp'){
                            $row_rank1 = mysqli_fetch_array($result_rank1);
                            $title_temp = $row_rank1['m_title'];
                            $audience_rank = $row_rank1['audience_percent'] * 100;
                        }

                        $row_rank2 = mysqli_fetch_array($result_rank2);
                        $title_temp = $row_rank2['m_title'];
                        $sales_rank = $row_rank2['sales_percent'] * 100;
                        $title_temp = $row_rank2['m_title'];
                        while($title_temp != 'temp'){
                            $row_rank2 = mysqli_fetch_array($result_rank2);
                            $title_temp = $row_rank2['m_title'];
                            $sales_rank = $row_rank2['sales_percent'] * 100;
                        }
                        
                        

                        // 화면에 출력
                        echo "{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) :<br>";   
                        echo "The sales of the movie are in the top {$sales_rank}%, and the audience is in the top {$audience_rank}% ";

                        // 비교 데이터 삭제
                        $sql_2 = "DELETE FROM movie_profit WHERE m_title = 'temp'";
                        mysqli_query($mysqli, $sql_2);
                    };
                    ?>
                    <button type="button" onclick="window.open('compare_modify.php', 'Modify compare data', 'width=600, height=400');">Modify</button>
                    <button type="button" onclick="location.href='compare_delete.php'">Delete</button>
                </div>
            <?php
            }else{ ?>
                <div>
                    Insert movie data!
                    <form action="compare_result.php" method="post">
                        Title <input type="textbox" name="input_title" required>
                        Sales <input type="textbox" name="input_sales" required>
                        Audience <input type="textbox" name="input_audience" required>
                        <input type="submit" value="Compare">
                    </form>
                </div>
            <?php
            }
        ?> 
    </div>

    <br><br><br>


    <table>
        <tr>
            <td style="vertical-align:top">
                <div id="table_year">
                    <form name="form_year">
                        <input type="hidden" name="yearOfData" />
                        <input type="hidden" name="monthOfData" />

                        <div id="table_year">

                            <input type="hidden" name="page" />
                            <?php
                            //년
                            $result = mysqli_query($mysqli, $sql_y);
                            $list_year = "<table><tr><td>Referencd Year</td><td>Country</td><td>Sum of Sales</td><td>Average of Sales</td></tr>";
                            //$list_year = "Referencd Yeay \tCountry \tSum of Sales \tAverage of Sales <br>";
                            while ($row = mysqli_fetch_array($result)) {
                                $y = $row['Year'];
                                $list_year = $list_year . "<tr>
                                                            <td onclick='javascript:updateMonth($y)'>{$row['Year']}</td>
                                                            <td>{$row['country']}</td>
                                                            <td>{$row['sum_sales']}</td>
                                                            <td>{$row['avg_sales']}</td>
                                                        </tr>";
                            }
                            $list_year = $list_year . "</table>";
                            echo $list_year;
                            ?>
                        </div>
                    </form>
                </div>
            </td>

            <td style="vertical-align:top">
                <div id="table_month">
                    <form name="form_month">
                        <input type="hidden" name="yearOfData" />
                        <input type="hidden" name="monthOfData" />

                        <?php
                        $stmt = $mysqli->prepare($sql_m);
                        $stmt->bind_param("i", $clicked_year);
                        $stmt->execute();
                        $result_m = $stmt->get_result();

                        $list_month = "<table><tr><td>Referencd Month</td><td>Country</td><td>Sum of Sales</td><td>Average of Sales</td></tr>";

                        while ($row_m = mysqli_fetch_array($result_m)) {
                            $m = $row_m['Month'];
                            $list_month = $list_month . "<tr>
                                                            <td onclick='javascript:updateDay($clicked_year, $m)'>{$row_m['Month']}</td>
                                                            <td>{$row_m['country']}</td>
                                                            <td>{$row_m['sum_sales']}</td>
                                                            <td>{$row_m['avg_sales']}</td>
                                                        </tr>";
                        }
                        $list_month = $list_month . "</table>";
                        echo "Referenced Date : $clicked_year 년";
                        echo $list_month;

                        ?>
                    </form>
                </div>
            </td>

            <td style="vertical-align:top">
                <div id="table_day">
                    <?php
                    $stmt_d = $mysqli->prepare($sql_d);
                    $stmt_d->bind_param("ii", $clicked_year, $clicked_month);
                    $stmt_d->execute();
                    $result_d = $stmt_d->get_result();

                    $list_day = "<table><tr><td>Referencd Day\t</td><td>Country\t</td><td>Sum of Sales\t</td><td>Average of Sales</td></tr>";

                    while ($row_d = mysqli_fetch_array($result_d)) {
                        $list_day = $list_day . "<tr><td>{$row_d['Day']}</td><td>{$row_d['country']}</td><td>{$row_d['sum_sales']}</td><td>{$row_d['avg_sales']}</td></tr> ";
                    }
                    $list_day = $list_day . "</table>";
                    echo "Referenced Date : $clicked_year 년 $clicked_month 월";
                    echo $list_day;
                    ?>
                </div>
            </td>

        </tr>
    </table>  

</body>

</html>