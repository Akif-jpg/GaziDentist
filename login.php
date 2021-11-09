<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>
<!--Page Content-->

<?php 
if(isset($_GET['header']))
	echo "<script> alert('{$_GET['msg']}') </script>";
?>

<link  href="css/login.css" rel="stylesheet" type="text/css">
<section class="container">	
		<div class="card">
			<div class="card-header">
				<h3>Giriş Yap</h3>				
			</div>
			<div class="card-body">
				<div>
				<form role="form" action="includes/login.php" method="post" id="login-form" autocomplete="off">
					<div class="form-group">
						<div class="input-group-prepend center">
							<div class="sideBySide">
								<label for="username" ><span style="font-size: 26px;" class="input-group-text"><i class="fa fa-user" ></i></span></label>
							</div>
							<div class="sideBySide">
								<input id="username" type="text" name="username" class="form-control" placeholder="Kullanıcı adı">
							</div>							
						</div>		
				
					</div>

					<div class="form-group">
						<div class="input-group-prepend center">
							<div class="sideBySide">
								<label for="password" ><span style="font-size: 26px;" class="input-group-text"><i class="fa fa-key" ></i></span></label>
							</div>
							<div class="sideBySide">
								<input id="password" type="password" name="password" class="form-control" placeholder="Şifre">
							</div>							
						</div>		
				
					</div>
										
					<div class="form-group">
						<input type="submit" name="login" value="Giriş Yap" class="btn float-right login_btn">
					</div>
				</form>				
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
				Bir hesaba sahip değil misin?<a href="/registration.php">Kayıt Ol</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Şifremi unuttum</a>
				</div>
		</div>
	</div>
</section>
<?php include "includes/footer.php";?>
