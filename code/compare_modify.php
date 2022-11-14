<!--홍진서-->

<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $sql_select = "SELECT * FROM compare_data WHERE u_id = ?";
    $sql_update = "UPDATE compare_data SET input_sales = ?, input_audience = ? WHERE u_id = ?";

    //임시
    $user_id = "JINSEO";

    $stmt = $mysqli->prepare($sql_select);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result_s = $stmt->get_result();
    $row_s = mysqli_fetch_array($result_s)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
  
  
    <form action="compare_modify_result.php" method="post">
        <table>
            <tr>
                <td>Title</td>
                <td><?php echo "{$row_s['input_title']}"?></td>
            </tr>
            <tr>
                <td>Sales</td>
                <td><input type="textbox" name="modify_sales" value="<?php echo "{$row_s['input_sales']}"?>"></td>
            </tr>
            <tr>
                <td>Audiences</td>
                <td><input type="textbox" name="modify_audience" value="<?php echo "{$row_s['input_audience']}"?>"></td>
            </tr>
        </table>

        <input type="submit" value="Change the data">
    </form>

</body>

</html>