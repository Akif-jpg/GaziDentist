<?php
    //includes
    include_once "../../includes/db.php";
    include_once "../../vendor/autoload.php";

    //header
    header('Content-Type: application/json');

    global $connection;

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    //Loglamalar için logger hazırlandı
    $logger = new Logger('user_received_request');
    $logger->pushHandler(new StreamHandler('../../logs/friendSystem.log',Logger::DEBUG));

    //Sessionı başlatıp geçerli kullanıcının usernmame bilgisini alıyoruz.
    session_start();
    $username = $_SESSION['username'];

    //Veritabanından kullanıcının teslim alınan arkadaşlık isteklerini çekiyoruz.
    string:  $sql = "SELECT received_request FROM friends WHERE username='{$username}'";
    $result = $connection->query($sql) or die($logger->error(mysqli_error($connection)));
    $result_array = array();
    while($row = $result->fetch_assoc()){
        $result_array[] = $row["received_request"];
    }
   
    echo json_encode($result_array);
     