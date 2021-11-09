
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">    

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
                  
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                 <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> 
                 <span class="icon-bar"></span> <span class="icon-bar"></span> 
            </button>                     
                      <a class="navbar-brand" style="color:white;" href="/index.php"> <span><img src="/favicon.png" height="32"> Gazi Dentist </span></a> 
            </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                    if(isset($_SESSION['user_role'])){
                        $user_role = $_SESSION['user_role'];
                        if($user_role == 'admin') {
                            echo "<li><a href='/admin/index.php'>Yetkili Paneli</a></li>";
                        }elseif(($user_role == 'author')){
                            echo "<li><a href='/authors/index.php'>Yazar Paneli</a></li>";                                
                        }else{
                            echo "<li><a href='/info/webSiteRules.php'>Site Kuralları</a></li>";
                        }
                    } else {
                        echo "<li class='$login_class'><a href='/login.php'>Giriş</a></li>";
                        echo "<li class='$reg_class'><a href='/registration.php'>Kayıt</a></li>";
                    }
                ?>
                <?php
                    if(isset($_SESSION['user_role'])){
                        $user_role = $_SESSION['user_role'];
                        $username  = $_SESSION['username'];
                            if($user_role == 'admin') {
                                if(isset($_GET['p_id'])){
                                    $the_p_id = $_GET['p_id'];
                                        echo "<li><a href='/admin/posts.php?source=edit_post&p_id={$the_p_id}'>İçerik Editle</a></li>";
                                    } 
                             }
                     }
                ?>         
                
                <li><a href="/info/aboutUs.php">Hakkımızda</a></li>
                <li><a href="/info/privacyPollicy.php">Gizlilik Sözleşmesi</a></li>
                <li><a href='/contact.php'>İletişime Geçin</a></li>
            </ul>
            <form class="navbar-form navbar-right" action="/search.php" method="post">
                    <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                    <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search_submit">
                        <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
