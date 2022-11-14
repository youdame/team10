<!--이유림-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <style>
        [type="submit"] {
            background-color: lightgray;
            border: 0px;
            padding: 8px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <header style="text-align: center;margin:40px;font-size:30px">
        <p>DELETE LIST</p>
    </header>

    <div align="center" style="border:1px solid grey;border-radius:10px;width:70%;margin:auto;padding:20px">
        <p style="text-align:center;margin: 10px;margin-bottom:30px;padding:10px;font-size:17px;width:200px;border-radius:10px;background-color:lightslategrey">Select Movies to Delete</p>
        <?php
        //$nickname = '$_SESSION['name']';
        $nickname = 'test';
        $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");
        $sql = "SELECT poster, title
                FROM movie_boxoffice               
                LEFT JOIN user_like ON movie_boxoffice.m_id=user_like.m_id
                WHERE u_id = (SELECT user.u_id
                              FROM user
                              WHERE user.username='$nickname')";

        $res = mysqli_query($mysqli, $sql);

        while ($row = mysqli_fetch_array($res)) {
        ?>
            <div style="justify-content: center;display:inline-block;margin:10px">
                <form action="mypage_like_delete_response.php" method="POST">
                    <input type="image" src="<?= $row['poster'] ?>" width="130px">
                    <br><input style="width:150px;" type="submit" name="movie_title" value="<?php echo $row['title'] ?>">
                </form>
            </div>
        <?php } ?>


    </div>
</body>

</html>