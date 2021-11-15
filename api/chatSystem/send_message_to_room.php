<?php 
   include_once "../../includes/db.php";  
   include_once "../../includes/memcache.php";
   include_once "../../vendor/autoload.php"; 

    /*
    * Buradaki işlemler kullanıcı bir mesaj gönderdiği anda olacak olanları kapsar.
    * Buraya mesaj ve mesajın hangi odaya gönderildiği atılacak. O odadaki mesaj roomPassword ile decrypt edilecek.
    Daha sonrasında yeni gelen mesaj json dosyası olarak önceki mesajların üstüne kaydedilecek. Sonrasında mersaj 
    yeninden şifrelenip veritabanına yeniden yazılacak.
     */
    
   use Monolog\Logger;
   use Monolog\Handler\StreamHandler;

   $logger = new Logger("messageSender");
   $logger->pushHandler(new StreamHandler('../../logs/chatSystem.log', Logger::INFO));

     //mesaj içeriği
   $sendingMessage = $_POST["message"];
     //mesajın gönderildiği oda
   $roomId = $_POST["roomId"];

   session_start();
   //Kullanıcının adı aynı zamanda sender olur.
   $sender = $_SESSION["username"];
   $now = date("d/m/Y H:i:s");

   if(isset($sender)&&isset($roomId)&&isset($sendingMessage)){
        $jsonSendingMessage = "{\"sender\" : \"{$sender}\" ,
        \"message\" : \"{$sendingMessage}\",
        \"date\" : \"{$now}\" }";

        $sql = "SELECT messages,room_password FROM message_rooms WHERE id=$roomId";
        $result = $connection->query($sql) or die($logger->error(mysqli_error($connection)));

        $allMesages = "";
        $roomPassword = "";

        while($row = $result->fetch_assoc()){            $allMesages = $row["messages"];
           
         }

        $allMesages = substr($allMesages,0,strlen($allMesages)-1). "," . $jsonSendingMessage . "]";       

         $sql = "UPDATE message_rooms SET message_rooms.messages = '$allMesages' WHERE id = $roomId";
         $connection->query($sql) or die($logger->error(mysqli_error($connection)));    
         $memcached->set("messages-$roomId-update","true",1200);     
    }