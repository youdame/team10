<!--홍진서-->
<?php
session_start();
$mysqli = mysqli_connect("localhost", "team10", "team10", "team10");

//바탕화면과 연결 시 해당 데이터들 1차로 넘겨주기 ($_POST['audMin']도 전송)
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

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        #btn_search{width: 100; height:100;}

        #main_div{ display: flex; }

        #table_option{
            border-color:darkgrey; 
            border-style:solid;

            padding: 10px;
            margin-left:auto; 
            margin-right:auto;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        #table_option tr, td{
            padding: 5px;
        }

        #table_show_result{
            padding: 10px;
            margin-left:auto; 
            margin-right:auto;
            margin-top: 30px;
            margin-bottom: 30px;

            border-top: 1px solid #bcbcbc;
            border-bottom: 1px solid #bcbcbc;
        }

        #table_show_result td{
            padding-left: 50px;
            padding-right: 50px;
        }
    </style>

    <script type="text/javascript">
        function selectAll(selectAll){
            const checkboxes = document.getElementsByName('year[]');
            checkboxes.forEach((checkbox) => checkbox.checked = selectAll.checked);
        }
    </script>
</head>

<body>
    <header id="main_header">
        <nav>
            <a id="logo" href="main.php"> Team10, MOVIE </a>
            
            <ul class="header_ul">
                <?php
                if (isset($_SESSION['name'])) { ?>
                    <li class="header_li"><a href="./logout.php"> Log out</a></li>
                    <li class="header_li"><a href="./mypage.php"> My page</a></li>
                    <li class="header_li"><a href="./sales_month.php"> Sales</a></li>
                    <li class="header_li"><a href="./director.php"> Director</a></li>
                    <li class="header_li"><a href="./dash.php">DashBoard</a></li>
                    <li class="header_li"><a href="./genre.php"> Genre</a></li>

                    <li class="header_li"><form action="filter.php" method="post">
                        <input type="hidden" name="country" value="Korea">
                        <input type="hidden" name="rate" value="5">
                        <input type="hidden" name="year" value="2020">
                        <input type="hidden" name="aud" value="all">
                        <input type="hidden" name="audMin" value="0">
                        <input type="hidden" name="audMax" value="20000000">
                        <input type="hidden" name="search_input" value="true">
                        <input type="submit" value="Filter" id="filter_submit">
                    </form></li>
                <?php
                } else { ?>
                    <li class="header_li"><a href="./login.php"> Login</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>

    <div id="div_all">
        <!-- 검색 옵션 -->
        <div id="sub_div">
            <form method="POST">
                <table id="table_option">
                    <tr>
                        <td>Country</td>
                        <td>
                            <select name="country">
                                <option value="Korea" <?php if ($country == 'Korea') { ?>selected="selected" <?php } ?>>Korea</option>
                                <option value="USA" <?php if ($country == 'USA') { ?>selected="selected" <?php } ?>>Overseas</option>
                            </select> </br>
                        </td>
                        <td rowspan="4"><input type="submit" id="btn_search" value="search"></td>
                    </tr>

                    <tr>
                        <td>Rate</td>
                        <td>
                            <input type='radio' name='rate' value='5' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '5') { ?>checked="checked" <?php } ?> checked />over 5
                            <input type='radio' name='rate' value='6' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '6') { ?>checked="checked" <?php } ?> />over 6
                            <input type='radio' name='rate' value='7' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '7') { ?>checked="checked" <?php } ?> />over 7
                            <input type='radio' name='rate' value='8' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '8') { ?>checked="checked" <?php } ?> />over 8
                            <input type='radio' name='rate' value='9' onclick="this.form.rateTextbox.disabled=true" <?php if ($rate == '9') { ?>checked="checked" <?php } ?> />over 9
                            <input type='radio' name='rate' value='self' onclick="this.form.rateTextbox.disabled=false" <?php if ($rate == 'self') { ?>checked="checked" <?php } ?> />over
                            <input type="text" name="rateTextbox" value="0" <?php if ($rate != 'self') { ?>disabled="disabled" <?php } ?>>
                        </td>
                    </tr>

                    <tr>
                        <td>Audience</td>
                        <td>
                            <input type='radio' name='aud' value='all' onclick="this.form.AudTxtMin.disabled=true; this.form.AudTxtMax.disabled=true" <?php if ($aud == 'all') { ?>checked="checked" <?php } ?> checked />All
                            <input type='radio' name='aud' value='user' onclick="this.form.AudTxtMin.disabled=false; this.form.AudTxtMax.disabled=false" <?php if ($aud == 'user') { ?>checked="checked" <?php } ?> />
                            over <input type="text" name="AudTxtMin" value="0" <?php if ($aud == 'all') { ?>disabled="disabled" <?php } ?>> million,
                            under <input type="text" name="AudTxtMax" value="20" <?php if ($aud == 'all') { ?>disabled="disabled" <?php } ?>> million
                        </td>
                    </tr>

                    <tr>
                        <td>Release year</td>
                        <td>
                            <input type='radio' name='year' value='0' <?php if ($year == 0) { ?>checked="checked" <?php } ?> />before 2005
                            <input type='radio' name='year' value='2005' <?php if ($year == 2005) { ?>checked="checked" <?php } ?> />2005 to 2009
                            <input type='radio' name='year' value='2010' <?php if ($year == 2010) { ?>checked="checked" <?php } ?> />2010 to 2014
                            <input type='radio' name='year' value='2015' <?php if ($year == 2015) { ?>checked="checked" <?php } ?> checked />2015 to 2019
                            <input type='radio' name='year' value='2020' <?php if ($year == 2020) { ?>checked="checked" <?php } ?> />after 2020
                        </td>
                    </tr>
                    <table>
                        <input type="hidden" name="search_input" value="True">
            </form>
        </div>

        <!-- 검색 결과 -->
        <div id="main_div">
            <?php
                if ($_POST['search_input']) {
                    // 변수 전달받기
                    $country = $_POST['country'];

                    if ($_POST['rate'] == 'self') {
                        $rateTextBox = (int)$_POST['rateTextbox'];
                    } else {
                        $rateTextBox = 0;
                    }

                    if (is_numeric($_POST['rate'])) {
                        $rate = $_POST['rate'];
                    } else {
                        $rate = $rateTextBox;
                    }

                    if ($_POST['aud'] == 'user') {
                        $audMin = (int)$_POST['AudTxtMin'];
                        $audMax = (int)$_POST['AudTxtMax'];

                        $audMin *= 1000000;
                        $audMax *= 1000000;
                    } else {
                        $audMin = 0;
                        $audMax = 20 * 1000000;
                    }

                    $year = (int)$_POST['year'];
                    $yearEnd = $year + 4;
                } else {
                    echo "키워드를 입력해 주세요";
                }
            ?>

            <table id="table_show_result">
                <tr>
                    <td><b>영화제목</b></td>
                    <td><b>국가</b></td>
                    <td><b>관객수</b></td>
                    <td><b>평점</b></td>
                </tr>

                <?php
                $list = '';
                if ($_POST['search_input']) {
                    // 쿼리 filt
                    $sql = "SELECT title, country, FORMAT(audience, 0) AS audience, rating
                            FROM movie_boxoffice
                                INNER JOIN rating
                                ON movie_boxoffice.m_id = rating.m_id
                            WHERE country = '$country' AND rating.rating >= $rate AND (audience BETWEEN $audMin AND $audMax) AND (YEAR(released_date) BETWEEN $year AND $year+4)";

                    $result = mysqli_query($mysqli, $sql);

                    if (mysqli_num_rows($result) == 0) {
                        $list = $list . "<tr><td colspan=\"6\">결과가 없습니다.</td></tr>";
                    }

                    while ($row = mysqli_fetch_array($result)) {
                        $list = $list . "<tr><td><a href='./detail2.php?m_title={$row['title']}'>{$row['title']}</a></td><td>{$row['country']}</td><td>{$row['audience']}</td><td>{$row['rating']}</td></tr>";
                    }
                    echo $list;
                } else {
                    $list = $list . "<tr><td colspan=\"4\">필터를 선택해주세요.</td></tr>";
                    echo $list;
                }

                ?>
            </table>
        </div>
    </div>

</body>

</html>