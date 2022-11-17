<!--홍진서-->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Team10 - login</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        #login_table {
            display: grid;
            justify-content: center;
            align-items: center;
            width: 30%;
            margin: auto;
            margin-top: 100px;
            padding: 60px;
            border-radius: 10px;
            border: 1px solid lightslategray;
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

    <div id="login_table">
        <form action="login_result.php" method="POST">
            <table>
                <tr>
                    <td>ID</td>
                    <td><input type='text' name='input_id' /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type='password' name='input_pw' /></td>
                </tr>
            </table>
            <input type="submit" value="log in">
        </form>
        <form action="signup.php">
            <input type="submit" value="sign up">
        </form>
    </div>
</body>



</html>