<?php

try{

require('db/dbpdo.php');
session_start();

$name = "エルフーズ横須賀工場";

//$sql1 = "SELECT * FROM t_reservation WHERE b_name = '".$name."'";
//$stmt1 = $dbh->prepare($sql1);  
//$stmt1->execute();
//$name1 = $stmt1->fetchAll();


 
$sql = ("SELECT * FROM t_reservation where 1"); 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = ("SELECT * FROM t_reservation where status = '準備完了'"); 
$stmt2 = $dbh->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);


}catch (PDOException $e) {
  exit('データベースに接続できませんでした。' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/loading.css">
  <title>積込状況管理</title>
</head>
<body>

  <nav class="header">
    <a href="index.php" class="home">HOME</a>
  </nav>

  
  <div class="container">
    <div>
      <div class="firsttable">
        <table>
          <tr>
            <th>予約番号</th>
          </tr>
          
          <?php foreach ($result2 as $item): ?>

          <tr><td><?php echo $item['contract_num']; ?></td></tr>
          
          <?php endforeach; ?>
          
          <tr>
            <td id="pagenumber">1/1ページ</td>
          </tr>
        </table>
      </div>

      <div class="secondtable">
        <table>
            <tr>
                <th>到着予定</th>
                <th>予約番号</th>
                <th>ステータス</th>
                <th></th>
            </tr>

            <?php foreach ($result as $item): ?>

            <tr>
                <td id="kisu"><?php echo $item['a_time'];       ?></td>
                <td id="kisu"><?php echo $item['contract_num']; ?></td>
                <td id="kisu">
                  <?php if($item['status'] == "到着受付"){
                            echo "到着受付";
                        } else {
                            echo "準備完了";
                        } ?>
                 </td>
                <td id="kisu">しばらくお待ちください。</td>
            </tr>

            <?php endforeach; ?>
            
            <tr>
            <td colspan="4" id="pagenumber">1/1ページ</td>
            </tr>
        </table>
      </div>
    </div>
  </div>

</body>
</html>