<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM z7_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();


if (isset($_POST['send'])) {



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
     
        
<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data"> 
<input type="file" name="plik"/> 
<input type="submit" value="SEND"/><br> 

<br>
<a href="logout.php?logout">Logout</a><br><br>
      </form>

    </div>
    
</div>

</body>
</html>