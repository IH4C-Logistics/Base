<?php
// statusの値を1()に変更

 require('dbpdo.php');

 session_start();
 $yoyaku = $_GET['yoyakuID'];

 $sql = ("UPDATE `t_reserve_no` SET `status`='1' WHERE random_number = '".$yoyaku."'"); //SQL文

 // SQL実行
 $res = $dbh->prepare($sql);
 $res->execute();

 header('Location: ../loading.php');//URL飛ばす



?>