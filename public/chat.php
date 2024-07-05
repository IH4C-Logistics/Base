<?php
try{

    require('db/dbpdo.php');

    if($_GET['userID'] != NULL){
        $chatid = $_GET['userID'];
        }else{
            echo "ないよ";
        }
    
    $sql = ("SELECT * FROM `t_chat` WHERE `player` = '".$chatid."' OR `c_Partner` = '".$chatid."' ORDER BY CAST(`time` AS TIME) ASC"); 
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    $sql = ("SELECT * FROM `t_user` where u_Id != '1'"); 
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);




    // $sql = ("SELECT * FROM t_testuser WHERE MOD(player, 2) = 0"); 
    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();
    // $driver = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    }catch (PDOException $e) {
      exit('データベースに接続できませんでした。' . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Example</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<table>
    <?php 
//ドライバー選択
foreach($user as $item):?>
    <tr>
        <td>
            <?php
            echo($item['u_Name']); 
            ?>
        </td>
        <td>
            <?php $user = $item['u_Id']; ?>
        <a href="chat.php?userID=<?php echo $user; ?>" class="button"><?php
            echo($item['u_Name']); 
            ?></a>
        </td>
    </tr>
<?php
endforeach;?>
</table><?php
//chat表示
     foreach ($chat as $item): ?>
        <?php if($item['player'] == 1){?>
            <div class="message sent">
            <div class="message-content">
          <?php  echo $item['text'];?>
          </div>
          </div>
          <?php
        } else{?>
    <div class="chat-container">
        <div class="message received">
            <div class="message-content">
           <?php echo $item['text']; ?>
           </div>
           </div>
        <?php }?>
    <?php endforeach;?>

 <form method="post" action="db/text.php">
    <input type="text" value="<?php echo $chatid; ?>" name="test"  hidden>
 <input type="text" name="text">
<input type="submit" value="＞">

 </form>

        </div>
    </div>
</body>
</html>
