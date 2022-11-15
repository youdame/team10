<!-- 김다희 dahee kim-->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Team10</title>

<style>
Logo{
    color: black;
    cursor: pointer;
    font-size: 2.7vw;
    display: flex;
    align-items: center;
    font-weight: bold;
    text-decoration: none;
    height: 4.16vw;
}
ButtonLink{
    display: flex;
    justify-content: end;

  }
nav{
    background-color: lightblue;
    width: 100%;
    height: 4.16vw;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    position: sticky;
    top: 0;
    z-index: 5;
  }
Container{
    display: inline;
    justify-content: space-between;
    height: 4.16vw;
    z-index: 1;
    width: 74vw;
    max-width: 1100px;

}
mainContainer{
    background: white;
    display: grid;
    justify-content: center;
    align-items: center;
    padding: 0 30px;
    height: 800px;
    position: relative;
    z-index: 1;
}
Button{
    display: inline;
    justify-content: end;

}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
}
</style>

</head>

<body>
    <!--네비게이션 바-->
    <nav>
        <Container>
            <Logo><a href="main.php">Movie</a></Logo>
        </Container>

        <ul>
            <?php
            if (isset($_SESSION['name'])) { ?>
                <Button>
                    <li><a href="./genre.php"> Genre</a></li>
                </Button>
                <Button>
                    <li><a href="./dash.php">DashBoard</a></li>
                </Button>
                <Button>
                    <li><a href="./director.php"> Director</a></li>
                </Button>
                <Button>
                    <li><a href="./sales_month_response.php"> sales</a></li>
                </Button>
                <form action="filter.php" method="post">
                    <input type="hidden" name="country" value="Korea">
                    <input type="hidden" name="rate" value="5">
                    <input type="hidden" name="year" value="2020">
                    <input type="hidden" name="aud" value="all">
                    <input type="hidden" name="audMin" value="0">
                    <input type="hidden" name="audMax" value="20000000">
                    <input type="hidden" name="search_input" value="true">
                    <li><input type="submit" value="filter"></li>
                </form>
                <Button>
                    <li><a href="./mypage.php"> My page</a></li>
                </Button>
                <Button>
                    <li><a href="./logout.php"> Log out</a></li>
                </Button>
            <?php
            } else { ?>
                <Button>
                    <li><a href="./login.php"> Login</a></li>
                </Button>
            <?php
            }
            ?>

        </ul>
    </nav>

    <mainContainer>

        <div>
            <h1>welcome to our page</h1>
            <form action="keywordSearch.php" method="get">
                <input type="textbox" name="keyword">
                <input type="submit" value="Search">
            </form>
        </div>

        <div>
            <p> Let's see which movie is interesting</p>
        </div>
    </mainContainer>
</body>

</html>