<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
<?php

// if(isset($_POST['register']))
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = trim($_POST['username']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $sex = trim($_POST['sex']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = ['username'=> '', 'firstname'=> '', 'lastname'=> '', 'sex'=> '', 'email'=> '','password'=> ''];
    if(strlen($username) < 4){
        $error['username'] = 'Username is too short, user longer than 4 charecter.';
    }
    if($username == ''){
        $error['username'] = 'Username can not be empty.';
    } 
    if(preg_match('/[^a-z0-9_-]+/i', $username)){
        $error['username'] = 'Username must only content alfanumurical desh and underscrol .';
    }
    
    if(username_exists($username)){
        $error['username'] = 'Username already exists, Pick another one.';
    }
    if($email == ''){
        $error['email'] = 'Email can not be empty.';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email is not Validate.';
    }

    if(email_exists($email)){
        $error['email'] = 'Email already exists, Pick another one.';
    }
    if($password == ''){
        $error['password'] = 'Password can not be empty.';
    }
    foreach($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }

    }
        if(empty($error)){        
        register_user($username, $firstname, $lastname, $sex, $email, $password);
        login_user($username, $password);
        }

}

?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!--styles-->
    <link rel="stylesheet" type="text/css" href="/css/registration.css">
    <!-- Page Content -->
    <div class="field">
        <div class="wrapper">
            <div class="inner">
                <section class="content" horizantal layout>
                    <div class="imageHolder">
                        <img src="/images/registration.jpg" alt="image" height="300px;">                
                    </div>
                    <div class="formWrapper">
                    <form role="form" action="" method="post" id="login-form" autocomplete="on">
                            <div class="formGroup">
                                <input type="text" placeholder="Adınız" name="firstname" required>
                                <input type="text" placeholder="Soyadınız" name="lastname" required>                         
                            </div> 
                            <p>
                                <?php echo isset($error['firstname']) ? $error['firstname'] : '' ; ?>
                                
                                <?php echo "<br>" . isset($error['lastname']) ? $error['lastname'] : '' ; ?>                                
                            </p>                           

                            <div class="formGroup">
                                <input type="text" placeholder="Kullanıcı adı" name="username" required> 
                                <input type="email" placeholder="email" name="email" required>                                                   
                            </div>

                            <p>
                                <?php echo isset($error['username']) ? $error['username'] : '' ; ?>
                                
                                <?php echo "<br>" . isset($error['email']) ? $error['email'] : '' ; ?>
                            </p>

                            <div class="formGroup">
                                <input type="password" placeholder="Şifre" name="password" id="password" required> 
                                <input type="password" placeholder="Şifrenizi onaylayın" id="confirm_password" required>                                                   
                            </div>

                            <p>
                                <?php echo isset($error['password']) ? $error['password'] : '' ; ?>
                            </p>

                            <div class="formControl"> 
                                <label for="selectSex">Cinsiyetinizi Seçiniz: </label>                                                
                                <select id="selectSex" name=”sex”>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <p>
                                <?php echo isset($error['sex']) ? $error['sex'] : '' ; ?>
                            </p>
                            
                            <input id="submitButton" name="register" type="submit" value="Kayıt Ol">
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </div>
            <!--Script source-->
            <script src="/js/registration.js"></script>

            <?php include "includes/footer.php";?>
