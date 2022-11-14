<!--홍진서-->
<?php
session_start();
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

$sql_select = "SELECT * FROM compare_data WHERE u_id = ?";

//$sql_update = "UPDATE ";
//$sql_delete = "DELETE ";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript">
        function update_compare($title) {

        }

        function delete_compare($title) {

        }
    </script>
    <style>
        Logo {
            color: black;
            cursor: pointer;
            font-size: 2.7vw;
            display: flex;
            align-items: center;
            font-weight: bold;
            text-decoration: none;
            height: 4.16vw;
        }

        ButtonLink {
            display: flex;
            justify-content: end;

        }

        nav {
            background-color: lightblue;
            width: 100%;
            height: 4.16vw;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        Container {
            display: inline;
            justify-content: space-between;
            height: 4.16vw;
            z-index: 1;
            width: 74vw;
            max-width: 1100px;

        }

        mainContainer {
            background: white;
            display: grid;
            justify-content: center;
            align-items: center;
            padding: 0 30px;
            height: 800px;
            position: relative;
            z-index: 1;
        }

        Button {
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
    <nav>
        <Container>
            <Logo>Movie</Logo>
            <!-- <Button>
                <ButtonLink href="/"> Search</a></Button>
                <Button><ButtonLink href="/"> Director</a></Button>
                <Button><ButtonLink href="/"> My Page</a></Button> -->
        </Container>
        <ul>
            <Button>
                <li><a href="./.php"> Search</a></li>
            </Button>
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
                <li><a href="./mypage.php"> My page</a></li>
            </Button>
            <Button>
                <li><a href="./login.php"> Login</a></li>
            </Button>


        </ul>
    </nav>
    <div>
        Insert movie data!
        <form action="compare_result.php" method="post">
            Title <input type="textbox" name="input_title" required>
            Sales <input type="textbox" name="input_sales" required>
            Audience <input type="textbox" name="input_audience" required>
            <input type="submit" value="Compare">
        </form>
    </div>

    <div>
        Results
        <form>
            <?php
            $user_id = $_SESSION['id'];

            $stmt = $mysqli->prepare($sql_select);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $list = "<ul>";
            while ($row = mysqli_fetch_array($result)) {
                $list = $list . "<li>{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) is 상위 30퍼센트   </li>";

                $list = $list . "<input type='submit' value='modify' onclick='javascript:update({$row['input_title']})')'>";
                $list = $list . "<input type='submit' value='delete' onclick='javascript:delete({$row['input_title']})'>";
            };
            $list = $list . "</ul>";
            echo $list;
            ?>


        </form>
    </div>
</body>

</html>