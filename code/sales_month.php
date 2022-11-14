<!--이유림-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Statistics</title>
    <style>
        #sales_type_radio {
            border: 1px solid;
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
            width: 70%;
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
    <header style="text-align: center;margin:40px;font-size:30px">
        <p>Yearly Sales Statistics</p>
    </header>

    <div id="sales_type_radio" align="center">
        <form action="sales_month_response.php" method="POST">
            <label><input type="radio" name="type" value="sum_yearly_sales" checked><span>Sum of Yearly Sales</span></label>
            <label><input type="radio" name="type" value="Quarterly Comparison"><span>Quarterly Sales Average</span></label>
            <br><input style="margin:20px;width:100px" type="submit" value="OK">
        </form>
    </div>


</body>

</html>