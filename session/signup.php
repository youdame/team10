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
                <td>Gender</td>
                <td>
                    <input type='radio' name='gender' value='f'/>female
                    <input type='radio' name='gender' value='m'/>male
                </td>
            </tr>
            <tr> 
                <td>Age</td>
                <td>
                    <input type='radio' name='age' value='10'/>10's
                    <input type='radio' name='age' value='20'/>20's
                    <input type='radio' name='age' value='30'/>30's
                    <input type='radio' name='age' value='40'/>40's
                    <input type='radio' name='age' value='50'/>50's
                    <input type='radio' name='age' value='60'/>60's
                    <input type='radio' name='age' value='70'/>over 70's
                </td>
            </tr>
            <tr> 
                <td>Preferred Category</td>
                <td>
                    <input type='radio' name='genre' value='action'/>action
                    <input type='radio' name='genre' value='comedy'/>comedy
                    <input type='radio' name='genre' value='drama'/>drama
                    <input type='radio' name='genre' value='animation'/>animation </br>
                    <input type='radio' name='genre' value='SF'/>SF
                    <input type='radio' name='genre' value='romance'/>romance
                    <input type='radio' name='genre' value='thriller'/>thriller
                    <input type='radio' name='genre' value='none' checked/>none
                </td>
            </tr>
            
        </table>
        <input type="submit" value="Sign up">
    </form>
</body>
</html>