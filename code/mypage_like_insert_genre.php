<!--이유림-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENRE</title>
    <style>
        #genre_type_radio {
            border: 1px solid grey;
            width: 60%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        label {
            font-size: 15px;
            line-height: 2rem;
            padding: 0.2em 0.4em;
        }

        span {
            vertical-align: middle;
        }

        [type="radio"] {
            vertical-align: middle;
        }

        [type="submit"] {
            background-color: lightslategray;
            border: 0px;
            padding: 8px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <header style="text-align: center;margin:40px;font-size:30px">
        <p>ADD LIST</p>
    </header>
    <div id="genre_type_radio" style="text-align: center;">
        <form action="mypage_like_insert_genre_search.php" method="POST">
            <label><input type="radio" name="genre" value="액션"><span>Action</span></label>
            <label><input type="radio" name="genre" value="SF"><span>SF</span></label>
            <label><input type="radio" name="genre" value="드라마"><span>Drama</span></label>
            <label><input type="radio" name="genre" value="스릴러"><span>Thriller</span></label>
            <label><input type="radio" name="genre" value="코미디"><span>Comedy</span></label>
            <label><input type="radio" name="genre" value="로맨스"><span>Romance</span></label>
            <label><input type="radio" name="genre" value="애니메이션"><span>Animation</span></label><br>
            <label><input style="margin: 20px;" type="submit" name="submit" value="SEARCH">
        </form>
    </div>

</html>