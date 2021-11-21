<?php
    //Tüm include lar
    include_once "../../includes/db.php";
    include_once "../../vendor/autoload.php";

    global $connection;

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    //Loglamalar için logger hazırlandı
    $logger = new Logger('send_friend_request');
    $logger->pushHandler(new StreamHandler('../../logs/friendSystem.log',Logger::DEBUG));

    //Oturum bilgilerini almak için bunu yazdık.
    session_start();
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    //gelen post requestedUser  içerisine teslim alındı.
    string: $requestedUser = $_POST["requestedUser"];

    //Burada kişinin daha önceden arkadaşlık isteği gönderip göndermediğini veya arkadaş olup olmadıkları sorugulanacak.
    $sql = "SELECT friend_ls,friend_request FROM friends WHERE username=\"$username\";";
    $results = $connection->query($sql) or die($logger->error("SELECT friend_ls,friend_request FROM friends WHERE username=\"username\"; ".mysqli_error($connection)));

    $row = $results->fetch_array();

    $friends = $row["friend_ls"];
    $friendRequests = $row["friend_request"];
    $isAlreadyFriend = false;
    $isAlreadySended = false;
    $isMy = false;
    if(in_array($requestedUser,explode(",",$friends))){
          $isAlreadyFriend = true;
    }
    if(in_array($requestedUser,explode(",",$friendRequests))){
          $isAlreadySended = true;
     }
     if($requestedUser == $username){
          $isMy =true;
     }

     if(!$isAlreadySended&&!$isAlreadyFriend&&!$isMy){
          //İlgili bilgileri incelemek için loglama sistemnine logluyoruz.
          $logger->info("Arkadaşlık talep edilen kişi: " . $requestedUser);
          $logger->info("Arkadaşlığı talep eden kişi: " . $username);

          //Arkadaşlık isteği gönderen kişinin arkadaşlık isteği gönderdiğini veritabanına yazacak.
          $sql = "UPDATE friends SET friend_request=CONCAT(friend_request, ',' ,'$requestedUser') WHERE username='{$username}'";
          $connection->query($sql) or die($logger->error(mysqli_error($connection)));

          //Arkadaşlığı istenen kişinin tablosuna gelen arkadaşlık isteği olarak yazılacak.
          $sql = "UPDATE friends SET received_request=CONCAT(received_request, ',' ,'$username') WHERE username='{$requestedUser}'";
          $connection->query($sql) or die($logger->error(mysqli_error($connection)));

          //Arkadaşlık isteğinin gönderildiğini kişiye bildirim olarak atamamız gerekiyor.
          $now = date("Y-m-d H:i:s");
          $sql = "INSERT INTO user_inbox (msg_sent,msg_author_id,msg_author,msg_subject,msg_content,msg_date,msg_reply_status)
               VALUES 
          ('{$requestedUser}',
          '{$userId}',
          '{$username}',
          'Arkadaşlık isteği','$username kişisinden sana bir arkadaşlık isteği gönderildi:
               <button onclick=\"acceptFriendRequest(\'$username\')\">Kabul Et</button>&nbsp;&nbsp;&nbsp;<button onclick=\"rejectFriendRequest(\'$username\')\">Reddet</button>',
               '$now',
               'unread'
               )";

          $connection->query($sql) or die($logger->error(mysqli_error($connection)));
          echo "Beklemede";
     }else{
          if($isAlreadyFriend){
               echo "Zaten arkadaşsınız";
          }elseif($isAlreadySended){
               echo "İstek gönderilmiş";
          }elseif($isMy){
               echo "Kendinle arkadaşlık?";
          }
     }
     