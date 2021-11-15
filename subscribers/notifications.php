<?php include_once "../includes/header.php"?>
<?php include_once "../includes/navigation.php"?>
<?php include_once "../includes/db.php"?>

<?php
    //Kullanıcı giriş yapmış mı?
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        setcookie("rdrctPath","subscribers/notifications.php",time()+60*3,"/");
        header("location: /login.php");
    }
       
?>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <?php
                    $per_page = 5;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else {
                        $page = "";
                    }

                    if($page == "" || $page == 1){
                        $page_1 = 0;
                    }else {
                        $page_1 = ($page * $per_page) - $per_page;
                }
                ?>
                <?php                    
                    $post_query_count = "SELECT Count(*) as count FROM user_inbox WHERE msg_sent = '$username'";
                    
                    $find_count = mysqli_query($connection, $post_query_count);
                    while($row = $find_count->fetch_assoc()){
                        $count = $row['count'];
                    }                
                    if($count < 1){
                        echo "<center><div class='alert alert-info'><strong>:'(</strong> Herhangi Bir Mesajınız Yok...</div></center>";
                    }
                    else {
                    $count = ceil($count / 5);
                    $query = "SELECT * FROM user_inbox WHERE msg_sent='$username' ORDER BY msg_id DESC  LIMIT $page_1,$per_page";
                    $select_all_messages_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_messages_query)){
                        $msg_id = $row['msg_id'];
                        $msg_subject = $row['msg_subject'];
                        $msg_author = $row['msg_author'];
                        $msg_date = $row['msg_date'];                  
                        $msg_content = $row['msg_content'];
                        $msg_status = $row['msg_reply_status'];
                ?>
                        <div style="justify-content:center;display:flex;">
                            <div class="w3-show-inline-block">
                                <p>
                                    <h2 class="w3-show-inline-block">                            
                                        <?php echo $msg_subject; ?> 
                                    </h2>
                                    <p class="lead w3-show-inline-block"> (gönderen
                                        <a href="/profile.php?user=<?php echo $msg_author; ?>">
                                            <?php echo $msg_author; ?> 
                                        </a>)                         
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> gönderim tarihi:&nbsp; 
                                        <?php echo $msg_date; ?>
                                    </p>                  
                                </p>
                                <p>
                                        <?php echo $msg_content; ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <?php 
                            } 
                        }
                        ?>
                        <!-- Pager -->
                        <center>
                            <ul class="pagination pagination-lg">
                                <?php
                        for($i = 1; $i <= $count; $i++){
                            if($i == $page){
                                echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        ?>
                            </ul>
                        </center>
            </div>
        </div>
    </div>
<!-- script sources -->
<script src="/js/friendship_operations.js"></script>

<?php include_once "../includes/sidebar.php"?>
<?php include_once "../includes/footer.php"?>