<!-- 김다희 dahee kim-->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Team10 : Movie</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <style>
        .mainContainer {
            background: white;
            display: grid;
            justify-content: center;
            align-items: center;
            /* padding: 0 30px; */
            height: 800px;
            position: relative;
            z-index: 1;
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
                    <li class="header_li"><a href="./sales_month.php"> sales</a></li>
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
                        <input type="submit" value="filter" id="filter_submit">
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
    
    <div class="mainContainer">
        <div>
            <?php if (isset($_SESSION['name'])) { ?>
                <h1>Welcome, <?php echo $_SESSION['name']?></h1>
            <?php
            } else { ?>
                <h1>Welcome to our page!</h1>
                <h2>Please log in</h2>
            <?php
            }
            ?>
            
            <form action="keywordSearch.php" method="get">
                <input type="textbox" name="keyword">
                <input type="submit" value="Search">
            </form>
        </div>

        <div>
            <p> Let's see which movie is interesting</p>
        </div>
    </div>
</body>

</html>