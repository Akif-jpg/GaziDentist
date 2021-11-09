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

   // create a log channel
   $log = new Logger('messageRoomCreator');
   $log->pushHandler(new StreamHandler('../../logs/connectRoom.log', Logger::INFO));

   
    if(isset($_GET['roomId'])){
        
        $roomId = $_GET['roomId'];
        $auth = false;
        session_start();
        if(isset($_SESSION['username'])){
            $getUsername = $_SESSION['username'];
            $log->info("connected rooms: ".$_SESSION['connectedRooms']);
            if(isset($_SESSION['connectedRooms']) && in_array($roomId,explode(",",$_SESSION['connectedRooms']))){      
                $log->info("zaten giriş yapılmış");          
                $auth = true;
            }else{
                $sql = "SELECT room_participiants FROM message_rooms WHERE id=$roomId";
                $results = $connection->query($sql) or die($log->error(mysqli_error($connection)));
                while($row = $results->fetch_assoc()){
                    $log->info(explode(",",$row['room_participiants'])[0]);
                    if(in_array($getUsername,explode(",",$row['room_participiants'])) or die($log->info("in array içinde hata var"))){
                        $log->info("doğruluk değeri: "."true");
                    }else{
                        $log->info("doğruluk değeri: "."false");
                    }
                    $log->info("username: ".$getUsername);
                    if( in_array($getUsername,explode(",",$row['room_participiants']))){
                        $log->info($row['room_participiants']);
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
            $log->info("auth sonrası işlemler");
            $sql = "SELECT messages,room_password FROM message_rooms WHERE id='$roomId'";
            $results = $connection->query($sql) or die($log->error(mysqli_error($connection)));
            $log->info("query gerçekleştirildi");
            $messages = "";
            $roomPassword = "";

            while($row = $results->fetch_assoc()){
                $messages = $row["messages"];
                $roomPassword = $row["room_password"];
            }
            $log->info("bilgiler veritabanından çekildi: ".$messages."  oda şifresi: ".$roomPassword);
            $encrypter = new \CodeZero\Encrypter\DefaultEncrypter($roomPassword);
            $messages = $encrypter->decrypt($messages);
            $log->info("decrypt edilmiş mesaj: ".$messages);
            echo $messages;
        }else{
            header("HTTP/1.1 403 Forbidden");
        }
    }