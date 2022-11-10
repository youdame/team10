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
            <tr> 
                <td>Preferred Category</td>
                <td>
                    <input type='radio' name='genre' value='action'/>액션
                    <input type='radio' name='genre' value='comedy'/>코미디
                    <input type='radio' name='genre' value='drama'/>드라마
                    <input type='radio' name='genre' value='animation'/>애니메이션 </br>
                    <input type='radio' name='genre' value='SF'/>SF
                    <input type='radio' name='genre' value='romance'/>로맨스
                    <input type='radio' name='genre' value='thriller'/>스릴러
                    <input type='radio' name='genre' value='none' checked/>없음
                </td>
            </tr>
            
        </table>
        <input type="submit" value="Sign up">
    </form>
</body>
</html>