<?php
    session_cache_limiter('private');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>
<body>
    <form action="signup_result.php" method="POST">
        <table>
            <tr> 
                <td>ID</td>
                <td><input type='text' name='enter_id' required/></td>
                <!--<td><button type="button" onclick="signup_chk_id.php">중복확인</button></td>-->
            </tr>
            <tr> 
                <td>Password</td>
                <td><input type='text' name='enter_pw' required/></td>
            </tr>
            <tr> 
                <td>Name</td>
                <td><input type='text' name='enter_name' required/></td>
            </tr>
        </table>
        <input type="submit" value="Sign up">
    </form>
</body>
</html>