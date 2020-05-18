<?php
require_once "database.php";
session_start();
if ( isset($_POST['home'])){
  header("Location: index.php");
  return;
}
if ( isset($_POST['delete']) && isset($_POST['userid'])){
  if (strlen($_POST['userid']) < 1){
    $_SESSION['error']="Userid is mandatory";
    header("Location: index.php");
    return;
  }
$stmt=$pdo->prepare("SELECT * from userdb.userprofile where userid=:userid");
$stmt->execute(array(
  ":userid"=>$_POST['userid']
));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false){
  $_SESSION["error"]='UserProfile with Userid: '.$_POST['userid'].' doesn\'t exist';
  header("Location: index.php");
  return;
}
$stmt1=$pdo->prepare("DELETE from userdb.userprofile where userid=:userid");
$stmt1->execute(array(
  ":userid"=>$_POST['userid']
));
$_SESSION["success"]="User Profile with userid: ".$_POST['userid']." deleted";
header("Location: index.php");
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
<input type="submit" name="delete" value="Delete User">
<input type="submit" name="home" value="Home">
</form>
</center>
</body>
<html>
