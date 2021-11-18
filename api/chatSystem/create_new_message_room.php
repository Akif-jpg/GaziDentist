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

    // create a logger channel
    $logger = new Logger('messageRoomCreator');
    $logger->pushHandler(new StreamHandler('../../logs/chatSystem.log', Logger::INFO));


    
    //get date of today
    $today = date("d/m/Y H:i:s");

    //Belki ileride mesajları encrpyt edebilirim.
    $factory = new RandomLib\Factory;
    $generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
    $randomString = $generator->generateString(8, 'abcdefghijklmnoprsituvyz123456789');

    //prepared message encrypter
    $encrypter = new \CodeZero\Encrypter\DefaultEncrypter($randomString);
    //message encrypted by encrypter
    $message = $encrypter->encrypt('[{"sender":"Sistem",
        "message":"Odanız başarılı bir şekilde oluşturulmuştur buradan mesajlaşabilirsiniz.",
        "date":'. '"' ."$today" .'"' . '
    }]'); 

    //Session started
    session_start();
   
    if(isset($_SESSION['username'])){
        //get username
        $getUsername = $_SESSION['username'];    
        //get title and particiants from post
          $roomTitle = $_POST['roomTitle'];
        if(isset($_POST['participants'])&&$_POST['participants'] != null && $_POST['participants'] != ""){
            $roomParticipiants = $_POST['participants'];
        }else{
            $roomParticipiants = $getUsername;
        }
          //create a new room
        $sql = "INSERT INTO message_rooms (room_title,room_participiants,room_password,room_owner_username,messages) VALUES ('$roomTitle','$roomParticipiants','$randomString','$getUsername','$message')";
        $connection->query($sql) or die($logger->error(mysqli_error($connection)));
    
        $sql = "SELECT id FROM message_rooms WHERE room_password='$randomString' ORDER BY id DESC";
        $results = $connection->query($sql) or die ($logger->error(mysqli_error($connection)));
        $roomID;
        while($row = $results->fetch_assoc()){
            $roomID = $row["id"];
        }

        $logger->info("mesaj odasının id bilgisi alındı.");
    
        $sql = "SELECT user_message_rooms FROM users WHERE username='$getUsername'";
        $results = $connection->query($sql) or die ($logger->error(mysqli_error($connection)));
        $otherIDS;
        while($row = $results->fetch_assoc()){
            $otherIDS = $row['user_message_rooms'];
        }
    
        if($otherIDS != null){
            $allIds = $otherIDS.",".$roomID;
        }else{
            $allIds = $roomID;
        }        
       
        //set room id to users.user_message_rooms
        $sql = "UPDATE users SET users.user_message_rooms= '$allIds' WHERE username='$getUsername'";
        $connection->query($sql) or die($logger->error(mysqli_error($connection)));
    
        $logger->info("------------------Operasyonlar Bitti----------------------");
    }else{
        $logger->info("login olmadığı için işlemler yapılmadı.");
        header('HTTP/1.1 403 Forbidden');
    }
