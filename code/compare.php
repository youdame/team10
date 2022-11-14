<!--홍진서-->
<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $sql_select = "SELECT * FROM compare_data WHERE u_id = ?";

    //임시
    $user_id = "JINSEO";

    $stmt = $mysqli->prepare($sql_select);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_array($result)){
        echo "{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) is 상위 30퍼센트 ";   
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>


    <?php
        if(mysqli_num_rows($result)>0){ ?>
            <div>
                <?php       
                while($row = mysqli_fetch_array($result)){
                    echo "{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) :";   
                    echo "The sales of the movie are in the top 30%, and the audience is in the top 20% ";
                };
                ?>
                <button type="button" onclick="window.open('compare_modify.php', 'Modify compare data', 'width=600, height=400');">Modify</button>
                <button type="button" onclick="location.href='compare_delete.php'">Delete</button>
            </div>
        <?php
        }else{ ?>
            <div>
                Insert movie data!
                <form action="compare_result.php" method="post">
                    Title <input type="textbox" name="input_title" required>
                    Sales <input type="textbox" name="input_sales" required>
                    Audience <input type="textbox" name="input_audience" required>
                    <input type="submit" value="Compare">
                </form>
            </div>
        <?php
        }
    ?>


    

    

</body>
</html>