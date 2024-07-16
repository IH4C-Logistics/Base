<?php

require('db/dbpdo.php');
$key = $_GET['key'];

$sql = "SELECT 
            `contract_num`, 
            `b_name`, 
            `arrival_point`, 
            `a_date`, 
            `a_time`, 
            `trans_comp`, 
            `driver_name`, 
            `tel_num`, 
            `car_num`, 
            `vehicle_size`, 
            `product_name`, 
            `quantity`, 
            `status` 
        FROM  
            `t_reservation`  
        WHERE 
            `contract_num` = :key"; 

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':key', $key, PDO::PARAM_STR);
$stmt->execute();
$reservation = $stmt->fetch(PDO::FETCH_ASSOC); // 1行のみ取得
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規予約</title>
  <link rel="stylesheet" href="css/reservation_change.css">
</head>
<body>

  <nav class="header">
    <a href="reservation.php" class="home">戻る</a>
  </nav>

  <main>
    <div id="wrap">
      <form action="db/update.php" method="post">
        <div class="Form">
        <input type="hidden" name="contract_num" value="<?php echo htmlspecialchars($key); ?>">
          <h2>予約情報確認・修正</h2>
          <p>予約情報は以下の通りです。<br>内容を修正する場合は、修正ボタンを押してください。</p>
          <div>
            <div>
              <div class="Form-Item">
                <p class="Form-Item-Label"> 運転者氏名 </p>
                <input type="text" class="Form-Item-Input" placeholder="例）山田太郎" id="driver_name" name="driver_name" value="<?php echo htmlspecialchars($reservation['driver_name']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> 電話番号(ハイフン無し) </p>
                <input type="text" class="Form-Item-Input" placeholder="例）09012345678" id="tel_num" name="tel_num" value="<?php echo htmlspecialchars($reservation['tel_num']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> 運送依頼会社名 </p>
                <input type="text" class="Form-Item-Input" placeholder="例）〇〇〇株式会社" id="b_name" name="b_name" value="<?php echo htmlspecialchars($reservation['b_name']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> 運送会社名 </p>
                <input type="text" class="Form-Item-Input" placeholder="例）XXX株式会社" id="trans_comp" name="trans_comp" value="<?php echo htmlspecialchars($reservation['trans_comp']); ?>">
              </div>                        

              <div class="Form-Item">
                <p class="Form-Item-Label"> 運送先 </p>
                <input type="text" class="Form-Item-Input" placeholder="例）物流拠点A" id="arrival_point" name="arrival_point" value="<?php echo htmlspecialchars($reservation['arrival_point']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> 到着日付 </p>
                <input type="date" class="Form-Item-Input" id="a_date" name="a_date" value="<?php echo htmlspecialchars($reservation['a_date']); ?>" min="<?php echo(date('Y-m-d')); ?>">
              </div>
            </div>
            
            <div>
              <div class="Form-Item">
                <p class="Form-Item-Label"> 到着時刻 </p>
                <input type="time" class="Form-Item-Input" id="a_time" name="a_time" value="<?php echo htmlspecialchars($reservation['a_time']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> ナンバープレート </p>
                <input type="text" class="Form-Item-Input" placeholder="例）1234" id="car_num" name="car_num" value="<?php echo htmlspecialchars($reservation['car_num']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> 車種 </p>
                <select class="Form-Item-Input" id="vehicle_size" name="vehicle_size">
                  <option value="">選択してください</option>
                  <option value="2トン車" <?php if ($reservation['vehicle_size'] === '2トン車') echo 'selected'; ?>>2トン車</option>
                  <option value="4トン車" <?php if ($reservation['vehicle_size'] === '4トン車') echo 'selected'; ?>>4トン車</option>
                  <option value="10トン車" <?php if ($reservation['vehicle_size'] === '10トン車') echo 'selected'; ?>>10トン車</option>
                  <option value="トレーラー" <?php if ($reservation['vehicle_size'] === 'トレーラー') echo 'selected'; ?>>トレーラー</option>
                  <option value="軽トラ" <?php if ($reservation['vehicle_size'] === '軽トラ') echo 'selected'; ?>>軽トラ</option>
                  <option value="JRコンテナ" <?php if ($reservation['vehicle_size'] === 'JRコンテナ') echo 'selected'; ?>>JRコンテナ</option>
                </select>
              </div>
              
              <div class="Form-Item">
                <p class="Form-Item-Label"> 商品名 </p>
                <input type="text" class="Form-Item-Input" placeholder="例）炒飯" id="product_name" name="product_name" value="<?php echo htmlspecialchars($reservation['product_name']); ?>">
              </div>

              <div class="Form-Item">
                <p class="Form-Item-Label"> 数量(ケース) </p>
                <input type="text" class="Form-Item-Input" placeholder="例）24" id="quantity" name="quantity" value="<?php echo htmlspecialchars($reservation['quantity']); ?>">
              </div>

              <input type="submit" class="Form-Btn" value="修正する">
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>
</html>

