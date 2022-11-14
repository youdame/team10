<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $sql = "SELECT year(reference_date) AS 'Year', country, sum(sales) as sum_sales, avg(sales) as avg_sales 
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

    $clicked_year = $_POST['yearOfData'];
    $clicked_month = $_POST['monthOfData'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

    <script type="text/javascript">

        function updateMonth($yearOfData){
            var mp = document.form_year;
            mp.yearOfData.value = $yearOfData;
            mp.action = "industry.php";
            mp.method = "post";
            mp.submit();
        }

        function updateDay($yearOfData, $monthOfData){
            var dp = document.form_month;
            dp.yearOfData.value = $yearOfData;
            dp.monthOfData.value = $monthOfData;
            dp.action = "industry.php";
            dp.method = "post";
            dp.submit();
        }
    </script>
</head>

<body>
    <div>
        <form name="form_year">
            <input type="hidden" name="yearOfData"/>
            <input type="hidden" name="monthOfData"/>

            <div id="table_year">
                
                <input type="hidden" name="page"/>
                <?php
                //년
                $result = mysqli_query($mysqli, $sql);
                $list_year = "<table><tr><td>Referencd Year</td><td>Country</td><td>Sum of Sales</td><td>Average of Sales</td></tr>";
                //$list_year = "Referencd Yeay \tCountry \tSum of Sales \tAverage of Sales <br>";
                while($row = mysqli_fetch_array($result)){
                    $y = $row['Year'];
                    $list_year = $list_year."<tr>
                                                <td onclick='javascript:updateMonth($y)'>{$row['Year']}</td>
                                                <td>{$row['country']}</td>
                                                <td>{$row['sum_sales']}</td>
                                                <td>{$row['avg_sales']}</td>
                                            </tr>";
                    //$list_year = "<a href='javascript:updateMonth($y)'>${list_year} ".$row['Year']." ".$row['country']." ".$row['sum_sales']." ".$row['avg_sales']."</a><br>";
                }
                $list_year = $list_year."</table>";
                echo $list_year;
                ?>
            </div>
        </form>
    </div>

    

    <div id="table_month">
        <form name="form_month">
            <input type="hidden" name="yearOfData"/>
            <input type="hidden" name="monthOfData"/>

            <?php
            $stmt = $mysqli->prepare($sql_m);
            $stmt->bind_param("i", $clicked_year);
            $stmt->execute();
            $result_m = $stmt->get_result();

            $list_month = "<table><tr><td>Referencd Month</td><td>Country</td><td>Sum of Sales</td><td>Average of Sales</td></tr>";

            while($row_m = mysqli_fetch_array($result_m)){
                $m = $row_m['Month'];
                $list_month = $list_month."<tr>
                                                <td onclick='javascript:updateDay($clicked_year, $m)'>{$row_m['Month']}</td>
                                                <td>{$row_m['country']}</td>
                                                <td>{$row_m['sum_sales']}</td>
                                                <td>{$row_m['avg_sales']}</td>
                                            </tr>";     
            }
            $list_month = $list_month."</table>";
            echo "Referenced Date : $clicked_year 년";
            echo $list_month;

            ?>
        </form>
    </div>

    <div id="table_day">
        <?php
        $stmt_d = $mysqli->prepare($sql_d);
        $stmt_d->bind_param("ii", $clicked_year, $clicked_month);
        $stmt_d->execute();
        $result_d = $stmt_d->get_result();

        $list_day = "<table><tr><td>Referencd Day\t</td><td>Country\t</td><td>Sum of Sales\t</td><td>Average of Sales</td></tr>";

        while($row_d = mysqli_fetch_array($result_d)){
            $list_day = $list_day."<tr><td>{$row_d['Day']}</td><td>{$row_d['country']}</td><td>{$row_d['sum_sales']}</td><td>{$row_d['avg_sales']}</td></tr> ";
        }
        $list_day = $list_day."</table>";
        echo "Referenced Date : $clicked_year 년 $clicked_month 월";
        echo $list_day;
        ?>
    </div>

</body>
</html>