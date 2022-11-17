<!--홍진서-->
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php
session_cache_limiter('private');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign up</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        #signup_table {
            margin: auto;
            margin-top: 100px;
            display: flex;
            justify-content: center;
            width: 50%;
            background-color: #5F9EA0;
            border-radius: 10px;
            padding: 20px;
        }

        table{
            text-align: left;
        }
        
        table,
        td,
        th {
            border-collapse: collapse;
        }

        form {
            text-align: center;
            margin: 10px;
            accent-color: #2F4F4F;
        }

        td {
            height: 40px;
            padding-bottom: 10px;
        }

        .need_padding{
            padding-left: 20px;
        }

        [type="submit"] {
            background-color: white;
            margin-top: 40px;
            border: 0px;
            padding: 8px;
            border-radius: 10px;
        }

        [type="text"] {
            border: 1px solid white;
            width: 250px;
            height: 25px;
            border-radius: 5px;
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

    <div id="signup_table">
        <form action="./signup_result.php" method="POST">
            <table id="main_table">
                <tr>
                    <td id="type_label">ID</td>
                    <td class="need_padding"><input type='text' name='enter_id' required /></td>
                </tr>
                <tr>
                    <td id="type_label">Password</td>
                    <td class="need_padding"><input type='text' name='enter_pw' required /></td>
                </tr>
                <tr>
                    <td id="type_label">Name</td>
                    <td class="need_padding"><input type='text' name='enter_name' required /></td>
                </tr>
                <tr>
                    <td id="type_label">Gender</td>
                    <td class="need_padding">
                        <input type='radio' name='gender' value='f' checked/>female
                        <input type='radio' name='gender' value='m' />male
                    </td>
                </tr>
                <<tr>
                    <td>Age</td>
                    <td class="need_padding">
                            <input type='radio' name='age' value='10' />10's
                            <input type='radio' name='age' value='20' checked/>20's
                            <input type='radio' name='age' value='30' />30's
                            <input type='radio' name='age' value='40' />40's
                            <br><input type='radio' name='age' value='50' />50's
                            <input type='radio' name='age' value='60' />60's
                            <input type='radio' name='age' value='70' />over 70's
                    </td>
                </tr>
                <tr>
                    <td>Preferred<br>Category</td>
                    <td class="need_padding">
                        <input type='radio' name='genre' value='action' />action
                        <input type='radio' name='genre' value='comedy' />comedy
                        <input type='radio' name='genre' value='drama' />drama
                        <input type='radio' name='genre' value='animation' />animation </br>
                        <input type='radio' name='genre' value='SF' />SF
                        <input type='radio' name='genre' value='thriller' />thriller
                        <input type='radio' name='genre' value='none' checked />none
                    </td>
                </tr>

            </table>
            <input type="submit" value="Sign up">
        </form>
    </div>
</body>

</html>