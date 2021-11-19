<div style="margin-bottom: 600px;">
    <div class="w3-sidenav w3-border-right w3-collapse w3-animate-left w3-animate-opacity" style="left: 0px;" id="mySideBar">    
        <div class="topRSideDiv">
            <button class="w3-btn-floating w3-hide-large w3-red fa fa-close" onclick="closeNav()"> </button>
        </div>   
        <div class="w3-container">
            <div class="w3-row w3-padding-medium">
                <div class="w3-tag w3-white w3-padding-xxlarge">
                    <?php
                        if(isset($_SESSION["username"])){
                            $username = $_SESSION['username'];
                            $sql = "SELECT * FROM users WHERE username= '{$username}'";
                            global $connection;
                            $currentUser = $connection->query($sql);
                            $image = "";
                            $firstname = "";
                            $lastname = "";
                            while($row = mysqli_fetch_assoc($currentUser)){
                                $firstname = $row['user_firstname'];
                                $lastname = $row['user_lastname'];
                                if($row['user_image'] != null&&isset($row['user_image'])&&strlen($row['user_image'])>3){
                                    $image = $row['user_image'];
                                    
                                }else{
                                    if(strtolower($row['user_role'])  != "admin"){
                                        switch(strtolower($row['user_sex'])){
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
                            }
                        }else{

                            $image = "guest.png";
                        }

                        
                        $imagePath = "/images/user_pic/". $image;                
                    ?>

                    <img class="userPorfileImage" src="<?php echo $imagePath?>" alt="<?php echo $imagePath?>">
                    <div class="w3-padding-tiny">
                        <p><?php echo $firstname.' '.$lastname?></p>
                        <div class="w3-dropdown-hover">
                            <button class="w3-btn-block">
                                <h4 class="boldHeader">PROFİL</h4>                        
                            </button>
                            <div class="w3-dropdown-content w3-bar-block w3-border">
                                <a href="/subscribers/user_profile.php" class="w3-bar-item">Profile Git</a>
                                <a href="/subscribers/friends.php" class="w3-bar-item">Arkadaşlar</a>
                                <a href="/subscribers/notifications.php" class="w3-bar-item">Bildirimler</a>
                                <a href="/logout.php" class="w3-bar-item w3-btn-block w3-red">Çıkış</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-container">
                    <div class="w3-dropdown-click w3-display-container w3-padding-top">
                        <button class="w3-btn-block w3-white w3-border-2 w3-border-yellow" onclick="openCat()">Kategoriler</button>
                        <div class="w3-dropdown-content w3-animate-bottom" id="catList">
                            <ul class="w3-ul w3-center">
                                <?php
                                    $sql= "SELECT * FROM categories ORDER BY cat_id DESC";
                                    $results = $connection->query($sql);

                                    $cat = array();
                                    while($row = mysqli_fetch_assoc($results)){
                                        $catId = $row['cat_id'];
                                        $catTitle = $row['cat_title'];
                                        $catArray[] = array(
                                            "catId" => $catId,
                                            "catTitle" => $catTitle
                                        );
                                            
                                    }

                                    foreach($catArray as $value){
                                        ?>
                                        <li>
                                            <a class="w3-hover-amber sofiaFont" href="<?php echo 'category.php?category='.$value['catId']?>">
                                                <?php echo $value["catTitle"]?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>   
                    <div class="w3-dropdown-click w3-display-container w3-padding-top">
                        <button class="w3-btn-block w3-white w3-border-2 w3-border-cyan" onclick="openLastP()">Son Paylaşımlar</button>
                        <div class="w3-dropdown-content w3-animate-bottom" id="lastPosts">
                            <ul class="w3-ul w3-center">
                                <?php
                                    $sql = "SELECT * FROM posts WHERE post_status = 'publish' ORDER BY post_id DESC LIMIT 5";
                                    $lastPosts = $connection->query($sql);

                                    while($rowLastPosts = mysqli_fetch_assoc($lastPosts)){
                                        ?>
                                        <li>
                                            <a class="w3-hover-cyan sofiaFont" href=<?php echo "/post.php?p_id=".$rowLastPosts['post_id']?>>
                                                <?php echo $rowLastPosts['post_title']?>
                                            </a>
                                        </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div> 
                    <div class="w3-dropdown-click w3-display-container w3-padding-top">
                        <button class="w3-btn-block w3-white w3-border-2 w3-border-red" onclick="openFriendsP()">Arkadaşların Paylaşımları</button>
                        <div class="w3-dropdown-content w3-animate-bottom" id="subscription">
                            <ul class="w3-ul w3-center">
                                    <?php
                                        $sql = "SELECT friend_ls FROM friends WHERE username=\"$username\"";
                                        $results =  mysqli_query($connection,$sql);
                                        $friends = "";
                                        while($row = mysqli_fetch_assoc($results)){
                                            $friends = $row['friend_ls'];
                                        }

                                        $friendArray = explode(",",$friends);
                                        $arrCount = count($friendArray);

                                        $friendList = "";
                                        for($index = 1;$index < $arrCount;$index++){
                                            $friendList .= "post_author=\"$friendArray[$index]\" OR ";
                                        }      
                                        
                                        $friendList = substr($friendList,0,strlen($friendList)-4);
                                        $sql = "SELECT post_id,post_title FROM posts WHERE " . $friendList ;                                        
                                        $posts = mysqli_query($connection,$sql) or die ($logger->error(mysqli_error($connection)));
                                        while($rowFriendPost = mysqli_fetch_assoc($posts)){
                                            ?>
                                            <li>
                                                <a class="w3-hover-cyan sofiaFont" href=<?php echo "/post.php?p_id=".$rowFriendPost['post_id']?>>
                                                    <?php echo $rowFriendPost['post_title']?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    ?>
                            </ul>
                        </div>
                    </div>
                    <img height="100px">
                </div>
                <!-- Beğeni sistemi gelince en çok beğenilenler de eklenecek-->
            </div>          
        </div>  
   </div>  
    <div class="topLSideDiv">
        <button class="w3-btn-block" onclick="openNav()">
            &#9776;
        </button>
    </div>
</div>

<script src="/js/sideBar.js"></script>