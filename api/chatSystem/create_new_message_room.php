<?php

//imported required libraries
include_once "../../vendor/autoload.php";
include_once "../../includes/db.php";

global $connection;

?>

<?php
    
    //setting logger
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    // create a log channel
    $log = new Logger('messageRoomCreator');
    $log->pushHandler(new StreamHandler('../../logs/messageRoom.log', Logger::INFO));


    
    //random string generated for key of message room
    $factory = new RandomLib\Factory;
    $generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
    $randomString = $generator->generateString(12, 'abcdefghijklmnoprsituvyz123456789');
    $log->info("random string üretildi:     ".$randomString);
   
    //generated encrypter for encrytion of messages
    $encrypter = new \CodeZero\Encrypter\DefaultEncrypter($randomString);
    //get date of today
    $today = date("d/m/Y H:i:s");
    //message encrypted by encrypter
    $message = $encrypter->encrypt('[{"sender":"Sistem",
        "message":"Odanız başarılı bir şekilde oluşturulmuştur buradan mesajlaşabilirsiniz.",
        "date":'. '"' ."$today" .'"' . '
    }]'); 
    $log->info("ilgili mesaj encrypt edildi:    ".$message);

    //Session started
    session_start();
   
    if(isset($_SESSION['username'])){
        //get username
        $getUsername = $_SESSION['username'];    
        //get title and particiants from post
        $log->info("kullanıcı ismi alındı:  ".$getUsername);
        $roomTitle = $_POST['roomTitle'];
        if(isset($_POST['participants'])&&$_POST['participants'] != null && $_POST['participants'] != ""){
            $roomParticipiants = $_POST['participants'];
        }else{
            $roomParticipiants = $getUsername;
        }
        $log->info("post bilgileri teslim alındı:  ".$roomTitle." & ".$roomParticipiants);
        //create a new room
        $sql = "INSERT INTO message_rooms (room_title,room_participiants,room_password,room_owner_username,messages) VALUES ('$roomTitle','$roomParticipiants','$randomString','$getUsername','$message')";
        $connection->query($sql) or die($log->error(mysqli_error($connection)));
    
         $log->info("Sohbet odası oluşturuldu");
    
        $sql = "SELECT id FROM message_rooms WHERE room_password='$randomString' ORDER BY id DESC";
        $results = $connection->query($sql) or die ($log->error(mysqli_error($connection)));
        $roomID;
        while($row = $results->fetch_assoc()){
            $roomID = $row["id"];
        }

        $log->info("mesaj odasının id bilgisi alındı.");
    
        $sql = "SELECT user_message_rooms FROM users WHERE username='$getUsername'";
        $results = $connection->query($sql) or die ($log->error(mysqli_error($connection)));
        $otherIDS;
        while($row = $results->fetch_assoc()){
            $otherIDS = $row['user_message_rooms'];
        }

        $log->info("kullanıcının sahip olduğu diğer id bilgileri alındı.");
    
        if($otherIDS != null){
            $allIds = $otherIDS.",".$roomID;
        }else{
            $allIds = $roomID;
        }


        $log->info("allIds belirlendi: ".$allIds);     
        
    
       
        //set room id to users.user_message_rooms
        $sql = "UPDATE users SET users.user_message_rooms= '$allIds' WHERE username='$getUsername'";
        $connection->query($sql);
    
        $log->info("------------------Operasyonlar Bitti----------------------");
    }else{
        $log->info("login olmadığı için işlemler yapılmadı.");
        header('HTTP/1.1 403 Forbidden');
    }
