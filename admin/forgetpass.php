<?php
include '../lib/Session.php';
Session::checkLogin();
?>
<?php  include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php

$db=new Database();
$fm= new Format();


?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content"><?php
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $email=$fm->validation($_POST['email']);
                $email=mysqli_real_escape_string($db->link,$email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo "Invalid E- mail";
                } else {

                  $mailquery="SELECT * from tbl_user WHERE email='$email'";
                  $mailcheck=$db->select($mailquery);
                if ($mailcheck !=false){
                  while ($value=$mailcheck->fetch_assoc()) {
                    $userid=$value['id'];
                    $username=$value['username'];
                  }
                    $text=substr($email,0,3);
                    $rand=rand(10000,99999);
                    $newpass="$text$rand";
                    $password=md5($newpass);
                    $updatequery="UPDATE tbl_user SET password='$password' WHERE id='$userid'";
                    $to=$email;
                    $from="no-reply@kaktarua.me";
                    $headers="From: $from\n";
                    $headers.='MIME-Version:1.0'."\r\n";
                    $headers.='Content-type:text/html; charset=iso-8859-1'."\r\n";
                    $subject="Your New Password";
                    $message="Your username is".$username."new password is:".$newpass."please visit website to login";
                    $sendmail=mail($to,$subject,$message,$headers);
                    if ($sendmail) {
                      echo "<span style='color:green;font-size=18px;'>Please check your Email!</span>";
                    }

                  } else{

                    echo "<span style='color:red;font-size=18px;'>Email Doesn't Exists!</span>";
                }

              }
            }
        ?>
		<form action="" method="post">
			<h1>Pasword Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your E-mail" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log In !</a>
		</div>

    <div class="button">
			<a href="#">Kaktarua's Blog</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
<!-- User orget password and mail validation has been added here-->
