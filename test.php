<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Page</title>
</head>
<body>
    <p>Homepage</p>

    <?php
        session_start();

        if(isset($_SESSION['name'])){ ?>
            <form action="./php_session/logout.php" method="POST">
                Welcome, <?php echo $_SESSION['name']; ?>! </br>
                <input type="submit" name="submit" value="로그아웃">
            </form>
        <?php
        }else{ ?>
            <form action="./session/login.php" method="POST">
                Please login. </br>
                <input type="submit" name="submit" value="login">
            </form>
            <form action="./session/signup.php" method="POST">
                <input type="submit" name="submit" value="sign up">
            </form>
        <?php
        }
    ?>
    
</body>
</html>