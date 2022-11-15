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
$result_main = $stmt->get_result();

    

//$sql_update = "UPDATE ";
//$sql_delete = "DELETE ";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
  
  <style>
        Logo {
            color: black;
            cursor: pointer;
            font-size: 2.7vw;
            display: flex;
            align-items: center;
            font-weight: bold;
            text-decoration: none;
            height: 4.16vw;
        }

        ButtonLink {
            display: flex;
            justify-content: end;

        }

        nav {
            background-color: lightblue;
            width: 100%;
            height: 4.16vw;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        Container {
            display: inline;
            justify-content: space-between;
            height: 4.16vw;
            z-index: 1;
            width: 74vw;
            max-width: 1100px;

        }

        mainContainer {
            background: white;
            display: grid;
            justify-content: center;
            align-items: center;
            padding: 0 30px;
            height: 800px;
            position: relative;
            z-index: 1;
        }

        Button {
            display: inline;
            justify-content: end;

        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        li {
            float: left;
        }
    </style>

</head>
  
<body>
    <div>
        <?php
            if(mysqli_num_rows($result_main)>0){ ?>
                <div>
                    <?php 

                    while($row = mysqli_fetch_array($result_main)){
                        $i_title = $row['input_title'];
                        $i_sales = $row['input_sales'];
                        $i_audience = $row['input_audience'];
                        
                        // 비교 데이터 삽입
                        $sql_1 = "INSERT INTO movie_profit VALUES ('temp', ?, ?)";
                        $stmt = $mysqli->prepare($sql_1);
                        $stmt->bind_param("ss", $i_sales, $i_audience);
                        $stmt->execute();

                        // 비교 데이터 퍼센트 알아내기
                        $sql_rank1 = "SELECT m_title, PERCENT_RANK() OVER (ORDER BY m_audience) AS audience_percent FROM movie_profit";
                        $sql_rank2 = "SELECT m_title, PERCENT_RANK() OVER (ORDER BY m_sales) AS sales_percent FROM movie_profit";

                        $result_rank1 = mysqli_query($mysqli, $sql_rank1);
                        $result_rank2 = mysqli_query($mysqli, $sql_rank2);
                        $audience_rank = 0;
                        $sales_rank = 0;


                        $row_rank1 = mysqli_fetch_array($result_rank1);
                        $title_temp = $row_rank1['m_title'];
                        $audience_rank = $row_rank1['audience_percent'] * 100;
                        while($title_temp != 'temp'){
                            $row_rank1 = mysqli_fetch_array($result_rank1);
                            $title_temp = $row_rank1['m_title'];
                            $audience_rank = $row_rank1['audience_percent'] * 100;
                        }

                        $row_rank2 = mysqli_fetch_array($result_rank2);
                        $title_temp = $row_rank2['m_title'];
                        $sales_rank = $row_rank2['sales_percent'] * 100;
                        $title_temp = $row_rank2['m_title'];
                        while($title_temp != 'temp'){
                            $row_rank2 = mysqli_fetch_array($result_rank2);
                            $title_temp = $row_rank2['m_title'];
                            $sales_rank = $row_rank2['sales_percent'] * 100;
                        }
                        
                        

                        // 화면에 출력
                        echo "$title_temp";
                        echo "{$row['input_title']} ({$row['input_sales']} won, {$row['input_audience']} people) :<br>";   
                        echo "The sales of the movie are in the top {$sales_rank}%, and the audience is in the top {$audience_rank}% ";

                        // 비교 데이터 삭제
                        $sql_2 = "DELETE FROM movie_profit WHERE m_title = 'temp'";
                        mysqli_query($mysqli, $sql_2);


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
    </div>

</body>

</html>