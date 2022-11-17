<!--홍진서-->
<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    $sql_select = "SELECT * FROM compare_data WHERE u_id = ?";

    $user_id = $_SESSION['id'];

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

    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header id="main_header">
        <nav style="height:40px">
            <a id="logo"> Team10, MOVIE </a>
        </nav>
    </header>
  
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