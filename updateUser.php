<?php
session_start();
if ( isset($_POST['home'])){
  header("Location: index.php");
  return;
}
if ( isset($_POST['update']) && isset($_POST['userid'])){
   $_SESSION['userid']=$_POST['userid'];
   header("Location: update.php?userid=".$_POST['userid']);
   return;
}
?>
<html>
<title>User Profile</title>
<body>
<center>
<h1><p style="color:blue">Update User Profile</p></h1>
<form method="POST">
Enter the userid
<input type="text" name="userid"></br>
<input type="submit" name="update" value="Update User">
<input type="submit" name="home" value="Home">
</form>
</center>
</body>
<html>
