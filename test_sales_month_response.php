<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Statistics</title>
</head>

<html>

<body>
    <header style="text-align: center;margin:40px;font-size:30px">
        <p>Monthly Sales Statistics</p>
    </header>
    <hr width="80%">
    <?php $selected = $_POST['type']; ?>
    <div align="center" style="margin: 20px;padding:10px">
        <form action="sales_month_response.php">
            <label><input type="radio" name="type" value="sum_yearly_sales" <?php if ($selected == 'sum_yearly_sales') { ?>checked="checked" <?php } ?> />Sum of Yearly Sales</label>
            <label><input type="radio" name="type" value="avg_yearly_sales" <?php if ($selected == 'avg_yearly_sales') { ?>checked="checked" <?php } ?> />Avg of Yearly Sales</label>
            <label><input type="radio" name="type" value="avg_yearly_released" <?php if ($selected == 'avg_yearly_released') { ?>checked="checked" <?php } ?> />Average Number of Released Movies</label>
            <br><input style="margin:20px;width:100px" type="submit" value="OK">
        </form>
    </div>

    <hr width="80%">

    <?php
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    if ($selected === "sum_yearly_sales") { ?>

        <table>
            <thead>
                <tr align="center">
                    <th width=100>Year</th>
                    <th width=200>Korea Sales</th>
                    <th width=200>Overseas Sales</th>
                </tr>
            </thead>
            <?
            $sql = "SELECT *
            FROM movie_boxoffice WHERE movie_boxoffice.genre = '액션'";

            echo $selected;

            $res = mysqli_query($mysqli, $sql);

            while ($row = mysqli_fetch_array($res)) { ?>
                <tbody>
                    <tr align="center">
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[2] ?></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    <? } ?>


</body>

</html>