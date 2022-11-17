<!-- 김다희 dahee kim-->
<?php
session_start();
?>
<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Team10 : Movie</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <style>
   

        .backgroundImage{
            background-image: url('./movie1.jpg');
            width: 100%;
            height: 800px;
            background-size: 100% 100%;
            
            z-index:-1;

        }
        .mainContainer {
            
         
            display: grid;
            justify-content: center;
            align-items: center;
            /* padding: 0 30px; */
            height: 700px;
            position: relative;
            z-index: 10;
           
   
        }
     
   
        
        h1{
            color: white; font-size: 40px;text-align: center;
        }
        h2{
            color:white; text-align:center;
        }
        .center-button{
            text-align:center;
        }
        Button{
            background-color: lightgray;

            border: 1px solid black;

            color: black;

            height:50px;

            padding: 15px 30px;

            text-align: center;

            text-decoration: none;

            display: inline-block;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;
            border-radius: 5px;
        }
        #searchdata{
            
            width:300px;
            height:50px;
            background-color:white;
            border: 2px solid black;
            border-radius:5px;

        
        }
    </style>
</head>

<body>
   

    <header id="main_header">
   
        <nav>
            <ul class="header_ul">
            <a id="logo" href="main.php"> Team10, MOVIE </a>
            
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
    <div class="backgroundImage">

        <div class="mainContainer">
            <div>
                <?php if (isset($_SESSION['name'])) { ?>
                    <h1>Welcome, <?php echo $_SESSION['name']?></h1>
                <?php
                } else { ?>
                    <h1>EXPLORE MOVIE!</h1>
                    <h2>Please log in</h2>
                <?php
                }
                ?>
                <?php
                    if (isset($_SESSION['name'])) { ?>
                    <form action="keywordSearch.php" method="get">
                    <input id="searchdata" type="textbox" name="keyword" placeholder="영화 제목을 검색하세요" >
                    
                    <button type="submit" value="Search">검색</button>
                </form>
            
                <?php
                    } else { 
                        ?>
                    <div class="center-button">
                    <Button onclick="location.href='login.php'"> LOGIN</Button></div>
                    <?php
                    }
                    ?>
                </form>
                </div>
                <div>
            <p> Let's see which movie is interesting</p>
        </div>
    </div>

        
    
</body>

</html>