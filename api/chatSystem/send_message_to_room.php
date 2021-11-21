<?php 
   include_once "../../includes/db.php";  
   include_once "../../includes/memcache.php";
   include_once "../../vendor/autoload.php"; 
   include_once "../../includes/consts.php";

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

   
   if(isset($sender)//Eğer gönderen kişinin kim olduğu,
   &&isset($roomId)//gönderilecek oda 
   &&isset($sendingMessage)//ve gönderilen mesaj set edilmişse
   &&in_array($roomId,explode(",",$_SESSION['connectedRooms'])))// ve gönderen kişinin bağlanma yetkisi varsa.
   {
        if((strlen($sendingMessage) - MAX_MESSAGE_LENGTH)>0){
            $sendingMessage = substr($sendingMessage,0,MAX_MESSAGE_LENGTH);
        }
        //Gönderilecek mesaj json formatına dönüştürülür.
        $jsonSendingMessage = "{\"sender\" : \"{$sender}\" ,
        \"message\" : \"{$sendingMessage}\",
        \"date\" : \"{$now}\" }";
      //sql veritabanından odanın şifresi alınır. Not: bu da ramde saklanabilirdi.
        $sql = "SELECT room_password FROM message_rooms WHERE id=$roomId";
        $result = $connection->query($sql) or die($logger->error(mysqli_error($connection)));
        $roomPassword = "";
        while($row = $result->fetch_assoc()){  
          $roomPassword = $row["room_password"];
         
       }
      //O ana kadar ki olan mesajlaşmalar ramden alınır.
        $allMesages = $memcached->get("messages-$roomId");        
        $allMesagesArray = json_decode($allMesages);
       //Silinecek olan mesajlaşma sayısı belirlenir
        $willDelete = count($allMesagesArray) - MAX_CHAT_SIZE;
       //Fazla olan mesajlar silinir.
        $allMesagesArray = array_slice($allMesagesArray,$willDelete,count($allMesagesArray));
        //Tüm mesajlar tekrardan stringe çevrilir.
        $allMesages = json_encode($allMesagesArray);
       
        //Yeni mesaj eski mesajların üstüne eklenir.
        $allMesages = substr($allMesages,0,strlen($allMesages)-1). "," . $jsonSendingMessage . "]";     
        $memcached->set("messages-$roomId",$allMesages,1200);  
        
        //Mesajlar şifrelenir ve öyle veritabanında saklanır.. 
        $encrypter = new \CodeZero\Encrypter\DefaultEncrypter($roomPassword);
        $allMesages = $encrypter ->encrypt($allMesages);
        $sql = "UPDATE message_rooms SET message_rooms.messages = '$allMesages' WHERE id = $roomId";
        $connection->query($sql) or die($logger->error(mysqli_error($connection))); 
    }