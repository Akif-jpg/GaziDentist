<!-- Including Header PHP -->
<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-10">
            <?php
            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $message = '';
                 $query = "UPDATE posts SET post_views_count = post_views_count+1 WHERE post_id = $the_post_id ";
                 $update_post_views_count = mysqli_query($connection, $query);
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                } else {
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'publish' ";
                }
            $select_all_posts_query = mysqli_query($connection,$query);
                if(mysqli_num_rows($select_all_posts_query) < 1){
                    echo "<center><div class='alert alert-info'><strong>Üzgünüz! </strong>Paylaşım ulaşılabilir durumda değil.....</div></center>";
                } else{
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_tags  = $row['post_tags'];
                        $post_content = $row['post_content'];
            ?>
            <!-- First Blog Post -->
            <h2> <a href="#"> <?php echo $post_title; ?> </a> </h2>

            <p class="lead"> by
                <a href="author_post.php?author=<?php echo $post_author; ?>">
                    <?php echo $post_author; ?>
                </a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on
                <?php echo $post_date; ?>
            </p>
            <p> <span>
                    <?php //select interest based on comma and generet random classs
                                    $tags = $post_tags;
                                    $tags = explode(',',$tags);
                                    foreach ($tags as $tag) {
                                        $classes = array('primary','default','success','info','warning','danger');
                                        $class = array_rand($classes);
                                        echo "<span class='label label-$classes[$class]'>$tag</span>";
                                    }
                            ?>

                </span> </p>
            <hr> <img class="img-responsive" src="images/post_pic/<?php echo $post_image; ?>" alt="">
            <hr>
            <p>
                <?php echo $post_content; ?>
            </p>
            <hr>
            <?php }
                 ?>
            <!-- Blog Comments -->
            <!-- Comments Form -->
            <?php
                    if(isset($_POST['create_comment'])){
                        $comment_post_id = $_GET['p_id'];
                        $comment_author = $_SESSION['username'];
                        $comment_email = $_SESSION['email'];
                        $author_type = $_SESSION['user_role'];
                        $comment_content = $_POST['comment_content'];                        

                        $comment_date = date("d/m/Y H:i:s");

                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) && !empty($author_type)){
                            $query = "INSERT INTO comments (author_type, comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $query .= "VALUES (\"$author_type\", $comment_post_id, \"$comment_author\", \"$comment_email\", \"$comment_content\", \"approve\", \"$comment_date\")";
                            mysqli_query($connection, $query) or die ('Faild' . mysqli_error($connection));
                                
                        // Comment count updating query
                        $query = "UPDATE posts SET post_comment_count = post_comment_count+1 WHERE post_id = $comment_post_id ";
                        $update_comment_count = mysqli_query($connection, $query); 

                        } else {

                            echo "<script>alert('Fields can not be empty!')</script>";
                        }

                    } else {
                        $message = "";
                    }
                      ?>
            <div class='well'>
                <?php
                        if($message !== ''){
                            echo "<div class='alert alert-success'><strong>Comment Added!</strong>  ".$message."</div>";
                        }
                        ?>


                <?php
                        if(isset($_SESSION['username'])){
                            echo "
                            <h4>Leave a Comment:</h4>
                            <form role='form' action='' method='post'>
                                <div class='form-group'>
                                    <label for='comment'>Comment</label><br>
                                    <textarea class='form-control' rows='3' name='comment_content'></textarea>
                                </div>
                                <button type='submit' class='btn btn-primary' name='create_comment'>Submit</button>
                            </form>
                            "; 
                    }
                        else {
                            echo "<h4>Yorum bırakmak için üye olmalısınız:</h4>";
                        }
                        ?> </div>
            <hr>
            <!-- Posted Comments -->
            <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id AND comment_status = 'approve' ORDER BY comment_id DESC";
                    $select_comment_query = mysqli_query($connection,$query);
                   
                    while($row = mysqli_fetch_array($select_comment_query)){
                    $comment_author = $row['comment_author'];
                    $author_type = $row['author_type'];
                    $comment_content = $row['comment_content'];
                    $comment_reply = $row['comment_reply'];
                    $comment_reply_date = $row['comment_reply_date'];
                    $comment_date = $row['comment_date'];

                    $query2 = "SELECT user_image,user_sex,user_role FROM users WHERE username  = '{$comment_author}' ";
                    $select_image = mysqli_query($connection, $query2);
                    $row2 = mysqli_fetch_array($select_image);
                    $author_image = $row2['user_image'];

                   if(empty($author_image)){
                        if($row2['user_role']  != "admin"){
                            switch(strtolower($row2['user_sex'])){
                                case 'male':{
                                    $author_image = "img_avatar2.png";
                                    break;
                                }
                                case 'female':{
                                    $author_image = "img_avatar4.png";
                                        break;
                                }
                                default:{
                                    $author_image = "businessman-607834_640.png";
                                        break;
                                }
                            }
                        }else{
                            $author_image = "admin.png";
                        }
                    
                    }                   
                   
                       ?>
            <!-- Comment -->
            <div class="media">
                <div class="media-left"> <img src=<?php echo "/images/user_pic/$author_image"; ?> class="media-object"
                        style="width:45px; height: 45px; border-radius:50%;"> </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <?php echo "<b>$comment_author</b>"; ?><small><i> (Posted on
                                <?php echo $comment_date; ?>)</i></small></h4>
                    <p>
                        <?php echo $comment_content; ?>
                    </p>
                    <?php
                            if(!empty($comment_reply)){
                                echo "<div class='media'>
                                    <div class='media-left'> <img src='/images/user_pic/admin.png' class='media-object' style='width:45px; height: 45px; border-radius:50%;'> </div>
                                    <div class='media-body'>
                                    <h4 class='media-heading'><b style='color:red;'>Admin</b> <small><i>(Replied on $comment_reply_date)</i></small></h4>
                                    <p>{$comment_reply}</p>
                                        </div>
                                        </div>";
                            }
                            ?>
                </div>
            </div>
            <?php 
                    } 
                }
            } else {
                header("Location: index.php");
            } ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include_once "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
    <!-- Including Footer PHP -->
    <?php include_once "includes/footer.php"; ?>