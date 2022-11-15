<!--이유림-->
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Statistics</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
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

        table {
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

    <header style="text-align: center;margin:40px;font-size:30px">
        <p>Yearly Sales Statistics</p>
    </header>

    <?php $selected = $_POST['type']; ?>
    <div id="sales_type_radio" align="center">
        <form action="sales_month_response.php" method="POST">
            <label><input type="radio" name="type" value="sum_yearly_sales" <?php if ($selected == 'sum_yearly_sales') { ?>checked="checked" <?php } ?> />Sum of Yearly Sales</label>
            <label><input type="radio" name="type" value="Quarterly Comparison" <?php if ($selected == 'Quarterly Comparison') { ?>checked="checked" <?php } ?> />Quarterly Sales Average</label>
            <label><input type="radio" name="type" value="Film_industry_of_all_time" <?php if ($selected == 'Film_industry_of_all_time') { ?>checked="checked" <?php } ?> />Film industry of all time</label>
            <br><input style="margin:20px;width:100px" type="submit" value="OK">
        </form>
    </div>

    <?php
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");
    if ($selected === 'sum_yearly_sales') { ?>
        <div align="center">
            <div style="display:inline-block;">
                <div align="center">
                    <p style="font-size: 17px;margin:20px;padding:7px;background-color:lightslategray;width:200px;border-radius:10px">
                        Yearly Sales Comparison
                    </p>
                </div>
                <div style="width:80%">
                    <?php
                    $sql = "SELECT movie_month_sales.year,country,format(sum(sales),0)
                        FROM movie_month_sales
                        GROUP BY movie_month_sales.year,country
                        ORDER BY movie_month_sales.year";
                    $res = mysqli_query($mysqli, $sql);

                    while ($row = mysqli_fetch_array($res)) { ?>
                        <table align="center" style="display: inline-block;">
                            <thead>
                                <tr>
                                    <th width=100>Year</th>
                                    <th width=100>country</th>
                                    <th width=200>sales</th>
                                </tr>
                            </thead>
                            <tbody align=" center">
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                </div>
            </div>
        </div>



    <?php }

    if ($selected === 'Quarterly Comparison') { ?>
        <div align="center">
            <div style="display:inline-block;">
                <div align="center">
                    <p style="font-size: 17px;margin:20px;padding:7px;background-color:lightslategray;width:200px;border-radius:10px">
                        First Quarter
                    </p>
                </div>
                <div>
                    <table align="center">
                        <thead>
                            <tr>
                                <th width=80>Year</th>
                                <th width=80>Total Sales</th>
                            </tr>
                        </thead>

                        <?php
                        $sql = "SELECT movie_month_sales.year,month,format(avg(sales),0)
                                    FROM movie_month_sales
                                    where month BETWEEN 1 AND 3
                                    GROUP BY movie_month_sales.year,country
                                    Having country='한국'";
                        $res = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_array($res)) { ?>
                            <tbody align="center">
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div style="display:inline-block;">
                <div align="center">
                    <p style="font-size: 17px;margin:20px;padding:7px;background-color:lightslategray;width:200px;border-radius:10px">
                        Second Quarter
                    </p>
                </div>
                <div>
                    <table align="center">
                        <thead>
                            <tr>
                                <th width=80>Year</th>
                                <th width=80>Total Sales</th>
                            </tr>
                        </thead>

                        <?php
                        $sql = "SELECT movie_month_sales.year,month,format(avg(sales),0)
                                    FROM movie_month_sales
                                    where month BETWEEN 4 AND 6
                                    GROUP BY movie_month_sales.year,country
                                    Having country='한국'";
                        $res = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_array($res)) { ?>
                            <tbody align="center">
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div style="display:inline-block;">
                <div align="center">
                    <p style="font-size: 17px;margin:20px;padding:7px;background-color:lightslategray;width:200px;border-radius:10px">
                        Third Quarter
                    </p>
                </div>
                <div>
                    <table align="center">
                        <thead>
                            <tr>
                                <th width=80>Year</th>
                                <th width=80>Total Sales</th>
                            </tr>
                        </thead>

                        <?php
                        $sql = "SELECT movie_month_sales.year,month,format(avg(sales),0)
                                    FROM movie_month_sales
                                    where month BETWEEN 7 AND 9
                                    GROUP BY movie_month_sales.year,country
                                    Having country='한국'";
                        $res = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_array($res)) { ?>
                            <tbody align="center">
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div style="display:inline-block;">
                <div align="center">
                    <p style="font-size: 17px;margin:20px;padding:7px;background-color:lightslategray;width:200px;border-radius:10px">
                        Fourth Quarter
                    </p>
                </div>
                <div>
                    <table align="center">
                        <thead>
                            <tr>
                                <th width=80>Year</th>
                                <th width=80>Total Sales</th>
                            </tr>
                        </thead>

                        <?php
                        $sql = "SELECT movie_month_sales.year,month,format(avg(sales),0)
                                    FROM movie_month_sales
                                    where month BETWEEN 10 AND 12
                                    GROUP BY movie_month_sales.year,country
                                    Having country='한국'";
                        $res = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_array($res)) { ?>
                            <tbody align="center">
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    <?php }

    // 홍진서 파트로 연결
    if ($selected === 'Film_industry_of_all_time') {
        //echo "<script>location.replace('industry.php')</script>";
        echo "<script>location.replace('industry.php?yearOfData=2022&monthOfData=11')</script>";
    }
    ?>


</body>

</html>