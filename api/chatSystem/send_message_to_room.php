<?php 
   include_once "../../includes/db.php";  
   include_once "../../vendor/autoload.php"; 

    /*
    * Buradaki işlemler kullanıcı bir mesaj gönderdiği anda olacak olanları kapsar.
    * Buraya mesaj ve mesajın hangi odaya gönderildiği atılacak. O odadaki mesaj roomPassword ile decrypt edilecek.
    Daha sonrasında yeni gelen mesaj json dosyası olarak önceki mesajların üstüne kaydedilecek. Sonrasında mersaj 
    yeninden şifrelenip veritabanına yeniden yazılacak.
     */
    
   use Monolog\Logger;
   use Monolog\Handler\StreamHandler;

   $log = new Logger("messageSender");
   $log->pushHandler(new StreamHandler('../../logs/sendMessage.log', Logger::INFO));

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
        $result = $connection->query($sql);

        $allMesages = "";
        $roomPassword = "";

        while($row = $result->fetch_assoc()){
            $allMesages = $row["messages"];
            $roomPassword = $row["room_password"];
         }

         $encrypter = new \CodeZero\Encrypter\DefaultEncrypter($roomPassword);
         $decryptedAllMessages = $encrypter->decrypt($allMesages);
         $decryptedSendingMessages = substr($decryptedAllMessages,0,strlen($decryptedAllMessages)-1). "," . $jsonSendingMessage . "]";

         $log->info("sending message is $decryptedAllMessages");

         $encrpyptedSendingMessage =  $encrypter->encrypt($decryptedSendingMessages);

         $sql = "UPDATE message_rooms SET message_rooms.messages = '$encrpyptedSendingMessage' WHERE id = $roomId";
         $connection->query($sql);
    }