<?php


require('dbpdo.php'); 
// フォームデータが送信されたことを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $driver_name = htmlspecialchars($_POST['driver_name']);
    $tel_num = htmlspecialchars($_POST['tel_num']);
    $b_name = htmlspecialchars($_POST['b_name']);
    $trans_comp = htmlspecialchars($_POST['trans_comp']);
    $arrival_point = htmlspecialchars($_POST['arrival_point']);
    $a_date = $_POST['a_date'];
    $a_time = $_POST['a_time']; 
    $car_num = htmlspecialchars($_POST['car_num']);
    $vehicle_size = htmlspecialchars($_POST['vehicle_size']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $key = htmlspecialchars($_POST['contract_num']); 
    
    // デバッグ用に受け取ったデータを表示
    // echo "<h2>受け取ったデータ</h2>";
    // echo "<p>運転者氏名: " . $driver_name . "</p>";
    // echo "<p>電話番号: " . $tel_num . "</p>";
    // echo "<p>運送依頼会社名: " . $b_name . "</p>";
    // echo "<p>運送会社名: " . $trans_comp . "</p>";
    // echo "<p>運送先: " . $arrival_point . "</p>";
    // echo "<p>到着日付: " . $a_date . "</p>";
    // echo "<p>到着時刻: " . $a_time . "</p>";
    // echo "<p>ナンバープレート: " . $car_num . "</p>";
    // echo "<p>車種: " . $vehicle_size . "</p>";
    // echo "<p>商品名: " . $product_name . "</p>";
    // echo "<p>数量(ケース): " . $quantity . "</p>";
    // echo "<p>契約番号: " . $key . "</p>";
    
    // SQL UPDATE 文

     $sql = "UPDATE `t_reservation` SET 
                 `driver_name` = '$driver_name',
                 `tel_num` = '$tel_num',
                 `b_name` = '$b_name',
                 `trans_comp` = '$trans_comp',
                 `arrival_point` = '$arrival_point',
                 `a_date` = '$a_date',
                 `a_time` = '$a_time',
                 `car_num` = '$car_num',
                 `vehicle_size` = '$vehicle_size',
                 `product_name` = '$product_name',
                 `quantity` = '$quantity'
             WHERE 
                 `contract_num` = '$key'";

    

    $stmt = $dbh->query($sql);
    

    header('Location: ../reservation.php'); // 更新後にリダイレクト
    exit();
}
?>
