<?php

require_once "database.php";
session_start();
if ( isset($_GET['home'])){
  header("Location: index.php");
  return;
}
if ( !isset($_GET['userid']) ) {
  $_SESSION['error'] = "Missing userid";
  header('Location: index.php');
  return;
}
$stmt= $pdo->prepare("SELECT userid, name, age, gender, email, mobile, address, city, state FROM userdb.userprofile WHERE userid=:userid");
$stmt->execute(array(
  ":userid"=>$_GET['userid']
));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false){
  $_SESSION['error'] = 'UserProfile with Userid: '.$_GET['userid'].' doesn\'t exist';
  header( 'Location: index.php' ) ;
  return;
}

?>
<html>
<title>User Profile</title>
<body>
<center>
<h1><p style="color:blue">View User Profile</p></h1>
<form>
<table>
<tr><td>Name</td><td><input type="text" name="name" value="<?= htmlentities($row['name']) ?>" readonly></td></tr>
<tr><td>Age</td><td><input type="text" name="age" value="<?= htmlentities($row['age'])  ?>" readonly></td></tr>
<tr><td>Gender</td><td><input type="text" name="gender" value="<?= htmlentities($row['gender'])  ?>" readonly></td></tr>
<tr><td>Email</td><td><input type="text" name="email" value="<?= htmlentities($row['email']) ?>" readonly></td></tr>
<tr><td>Mobile No</td><td><input type="text" name="mobile" value="<?= htmlentities($row['mobile']) ?>" readonly></td></tr>
<tr><td>Address</td><td><input type="text" name="address" value="<?= htmlentities($row['address']) ?>" readonly></td></tr>
<tr><td>City</td><td><input type="text" name="city" value="<?= htmlentities($row['city']) ?>" readonly></td></tr>
<tr><td>State</td><td><input type="text" name="state" value="<?= htmlentities($row['state']) ?>" readonly></td></tr>
</table>
<input type="submit" name="home" value="Home">
</form>
</center>
</body>
<html>
