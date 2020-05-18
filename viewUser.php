<?php
session_start();
if ( isset($_POST['home'])){
  header("Location: index.php");
  return;
}
if ( isset($_POST['view']) && isset($_POST['userid'])){
   if (strlen($_POST['userid']) < 1){
     $_SESSION['error']="Userid is mandatory";
     header("Location: index.php");
     return;
   }
   $_SESSION['userid']=$_POST['userid'];
   header("Location: view.php?userid=".$_POST['userid']);
   return;
}
?>
<html>
<title>User Profile</title>
<body>
<center>
<h1><p style="color:blue">View User Profile</p></h1>
<form method="POST">
Enter the userid
<input type="text" name="userid"></br>
<input type="submit" name="view" value="View User">
<input type="submit" name="home" value="Home">
</form>
</center>
</body>
<html>
