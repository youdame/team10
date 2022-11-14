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

</body>
<header style="text-align: center;margin:40px;font-size:30px">
    <p>MY PAGE</p>
</header>

<div>
    <form style="text-align:center" action="mypage_genre_update_response.php" method="POST">
        <p style="text-align: center;margin:20px;font-size:20px">Update Preferred Genre</p>
        <label><input type="radio" name="genre" value="액션">Action</label>
        <label><input type="radio" name="genre" value="SF">SF</label>
        <label><input type="radio" name="genre" value="드라마">Drama</label>
        <label><input type="radio" name="genre" value="스릴러">Thriller</label>
        <label><input type="radio" name="genre" value="코미디">Comedy</label>
        <label><input type="radio" name="genre" value="로맨스">Romance</label>
        <label><input type="radio" name="genre" value="애니메이션">Animation</label>
        <br>
        <div style="display: inline-block;">
            <label><input style="margin:30px" type="submit" name="submit" value="OK">
        </div>
        <hr width="80%">
    </form>

</div>

</html>