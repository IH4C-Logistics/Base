<?php
try {
    //pdoを読み込む
    require('db/dbpdo.php');

    session_start();
    if(isset($_SESSION['u_name'])){
      unset($_SESSION['u_name']);
    }

    $baseid = $_POST['baseid'];
    $password = $_POST['password'];
  
   
    $sql1 = "SELECT u_Id FROM t_user WHERE u_Id = '". $baseid ."'";
    $stmt1 = $dbh->prepare($sql1);  
    $stmt1->execute();
    $baseid1 = $stmt1->fetchAll();
    
    
    $sql2 = "SELECT u_Pass FROM t_user WHERE u_Pass = '". $password ."'";
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();
    $password1 = $stmt2->fetchAll();
  
    
   
    if (empty($baseid1)) {
          print("NG!!!!!!");
          session_start();
          $error = "ユーザー名又はパスワードが間違っています";
          $_SESSION['error'] = $error;
          header('Location: index.php');
      } else {
        if (empty($password1)){
            print("NG?????");
            session_start();
            $error = "ユーザー名又はパスワードが間違っています";
            $_SESSION['error'] = $error;
            header('Location: index.php');
        } else {
          session_start();

          $sql3 = "SELECT u_Name FROM t_user WHERE u_Id = '". $baseid ."'";
          $stmt3 = $dbh->prepare($sql3);
          $stmt3->execute();
          $u_name = $stmt3->fetchAll();
          
          $_SESSION['u_name'] = $u_name[0];
          echo "oioioioi";
              // ログイン成功後index.phpに飛ばす
              header('Location: index.php');
        }
  
    }
  
  
  
  
  } catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
  }
?>