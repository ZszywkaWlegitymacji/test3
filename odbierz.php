<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM z7_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

$user_file = $userRow['username'];
$user_dir = $_SESSION['username'];
//odbieranie wys³anego pliku

$max_rozmiar = 10000;
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
else
{
echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';

if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
move_uploaded_file($_FILES['plik']['tmp_name'], "/php/z7/".$user_file."/".$_FILES['plik']['name']);
}
} else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Unknown Error!
    </div>";

} 



$DBcon->close();

?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
        <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
       <form class="form-signin" method="post" id="select-form">

      <hr />
<br>
<a href="home.php">BACK</a><br><br>
<br>
<a href="logout.php?logout">Logout</a><br><br>
      </form>

    </div>
    
</div>

</body>
</html>