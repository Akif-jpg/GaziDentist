<?php
//includes
include_once "../../includes/db.php";
include_once "../../vendor/autoload.php";

global $connection;

        /*
            Burada önce odanın id bilgisi bulunacak.
            Sonra kullanıcının bu odanın davetlileri arasında bulunup bulunmadığı sorgulanacak.
            Şayet kullanıcı odanın davetliler arasında değil ise 403 döndürülecek.
            Ama kullanıcı odanın sahipleri arasında ise mesaj içeriiği döndürülecek.

        */

    //setting logger
   //setting logger
   use Monolog\Logger;
   use Monolog\Handler\StreamHandler;

   // create a logger channel
   $logger = new Logger('messageRoomCreator');
   $logger->pushHandler(new StreamHandler('../../logs/chatSystem.log', Logger::INFO));

   
    if(isset($_GET['roomId'])){
        
        $roomId = $_GET['roomId'];
        $auth = false;
        session_start();
        if(isset($_SESSION['username'])){
            $getUsername = $_SESSION['username'];
            if(isset($_SESSION['connectedRooms']) && in_array($roomId,explode(",",$_SESSION['connectedRooms']))){                
                $auth = true;
            }else{
                $sql = "SELECT room_participiants FROM message_rooms WHERE id=$roomId";
                $results = $connection->query($sql) or die($logger->error(mysqli_error($connection)));
                while($row = $results->fetch_assoc()){                
                   if( in_array($getUsername,explode(",",$row['room_participiants']))){
                        $auth = true;
                        if(isset($_SESSION["connectedRooms"])){
                            $_SESSION['connectedRooms'] .= ",".$roomId;
                        }else{
                            $_SESSION['connectedRooms'] = $roomId;
                        }
                    }
                }
            }
        }

        if($auth){
            //Kullanıcıdan gelen oda id içerisindeki mesajlaşma bilgilerini ve onları encrypt edecek olan password'u alıyoruz.
            $logger->info("auth sonrası işlemler");
            $sql = "SELECT messages,room_password FROM message_rooms WHERE id='$roomId'";
            $results = $connection->query($sql) or die($logger->error(mysqli_error($connection)));
            $messages = "";
            $roomPassword = "";

            while($row = $results->fetch_assoc()){
                $messages = $row["messages"];
                $roomPassword = $row["room_password"];
            }
            $encrypter = new \CodeZero\Encrypter\DefaultEncrypter($roomPassword);
            $messages = $encrypter->decrypt($messages);
            echo $messages;
        }else{
            header("HTTP/1.1 403 Forbidden");
        }
    }