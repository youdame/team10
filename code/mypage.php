<!--이유림-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
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
        <p>MY PAGE</p>
    </header>


    <?php

    //$username = $_SESSION['name'];
    $nickname = 'test';
    $mysqli = mysqli_connect('localhost', 'team10', 'team10', 'team10');
    $sql = "SELECT u_id, pwd, preferred FROM user WHERE user.username = '$nickname'";
    $row = mysqli_fetch_array(mysqli_query($mysqli, $sql));
    $id = $row[0];
    $pwd = $row[1];
    $genre = $row[2];

    mysqli_close($mysqli);
    ?>
    <!--현재 회원 정보 -> 닉네임, 아이디, 선호 장르 -->
    <div id="user info" style="text-align: center;width:100%;">
        <p style="margin:auto;padding:7px;font-size:17px;width:200px;border-radius:10px;background-color:lightslategray">USER INFORMATION</p>

        <form action="mypage_genre_update.php" method="POST">
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>ID</p>
                <hr style="width:80%"><?= $id ?>
                <br>
            </div>
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>Nickname</p>
                <hr style="width:80%"><?= $nickname ?>
            </div>
            <div style="display:inline-block;margin:20px;border:1px solid grey;width:200px;padding-bottom:15px;border-radius:10px">
                <p>Preferred Genre</p>
                <hr style="width:80%"><?= $genre ?>
            </div>
            <div style="margin:10px;margin-bottom:40px">
                <input type="submit" value="Edit Preferred Genre">
            </div>
        </form>
    </div>

    <div align="center" style="border:1px solid grey;border-radius:10px;margin:150px;margin-top:10px">
        <p style="margin: 10px;margin-top:30px;padding:7px;font-size:17px;width:100px;border-radius:10px;background-color:lightslategray">LIKES</p>
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
                <form action="mypage_like_update.php">
                    <input type="image" src="<?= $row['poster'] ?>" width="130px">
                    <br><?= $row['title'] ?>
                </form>
            </div>
        <?php } ?>
        <div style="text-align:center">
            <div style="display:inline-block;">
                <form style="margin: 20px;" action="mypage_like_delete.php">
                    <input type="submit" value="DELETE">
                </form>
            </div>
            <div style="display:inline-block">
                <form style="margin: 20px;" action="mypage_like_insert_genre.php">
                    <input type="submit" value="ADD">
                </form>
            </div>
        </div>
    </div>
</body>



</html>