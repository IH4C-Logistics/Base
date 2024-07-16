<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reservation.css">
  <title>予約状況管理</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./js/updatelist_no.js"></script>
  <script src="./js/updatelist.js"></script>

</head>
<body>

  <nav class="header">
    <a href="index.php" class="home">HOME</a>
    <a class="res_window">新規予約</a>
  </nav>
    
  <?php
    // データベース情報
    $host = "localhost"; // データベースのホスト名
    $username = "root"; // データベースのユーザー名
    $password = ""; // データベースのパスワード
    $dbname= "ih4c"; // 使用するデータベース名

    try {
      // データベース接続情報
      $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // データベースから既存の予約を取得
      $stmt = $pdo->prepare("SELECT * FROM t_reservation");
      $stmt2 = $pdo->prepare("SELECT * FROM t_reserve_no");
      $stmt->execute();
      $stmt2->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  ?>

      <div class="modal"></div>
        <div class="res_modal">
          <h2 class="title2">予約情報追加</h2>
          <form method="post" action="" enctype="multipart/form-data">
            <div class="form-container">
              <div>
                <label for="textbox1">会社名</label>
                <input type="text" name="b_name" id="textbox1">
              </div>
              <div>
                <label for="textbox2">着地</label>
                <input type="text" name="arrival_point" id="textbox2">
              </div>
              <div>
                <label for="textbox3">着日付</label>
                <input type="date" name="a_date" id="textbox3">
              </div>
              <div>
                <label for="textbox4">着時間</label>
                <input type="time" name="a_time" id="textbox4">
              </div>
              <div>
                <label for="textbox5">運送会社</label>
                <input type="text" name="trans_comp" id="textbox5">
              </div>
              <div>
                <label for="textbox6">ドライバー名</label>
                <input type="text" name="driver_name" id="textbox6">
              </div>
            </div>

            <div class="form-container2">
              <div>
                <label for="textbox7">電話番号</label>
                <input type="text" name="tel_num" id="textbox7">
              </div>
              <div>
                <label for="textbox8">車番</label>
                <input type="text" name="car_num" id="textbox8">
              </div>
              <div>
                <label for="textbox9">車格</label>
                <input type="text" name="vehicle_size" id="textbox9">
              </div>
              <div>
                <label for="textbox10">名義/メーカ名/品名等</label>
                <input type="text" name="product_name" id="textbox10">
              </div>
              <div>
                <label for="textbox11">数量(ケース数)</label>
                <input type="text" name="quantity" id="textbox11">
              </div>
              <div>
                <button class="button" type="submit">登録</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="con">
        <div>
          <h2 class="title">ブラウザ予約情報</h2>
          <div class="scrollable-container" id="reservationContainer">
            <?php if (isset($result) && count($result) > 0): ?>
            <table>
              <tr>
                <?php foreach ($result[0] as $key => $value): ?>
                <?php
                  switch ($key) {
                    case 'contract_num':
                      $header = '受付番号';
                      break;
                    case 'b_name':
                      $header = '会社名';
                      break;
                    case 'arrival_point':
                      $header = '着地';
                      break;
                    case 'a_date':
                      $header = '着日付';
                      break;
                    case 'a_time':
                      $header = '着時間';
                      break;
                    case 'trans_comp':
                      $header = '運搬会社';
                      break;
                    case 'driver_name':
                      $header = 'ドライバー名';
                      break;                      
                    case 'tel_num':
                      $header = '電話番号';
                      break;
                    case 'car_num':
                      $header = '車番';
                      break;                
                    case 'vehicle_size':
                      $header = '車格';
                      break;
                    case 'product_name':
                      $header = '名義/メーカ名/品名等';
                      break;  
                    case 'quantity':
                      $header = '数量(ケース数)';
                      break;
                    case 'status':
                      $header = '受付状況';
                      break;                                              
                    default:
                      $header = $key;
                      break;
                  }
                ?>
                <th><?php echo htmlspecialchars($header); ?></th>
                <?php endforeach; ?>
              </tr>
              <?php foreach ($result as $row): ?>
              <tr>
                <?php foreach ($row as $key => $value): ?>
                  <?php if ($key === 'contract_num'): ?>
                    <td><a href="resevation_change.php?key=<?php echo $value; ?>"><?php echo htmlspecialchars(mb_substr($value, 0, 20)); ?></a></td>
                  <?php else: ?>
                    <td><?php echo htmlspecialchars(mb_substr($value, 0, 20)); ?></td>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tr>
              <?php endforeach; ?>
            </table>
            <?php else: ?>
              データがありません。
            <?php endif; ?>
          </div>
        </div>
      </div>



      <div class="con">
        <div>
          <h2 class="title">現地予約情報</h2>
          <div class="scrollable-container" id="reservationContainer">
            <?php if (isset($result2) && count($result2) > 0): ?>
            <table>
              <tr>
                <?php foreach ($result2[0] as $key => $value): ?>
                <?php
                  switch ($key) {
                    case 'random_number':
                      $header = '受付番号';
                      break;
                    case 'date':
                      $header = '予約日付';
                      break;
                    case 'p_num':
                      $header = '電話番号';
                      break;
                    case 'b_name':
                      $header = '運送会社名';
                      break;
                    case 'b_driver':
                      $header = 'ドライバー名';
                      break;
                    case 'car_num':
                      $header = 'ドライバー名';
                      break;
                    case 'Vehicle_size':
                      $header = '車格';
                      break;
                    case 'product_name':
                      $header = '名義/メーカ名/品名等';
                      break;  
                    case 'case':
                      $header = '数量(ケース数)';
                      break;
                    case 'status':
                      $header = '受付状況';
                      break;                                              
                    default:
                      $header = $key;
                      break;
                  }
                ?>
                <th><?php echo htmlspecialchars($header); ?></th>
                <?php endforeach; ?>
              </tr>
              <?php foreach ($result2 as $row): ?>
              <tr>
                <?php foreach ($row as $value): ?>
                  <td><?php echo htmlspecialchars(mb_substr($value, 0, 20)); ?></td>
                <?php endforeach; ?>
              </tr>
              <?php endforeach; ?>
            </table>
            <?php else: ?>
              データがありません。
            <?php endif; ?>
          </div>
        </div>
      </div>


      <?php
        // フォームが送信されたかどうかを確認
        if ($_SERVER["REQUEST_METHOD"] == "POST" && 
            isset($_POST['b_name'], $_POST['arrival_point'], $_POST['a_date'], $_POST['a_time'], 
                  $_POST['trans_comp'], $_POST['driver_name'], $_POST['tel_num'], $_POST['car_num'], $_POST['vehicle_size'], 
                  $_POST['product_name'],$_POST['quantity'])) {

            $b_name = $_POST['b_name'];  // 会社名
            $arrival_point = $_POST['arrival_point'];  // 着地
            $a_date = $_POST['a_date'];  // 着日付
            $a_time = $_POST['a_time'];  // 着時間
            $trans_comp = $_POST['trans_comp'];  // 運搬会社
            $driver_name = $_POST['driver_name'];  // ドライバー名
            $tel_num = $_POST['tel_num'];  // 電話番号
            $car_num = $_POST['car_num'];  // 車番
            $vehicle_size = $_POST['vehicle_size'];  // 車格
            $product_name = $_POST['product_name'];  // 名義/メーカ名/品名等
            $quantity = $_POST['quantity'];  // 数量


            // ランダムな10桁の予約番号を生成する関数
            function generateRandomNumber($length = 10) {
              $number = '';
              for ($i = 0; $i < $length; $i++) {
                  $number .= mt_rand(0, 9);
              }
              return $number;
            }

            // 10桁のランダムな数字を生成して変数に格納
            $contract_num = generateRandomNumber();


            // t_reservationテーブルに入力した内容を追加
            $queryins = "INSERT INTO t_reservation(contract_num, b_name, arrival_point, a_date, a_time, trans_comp, driver_name, tel_num, car_num, vehicle_size, product_name, quantity,status)
                        VALUES (:contract_num, :b_name, :arrival_point, :a_date, :a_time, :trans_comp, :driver_name, :tel_num, :car_num, :vehicle_size, :product_name, :quantity, 3)";
            $statement = $pdo->prepare($queryins);
            $statement->bindParam(':contract_num', $contract_num);
            $statement->bindParam(':b_name', $b_name);
            $statement->bindParam(':arrival_point', $arrival_point);
            $statement->bindParam(':a_date', $a_date);
            $statement->bindParam(':a_time', $a_time);
            $statement->bindParam(':trans_comp', $trans_comp);
            $statement->bindParam(':driver_name', $driver_name);
            $statement->bindParam(':tel_num', $tel_num);
            $statement->bindParam(':car_num', $car_num);
            $statement->bindParam(':vehicle_size', $vehicle_size);
            $statement->bindParam(':product_name', $product_name);
            $statement->bindParam(':quantity', $quantity);
            $statement->execute();
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo '値が入力されていません';
            }
        }
    } catch (PDOException $e) {
      echo 'データベース接続エラー: ' . $e->getMessage();
    }
      ?>


  <script>

      $(document).on('click', '.res_window', function() {
          // 背景をスクロールできないように & スクロール場所を維持
          scroll_position = $(window).scrollTop();
          $('body').addClass('fixed').css({ 'top': -scroll_position });
          // モーダルウィンドウを開く
          $('.res_modal').fadeIn();
          $('.modal').fadeIn();
      });

      $(document).on('click', '.modal', function() {
          // 背景スクロールを再開し、モーダルを閉じる
          $('body').removeClass('fixed').css({ 'top': '' });
          $(window).scrollTop(scroll_position);
          $('.res_modal').fadeOut();
          $('.modal').fadeOut();
      });

  </script>





</body>
</html>
