<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
 header("Location: home.php");
 exit;
}

if (isset($_POST['btn-login'])) {
 
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);
 
 $email = $DBcon->real_escape_string($email);
 $password = $DBcon->real_escape_string($password);
 
 $query = $DBcon->query("SELECT * FROM z7_users WHERE email='$email'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; // gdy has³o i login s¹ ok to wartoœæ = 1
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['user_id'];
  header("Location: home.php");
//UDANE LOGOWANIE

	$userr = $row['username'];
	$emaill = $row['password'];
 	$sqll = "SELECT * FROM z7_logi WHERE username='$userr'";
 	$get_resultt= $DBcon -> query($sqll);
if ($get_resultt -> num_rows > 0) {
//JEŒLI INFORMACJA O KONCIE JEST JU¯ W LOGACH
	$err_nr = $row['log_with_error']; //pobranie informacji o liczbie nieudanych prób logowania

	$sql = "UPDATE z7_logi SET log_with_error='0' WHERE username='$userr'";
	$get_result= $DBcon -> query($sql);
} else {
//JEŒLI INFORMACJI O KONCIE NIE MA W LOGACH
	$sql = "INSERT INTO z7_logi (username, email, log_with_error) VALUES ('$userr', '$emaill', '0')";
	$get_result= $DBcon -> query($sql);
}

 } else {

$userr = $row['username'];
$emaill = $row['password'];
//NIEUDANE LOGOWANE

 $sqll = "SELECT * FROM z7_logi WHERE username='$userr'";
 $get_resultt= $DBcon -> query($sqll);
if ($get_resultt -> num_rows > 0) {
//JEŒLI INFORMACJA O KONCIE JEST JU¯ W LOGACH
	$err_nr = $row['log_with_error']; //pobranie informacji o liczbie nieudanych prób logowania
	$sql = "UPDATE z7_logi SET log_with_error='$err_nr' WHERE username='$userr'";
	$get_result= $DBcon -> query($sql);
} else {
//JEŒLI INFORMACJI O KONCIE NIE MA W LOGACH
	$sql = "INSERT INTO z7_logi (username, email, log_with_error) VALUES ('$userr', '$emaill', '1')";
	$get_result= $DBcon -> query($sql);
}




  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";
 }
 $DBcon->close();
}
?>

<html>
<head>

</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Welcome ! Sign In.</h2><hr />
        
        <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Your email address" name="email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Your password" name="password" required />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">Login</button> 
            
            <a href="register.php" class="btn btn-default" style="float:right;">Register HERE - Join for FREE!</a>
            
        </div>  
        
        
      
      </form>

    </div>
    
</div>

</body>
</html>