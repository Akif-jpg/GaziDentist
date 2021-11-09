<?php include_once "../../includes/db.php"?>
<?php include_once "../../admin/includes/functions.php"?>
<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
    if(isset($_SESSION['username'])){
        $getUsername = $_SESSION['username'];
        $sql = "SELECT user_message_rooms FROM users where username='$getUsername'";
        global $connection;
        $results = $connection->query($sql);
        $messageRoomsId = "";
        while($row = $results->fetch_assoc()){
            $messageRoomsId =  $row['user_message_rooms'];
        }
        
        $sql = "SELECT id,room_title FROM message_rooms WHERE id in ($messageRoomsId) ";

                
        $results = $connection->query($sql) or die(mysqli_error($connection));
        $messageRooms = array();
        while($row = $results->fetch_assoc()){
            $id = $row['id'];
            $title = $row['room_title'];  
            $messageRooms[] = array(
                "id"=>$id,
                "title"=>$title
            );
        }     
        
            
        if($messageRooms != null){
            echo json_encode($messageRooms); 
        }else{
            echo '[]';
        }      
    }
    else{
        echo '[]';
    }