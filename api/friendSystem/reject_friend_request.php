<?php   
    //Buraya arakdaşlık isteğinin kabul edilmesi ile ilgili şeyler gelecek.
    //Daha sonrasında arkadaşlık isteğinin gönderildiği ilgili mesajlar düzenlenecek ki kullanıcının karşısına tekrar tekrar çıkmasınlar.

    //includes
    include_once "../../vendor/autoload.php";
    include_once "../../includes/db.php";

    use \Monolog\Logger;
    use \Monolog\Handler\StreamHandler;

    $logger = new Logger('accept_friend_request');
    $logger->pushHandler(new StreamHandler('../../logs/frinedSystem.log'));
    
    $requestedUser = $_POST['requestedUser'];
    
    //Session started
    session_start();
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];
    $logger->info("username teslim alındı");

    $sql = "SELECT friend_request FROM friends WHERE username='$requestedUser';";

    $results = $connection->query($sql) or die ("SELECT friend_request FROM friends WHERE username = '$requestedUser';".$logger->error(mysqli_error($connection)));

    $frndRqstOfRqstedUser = "";
    try{
        while($row = $results->fetch_assoc()){
            $frndRqstOfRqstedUser = $row['friend_request'];
        }
    }catch (exception $e) {
       $logger->error($e);
    }
    $requestList = explode(",",$frndRqstOfRqstedUser);

    //Eğer bu kullanıcı istenen kişiye önceden arkadaşlık isteği göndermişse diyoruz.
    //Bunun sebebi kişinin kafasına göre birisini arkadaş olarak eklemesini engellemek.
    if(in_array($username,$requestList)){
        //Bu kullanıcı requestedUser ın arkadaş listesine eklendi
        $newRequestList = "";
        for ($index = 0; $index < count($requestList); $index++) {
            if($requestList[$index] != $username){
                $newRequestList .= $requestList[$index];
            }
        } 
        //Arkadaşlık isteği onaylandığı için çıkartılıyor.
        $sql = "UPDATE friends SET friend_request=\"$newRequestList\" WHERE username=\"$requestedUser\";";
        $connection->query($sql) or ("UPDATE friends SET friend_request=\"$newRequestList\" WHERE username=\"$requestedUser\";".$logger->error(mysqli_error($connection)));

        //Arkadaşlık isteğinin reddedildiğini user_inbox içerisinden güncelleyeceğiz.
        $sql = 
        "SELECT msg_id FROM user_inbox            
            WHERE 
            (msg_subject = \"Arkadaşlık isteği\")
            AND
            (msg_author = \"$requestedUser\") 
            AND 
            (msg_sent=\"$username\")";

        $logger->info($sql);

        $results = $connection->query($sql) 
        or die($logger->error(
        "SELECT msg_id FROM user_inbox ...msg_author=\"$requestedUser\...msg_sent=\"$username\";" .
         mysqli_error($connection)));

        while($row = $results->fetch_assoc()){
            $sql = "UPDATE user_inbox 
            SET 
            msg_content=\"$requestedUser tarafından gönderilen arkadaşlık isteğini reddettiniz.\",
            msg_reply_status=\"approved\"
            WHERE msg_id={$row['msg_id']};";
            $connection->query($sql) or die ($logger->error("UPDATE user_inbox ... WHERE msg_id={$row['msg_id']};".mysqli_error($connection)));
        }
        $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO user_inbox (msg_sent,msg_author_id,msg_author,msg_subject,msg_content,msg_date,msg_reply_status)
        VALUES 
            ('{$requestedUser}',
            '{$userId}',
            '{$username}',
            'Arkadaşlık İsteğin Reddedildi',
            '$username kişisine gönderdiğin arkadaşlık isteği reddedildi.',
                '$now',
                'unread'
                )";
        $connection->query($sql) or ($logger->error("INSERT INTO... FROM $username TO $requestedUser; ".mysqli_error($connection)));
    }else{
        $logger->warning("hatalı arkadaşlık reddi");
    }