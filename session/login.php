<!--홍진서-->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="login_result.php" method="POST">
        <table>
            <tr> 
                <td>ID</td>
                <td><input type='text' name='input_id'/></td>
            </tr>
            <tr> 
                <td>Password</td>
                <td><input type='text' name='input_pw'/></td>
            </tr>
        </table>
        <input type="submit" value="log in">
    </form>
</body>
</html>