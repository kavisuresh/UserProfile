<?php
require_once "database.php";
session_start();
if ( !isset($_GET['userid']) ) {
  $_SESSION['error'] = 'Missing Userid';
  header('Location: index.php');
  return;
}
if ( isset($_POST['home'])){
  header("Location: index.php");
  return;
}
if ( isset($_POST['name']) &&  isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['email'])
   && isset($_POST['mobile']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) ){
     if ( strlen($_POST['name']) < 1 || strlen($_POST['age']) < 1 || strlen($_POST['gender']) < 1 ||
     strlen($_POST['email']) < 1 || strlen($_POST['mobile']) < 1 || strlen($_POST['address']) < 1 ||
     strlen($_POST['city']) < 1 || strlen($_POST['state']) < 1 ){
       $_SESSION['error']="All Parameters are mandatory";
       header("Location: update.php");
       return;
     }
     if (is_numeric($_POST['age']) == false ){
       $_SESSION['error']="Age must be integer";
       error_log("User Profile add failed ".$_POST['age']."");
       header("Location: update.php");
       return;
     }
     if (is_numeric($_POST['mobile']) == false || strlen($_POST['mobile']) < 10 ){
       $_SESSION['error']="Mobile number must be 10 digits";
       error_log("User Profile add failedl ".$_POST['mobile']."");
       header("Location: update.php");
       return;
     }
     if (strpos($_POST['email'],'@') === false){
         $_SESSION['error'] = "Email must have an at-sign (@)";
         error_log("User Profile add failed ".$_POST['email']."");
         header("Location: update.php");
         return;
     }
    $sql="UPDATE userdb.userprofile SET name=:name,age=:age,gender=:gender,email=:email,mobile=:mobile,address=:address,city=:city,state=:state WHERE userid=:userid";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ":userid"=>$_SESSION['userid'],
      ":name" => $_POST['name'],
      ":age" => $_POST['age'],
      ":gender" => $_POST['gender'],
      ":email" => $_POST['email'],
      ":mobile" => $_POST['mobile'],
      ":address" => $_POST['address'],
      ":city" => $_POST['city'],
      ":state" => $_POST['state']
    ));

    $_SESSION['success']="User Profile with userid".$_POST['userid']."Successfully";
    header("Location: index.php");
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
<?php
   if (isset($_SESSION['error'])){
     echo('<p style="color:red";>'.$_SESSION['error']."</p>\n");
     unset($_SESSION['error']);
   }
?>
<center>
<h1><p style="color:blue">Update User Profile</p></h1>
<form method="POST">
<table>
<tr><td>Name</td><td><input type="text" name="name" value="<?= htmlentities($row['name']) ?>"></td></tr>
<tr><td>Age</td><td><input type="text" name="age" value="<?= htmlentities($row['age'])  ?>"></td></tr>
<tr><td>Gender</td><td>
<select name="gender">
<option value="<?= htmlentities($row['gender']) ?>"><?= htmlentities($row['gender'])?></option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="others">Others</option>
</select>
</td></tr>
<tr><td>Email</td><td><input type="text" name="email" value="<?= htmlentities($row['email']) ?>"></td></tr>
<tr><td>Mobile No</td><td><input type="text" name="mobile" value="<?= htmlentities($row['mobile']) ?>"></td></tr>
<tr><td>Address</td><td><input type="text" name="address" value="<?= htmlentities($row['address']) ?>"></td></tr>
<tr><td>City</td><td><input type="text" name="city" value="<?= htmlentities($row['city']) ?>"></td></tr>
<tr><td>State</td><td><input type="text" name="state" value="<?= htmlentities($row['state']) ?>"></td></tr>
</table>
<input type="submit" name="update" value="Update User"/>
<input type="submit" name="home" value="Home"/>
</form>
</center>
</body>
</html>
