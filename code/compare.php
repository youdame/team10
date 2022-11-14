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
        function update_compare($title){

        }

        function delete_compare($title){

        }
    </script>

</head>
<body>
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
            $user_id = "JINSEO";

            $stmt = $mysqli->prepare($sql_select);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
 
            $list = "<ul>";
            while($row = mysqli_fetch_array($result)){
                $list = $list."<li>{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) is 상위 30퍼센트   </li>";   

                $list = $list."<input type='submit' value='modify' onclick='javascript:update({$row['input_title']})')'>";
                $list = $list."<input type='submit' value='delete' onclick='javascript:delete({$row['input_title']})'>";

            };
            $list = $list."</ul>";
            echo $list;
            ?>

                     
        </form>
    </div>
</body>
</html>