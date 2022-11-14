<!--이유림-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
</head>

<body>
    <header style="text-align: center;margin:40px;font-size:30px">
        <p>MY PAGE</p>
    </header>



    <?php
    $prevPage = "mypage.php";
    $mysqli = mysqli_connect('localhost', 'team10', 'team10', 'team10');
    if (mysqli_connect_errno()) {
        echo 'Failed to connect to My SQL';
    }

    mysqli_begin_transaction($mysqli);

    try {
        //$sql1 = "SELECT id, preferred FROM user WHERE user.username = '$_SESSION['name']";
        $user_info = "SELECT u_id, preferred FROM user WHERE user.username = 'test'";
        $row = mysqli_fetch_array(mysqli_query($mysqli, $user_info));
        $id = $row[0];
        $genre = $row[1];

        $genre_update = "UPDATE user SET preferred='" . $_POST['genre'] . "' WHERE user.u_id=$id";
        $res = mysqli_query($mysqli, $genre_update);

        mysqli_commit($mysqli);
        echo 'commit';
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($mysqli);
        echo 'rollback';
    }

    Header('location:' . $prevPage);

    ?>



</body>
<footer align="center" style="position : absolute;bottom : 0;margin:20px auto; text-align:center;">
    <p></p>
</footer>


</html>