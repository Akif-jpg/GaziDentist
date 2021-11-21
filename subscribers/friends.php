<?php 
    //Header, veritabanı bağlantısı ve üst barın include edilmesi işlemleri
    include_once "../includes/header.php";
    include_once "../includes/navigation.php";
    include_once "../includes/db.php";

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        setcookie("rdrctPath","subscribers/friends.php",time()+60*3,"/");
        header("location: /login.php");
    }
   
    session_start();
    $username = $_SESSION['username'];

    //Kişinin arkadaşlık kurduğu kişiler veriabanından çekecek olan sorgu.
    $sql = "SELECT friend_ls FROM friends WHERE username='$username' ";
    $results = $connection->query($sql) or die("Veritabanından arkadaşlık sistemine ulaşma işlemi başarısızlıkla sonuçlandı. Bu  durum için üzgünüz...");
    $friends = "";
    while($row = $results->fetch_assoc()){
        $friends = $row['friend_ls'];
    }

    $friendList = explode(",",$friends);
    ?>
    <div class="container">
            <div class="row">
    <?php
    for($i = 1;$i < count($friendList);$i++){
        ?>
        
                <div class="col-md-10 w3-padding-xxlarge w3-light-gray w3-text-black w3-hover-black w3-hover-text-light-gray"
                 onclick=<?php echo "\"window.location.href= '/profile.php?user={$friendList[$i]}'\""; ?> >
                    <div style="justify-content: center; display: flex; ">
                        <div style="display: flex;;">
                            <div class="w3-show-inline-block">
                                <?php
                                    $sql = "SELECT user_image , user_role FROM users WHERE username = '{$friendList[$i]}'";
                                    $results = $connection->query($sql);
                                    $image = "";
                                    while($row = $results->fetch_assoc()){
                                        $image = $row['user_image'];
                                        $user_role = $row['user_role'];
                                    }
                                    
                                if($image == null||!isset($image)||strlen($image)<=3){
                                        if(strtolower($user_role)  != "admin"){
                                            switch(strtolower($user_role)){
                                                case 'male':{
                                                    $image = "img_avatar2.png";
                                                    break;
                                                }
                                                case 'female':{
                                                    $image = "img_avatar4.png";
                                                        break;
                                                }
                                                default:{
                                                    $image = "businessman-607834_640.png";
                                                        break;
                                                }
                                            }
                                        }else{
                                            $image = "admin.png";
                                        }
                                    
                                    }  
                                    echo "<img class=\"img-circle\"height=\"70px\" src=\"/images/user_pic/$image\">";                      

                                ?>
                            </div>
                            <div class="w3-show-inlne-block;" style="padding-top: 25px;">
                                <div style="display: inline-block;">
                                    <strong class="w3-padding-left"><?php echo $friendList[$i] . " kişisinin profilini görüntüle."; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
        <?php
       
    } 
    ?>
        </div>
    </div>
    <?php

    //sidebar ve footer include edilmesi işlemleri.
    include_once "../includes/sidebar.php";
    include_once "../includes/footer.php";