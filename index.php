<?php
$dbn = "mysql:host=localhost; dbname=timetable; charset=utf8"; 
$user = "root";
$pass = "root";
// try {
//     $dbh = new PDO($dbn,$user,$pass);
//     echo "接続成功\n";
// } catch (PDOException $e) {
//     echo "接続失敗: " . $e->getMessage() . "\n";
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>時間割</title>
</head>
<body>
    <?php
    switch(date("w")){
        case 0:
            $day = "Sday";
            echo $day;
            break;
        case 1:
            $day = "Mday";
            echo $day;
            $dbh = new PDO($dbn,$user,$pass);
            $sql = "select * from $day";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $table = $stmt->fetchAll();
            break;
        case 2:
            $day = "Tuday";
            $dbh = new PDO($dbn,$user,$pass);
            $sql = "select * from $day";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $table = $stmt->fetchAll();
            break;
        case 3:
            $day = "Wday";
            $dbh = new PDO($dbn,$user,$pass);
            $sql = "select * from $day";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $table = $stmt->fetchAll();
            break;
        case 4:
            $day = "THday";
            $dbh = new PDO($dbn,$user,$pass);
            $sql = "select * from $day";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $table = $stmt->fetchAll();
            break;
        case 5:
            $day = "Fday";
            echo $day;
            $dbh = new PDO($dbn,$user,$pass);
            $sql = "select * from $day";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $table = $stmt->fetchAll();
            $sql = null;
            $dbh = null;
            break;
        case 6:
            $day = "Sday";
            echo $day;
            break;
    }
    ?>
    <div class="bar">
        <table border="1" class="timetable" style="border-collapse: collapse">
            <tr>
                <th class=""></th>
                <th>時間</th>
            </tr>
            <tr>
                <td class="period" align="center" valign="middle">1限</td>
                <td class="time" align="center" valign="middle">
                    09:30〜<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11:00
                </td>
            </tr>
            <tr>
                <td class="period" align="center" valign="middle">2限</td>
                <td class="time" align="center" valign="middle">
                    11:10〜<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12:40
                </td>            
            </tr>
            <tr>
                <td class="period" align="center" valign="middle">昼休み</td>
                <td class="time" align="center" valign="middle">
                    12:40〜<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13:30
                </td>
            </tr>
            <tr>
                <td class="period" align="center" valign="middle">3限</td>
                <td class="time" align="center" valign="middle">
                    13:30〜<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;15:00
                    </td>
            </tr>
            <tr>
                <td class="period" align="center" valign="middle">4限</td>
                <td class="time" align="center" valign="middle">
                    15:10〜<br>  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;16:40
                </td>
            </tr>
        </table>
    </div>
    <main>
        <?php
        //id,授業名,リンクの順番
        ?>
        <!-- ↓↓↓↓↓午前、午後どっちも一緒の時の処理 -->
        <?php if(($table[0][1] == $table[1][1]) and ($table[2][1]) == $table[3][1]){ ?>
            <table class="classtable" border="1" style="border-collapse: collapse">
                    <tr class="c-tr">
                        <th class="c-th">コマ数</th>
                        <th class="c-th">授業名</th>
                        <th class="c-th">リンク</th>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            1,2コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[0][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[0][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            3,4コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[2][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[2][2] ?> ">リンク</a>
                        </td>
                    </tr>
            </table>
        <!-- ↓↓↓↓↓午前、午後どっちかだけ一緒の時の処理 -->
        <?php }else if(($table[0][1] == $table[1][1]) xor ($table[2][1] == $table[3][1])){ ?>
            <!-- 午前だけ一緒の時の処理 -->
            <?php if($table[0][1] == $table[1][1]){ ?>                
                <table class="classtable" border="1" style="border-collapse: collapse">
                    <tr class="c-tr">
                        <th class="c-th">コマ数</th>
                        <th class="c-th">授業名</th>
                        <th class="c-th">リンク</th>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            1,2コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[0][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[0][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            3コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[2][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[2][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            4コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[3][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[3][2] ?> ">リンク</a>
                        </td>
                    </tr>
            </table>
            <!-- 午後だけ一緒の時の処理 -->    
            <?php }else{ ?>
                <table class="classtable" border="1" style="border-collapse: collapse">
                    <tr class="c-tr">
                        <th class="c-th">コマ数</th>
                        <th class="c-th">授業名</th>
                        <th class="c-th">リンク</th>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            1コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[0][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[0][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            2コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[1][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[1][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            3,4コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[2][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[2][2] ?> ">リンク</a>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        <!-- ↓↓↓↓↓どっちも違う時の処理(今の所必要ないけどDBのデータが変わっても対応できるように) -->
        <?php }else{ ?>
            <table class="classtable" border="1" style="border-collapse: collapse">
                    <tr class="c-tr">
                        <th class="c-th">コマ数</th>
                        <th class="c-th">授業名</th>
                        <th class="c-th">リンク</th>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            1コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[0][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[0][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            2コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[1][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[1][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            3コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[2][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[2][2] ?> ">リンク</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="comasuu" align="center" valign="middle">
                            4コマ目
                        </td>
                        <td align="center" valign="middle">
                            <h2 class="c-h2"> <?php echo $table[3][1] ?> </h2>
                        </td>
                        <td align="center" valign="middle">
                            <a class="c-a" href=" <?php echo $table[3][2] ?> ">リンク</a>
                        </td>
                    </tr>
            </table>
        <?php } ?>
        <?php
        ?>
    </main>
</body>
</html>