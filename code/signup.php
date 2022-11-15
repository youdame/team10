<!--홍진서-->
<?php
session_cache_limiter('private');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
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
    <div id="signup_table">
        <form action="./signup_result.php" method="POST">
            <table>
                <tr>
                    <td id="type_label">ID</td>
                    <td><input type='text' name='enter_id' required /></td>
                </tr>
                <tr>
                    <td id="type_label">Password</td>
                    <td><input type='text' name='enter_pw' required /></td>
                </tr>
                <tr>
                    <td id="type_label">Name</td>
                    <td><input type='text' name='enter_name' required /></td>
                </tr>
                <tr>
                    <td id="type_label">Gender</td>
                    <td>
                        <input type='radio' name='gender' value='f' />female
                        <input type='radio' name='gender' value='m' />male
                    </td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>
                        <input type='radio' name='age' value='10' />10's
                        <input type='radio' name='age' value='20' />20's
                        <input type='radio' name='age' value='30' />30's
                        <input type='radio' name='age' value='40' />40's
                        <br><input type='radio' name='age' value='50' />50's
                        <input type='radio' name='age' value='60' />60's
                        <input type='radio' name='age' value='70' />over 70's
                    </td>
                </tr>
                <tr>
                    <td>Preferred<br>Category</td>
                    <td>
                        <input type='radio' name='genre' value='action' />action
                        <input type='radio' name='genre' value='comedy' />comedy
                        <input type='radio' name='genre' value='drama' />drama
                        <input type='radio' name='genre' value='animation' />animation </br>
                        <input type='radio' name='genre' value='SF' />SF
                        <input type='radio' name='genre' value='romance' />romance
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