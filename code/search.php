<?php
    session_start();
    $mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

    //바탕화면과 연결 시 해당 데이터들 1차로 넘겨주기
    $title;
    $country = $_POST['country'];
    $rate = $_POST['rate'];
    $year = $_POST['year'];
    $aud = $_POST['aud'];

    $search_input = false;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <table>
            <tr>
                <td>Country</td>
                <td>
                    <select name="country">
                        <option value="Korea" <?php if ($country == 'Korea') { ?>selected="selected" <?php } ?>>Korea</option>
                        <option value="USA" <?php if ($country == 'USA') { ?>selected="selected" <?php } ?>>Overseas</option>
                    </select> </br>
                </td>
            </tr>

            <tr>
                <td>Rate</td>
                <td>
                    <input type='radio' name='rate' value='5' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '5') { ?>checked="checked" <?php } ?> checked/>over 5
                    <input type='radio' name='rate' value='6' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '6') { ?>checked="checked" <?php } ?>/>over 6
                    <input type='radio' name='rate' value='7' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '7') { ?>checked="checked" <?php } ?>/>over 7
                    <input type='radio' name='rate' value='8' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '8') { ?>checked="checked" <?php } ?>/>over 8
                    <input type='radio' name='rate' value='9' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '9') { ?>checked="checked" <?php } ?>/>over 9
                    <input type='radio' name='rate' value='self' onclick="this.form.rateTextbox.disabled=false" <?php if ($rate == 'self') { ?>checked="checked" <?php } ?>/>over
                    <input type="text" name="rateTextbox" value="0" disabled>
                </td>
            </tr>

            <tr>
                <td>Audience</td>
                <td>
                    <input type='radio' name='aud' value='all' onclick="this.form.AudTxtMin.disabled=true; this.form.AudTxtMax.disabled=true" <?php if ($aud == 'all') { ?>checked="checked" <?php } ?> checked/>All
                    <input type='radio' name='aud' value='user' onclick="this.form.AudTxtMin.disabled=false; this.form.AudTxtMax.disabled=false" <?php if ($aud == 'user') { ?>checked="checked" <?php } ?>/>
                    over <input type="text" name="AudTxtMin" value="0" disabled> million, 
                    under <input type="text" name="AudTxtMax" value="20" disabled> million
                </td>
            </tr>

            <tr>
                <td>Release year</td>
                <td>
                    <input type='radio' name='year' value='0' <?php if ($year == '0') { ?>checked="checked" <?php } ?>/>befor 2005
                    <input type='radio' name='year' value='2005' <?php if ($year == '2005') { ?>checked="checked" <?php } ?>/>2005 to 2009
                    <input type='radio' name='year' value='2010' <?php if ($year == '2010') { ?>checked="checked" <?php } ?>/>2010 to 2014
                    <input type='radio' name='year' value='2015' <?php if ($year == '2015') { ?>checked="checked" <?php } ?>/>2015 to 2019
                    <input type='radio' name='year' value='2020' <?php if ($year == '2020') { ?>checked="checked" <?php } ?> checked/>after 2020
                </td>
            </tr>
        <table>
        <input type="hidden" name="search_input" value="True">
        <input type="submit" value="search">
    </form>

    <div>
        <?php
            if($_POST['search_input']){
                // 변수 전달받기
                $country = $_POST['country'];

                if($_POST['rate']=='self'){
                    $rateTextBox = (int)$_POST['rateTextbox'];
                }else{
                    $rateTextBox = 0;
                }              

                if(is_numeric($_POST['rate'])){
                    $rate = $_POST['rate'];
                }else{
                    $rate = $rateTextBox;
                }

                if($_POST['aud'] == 'all'){
                    $audMin = 0;
                    $audMax = 10 * 1000000;
                }else{
                    $audMin = $AudTxtMin;
                    $audMax = $AudTxtMax;

                    $audMin *= 1000000;
                    $audMax *= 1000000;
                }

                $year = (int)$_POST['year'];
                $yearEnd = $year+4;
            }else{
                echo "키워드를 입력해 주세요";
            }
        ?>

        <table>
            <tr>
                <td>영화제목</td>
                <td>국가</td>
                <td>관객수</td>
                <td>평점</td>
            </tr>

            <?php
                $list = '';
                if($_POST['search_input']){

                    // 쿼리
                    $sql = "SELECT * FROM movie_boxoffice WHERE country = '$country' AND rating >= $rate AND (audience BETWEEN $audMin AND $audMax) 
                            AND YEAR(released_date) BETWEEN $year AND $year+4";
                    $result = mysqli_query($mysqli, $sql);
                    //$list = '';

                    if(mysqli_num_rows($result) == 0){
                        $list = $list."<tr><td colspan=\"6\">결과가 없습니다.</td></tr>";

                        $country = 'Korea';
                        $rate = 0;
                        $year = 2020;
                        $aud = 'all';

                        if($_POST['audMin']){
                            $audMin = $_POST['audMin'];
                            $audMax = $_POST['audMax'];
                        }else{
                            $audMin = 0;
                            $audMax = 20000000;
                        }
                    }
        
                    while($row = mysqli_fetch_array($result)){
                        $list = $list."<tr><td>{$row['title']}</td><td>{$row['country']}</td><td>{$row['audience']}</td><td>{$row['rating']}</td> </br>";
                    }echo $list;
                }
                else{
                    $list = $list."<tr><td colspan=\"4\">필터를 선택해주세요.</td></tr>";
                    echo $list;
                }
                
            ?>
        </table>
    </div>



    <script src="./search.js"></script>
</body>
</html>