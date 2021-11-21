<?php include_once "../includes/header.php"?>
<?php include_once "../includes/navigation.php"?>
<?php include_once "../includes/db.php"?>
<?php include_once "../includes/consts.php"?>

<body>
    <script src="/ckeditor_4.16.2_standard/ckeditor/ckeditor.js"></script>


    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">

                    </h1>
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-dashboard"></i> <a href="/index.php">Anasayafa</a> </li>
                        <li class="active"> <i class="fa fa-file"></i>Yazı Paylaş</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <?php
                    if(isset($_SESSION['username'])){
                        $s_username = $_SESSION['username'];
                    }else{
                        setcookie("rdrctPath","content_editor/",time()+60*3,"/");
                        header("location: /login.php");
                    }
                    if(isset($_POST['create_post'])){
                        $post_title = $_POST['post_title'];
                        $post_category_id = $_POST['post_category'];
                        if($_SESSION['user_role'] == 'subscriber'){
                            $post_status = 'draft';
                        }else{
                            $post_status = $_POST['post_status'];
                        }
                        $temp = explode(".", $_FILES["image"]["name"]);

                        $allowedExts = array("png","jpeg","jpg");

                        $extension = end($temp);

                        if($_FILES['image']['size'] <= MAX_POST_IMAGE_SIZE &&  in_array($extension, $allowedExts)){
                            $post_image = $_FILES['image']['name'];
                            $post_image_temp = $_FILES['image']['tmp_name'];
                            move_uploaded_file($post_image_temp, "../images/post_pic/$post_image");
                        }
                        $post_tags = $_POST['post_tags'];
                        $post_content = $_POST['post_content'];
                        $post_date = date('D, F d, Y - h:i:s A');
                        $post_comment_count = 0;
                        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
                        $query .= "VALUES({$post_category_id},'{$post_title}','{$s_username}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}') ";
    
                        $create_post_query = mysqli_query($connection, $query) or die (mysqli_error($connection));                        
                        $p_id = mysqli_insert_id($connection);
                        header("location: /content_editor/successful_post.html");
                        
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" class="form-control" name="post_title">
                    </div>
                    <table class="table table-bordered table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="col-sm-2 control-label">Select Category</th>
                                <th class="col-sm-2 control-label">Post Author</th>
                                <th class="col-sm-2 control-label">Post Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="post_category" id="" class="form-control">
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $select_category = mysqli_query($connection, $query);                                           

                                            while($row = mysqli_fetch_assoc($select_category)){
                                                $cat_title = $row['cat_title'];
                                                $cat_id = $row['cat_id'];
                                                echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="post_author" id="disabledInput" disabled>
                                        <option>
                                            <?php echo $s_username; ?>
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                            switch($_SESSION['user_role']){
                                                case 'subscriber':{
                                        ?>
                                    <select name="post_status" id="" class="form-control" disabled>
                                        <option value="draft">Draft</option>
                                    </select>

                                    <?php
                                                break;
                                                }
                                                default:{
                                        ?>
                                    <select name="post_status" id="" class="form-control">
                                        <option value="draft" selected>Draft</option>
                                        <option value="publish">Publish</option>
                                    </select>
                                    <?php
                                                }
                                            }
                                        ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="post_tags">Tags</label>
                        <input type="text" class="form-control" name="post_tags">
                    </div>
                    <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea type="text" id="postEditor" name="post_content"></textarea>
                        <script>
                        CKEDITOR.replace('postEditor', {
                            language: 'tr',
                        });
                        </script>
                    </div>
                    <div class="btn-group btn-group-lg">
                        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once "../includes/sidebar.php"?>
    <?php include_once "../includes/footer.php"?>
</body>

</html>