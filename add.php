<?php
require_once "database.php";
session_start();

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
       header("Location: add.php");
       return;
     }
     if (is_numeric($_POST['age']) == false ){
       $_SESSION['error']="Age must be integer";
       error_log("User Profile add failed ".$_POST['age']."");
       header("Location: add.php");
       return;
     }
     if (is_numeric($_POST['mobile']) == false || strlen($_POST['mobile']) < 10 ){
       $_SESSION['error']="Mobile number must be 10 digits";
       error_log("User Profile add failedl ".$_POST['mobile']."");
       header("Location: add.php");
       return;
     }
     if (strpos($_POST['email'],'@') === false){
         $_SESSION['error'] = "Email must have an at-sign (@)";
         error_log("User Profile add failed ".$_POST['email']."");
         header("Location: add.php");
         return;
     }
    $sql="INSERT into userdb.userprofile(name,age,gender,email,mobile,address,city,state) values(:name,:age,:gender,:email,:mobile,:address,:city,:state)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ":name" => $_POST['name'],
      ":age" => $_POST['age'],
      ":gender" => $_POST['gender'],
      ":email" => $_POST['email'],
      ":mobile" => $_POST['mobile'],
      ":address" => $_POST['address'],
      ":city" => $_POST['city'],
      ":state" => $_POST['state']
    ));

    $_SESSION['success']="User Profile added Successful";
    header("Location: index.php");
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
<h1><p style="color:blue">Add User Profile</p></h1>
<form method="POST">
<table>
<tr><td>Name</td><td><input type="text" name="name"></td></tr>
<tr><td>Age</td><td><input type="text" name="age"></td></tr>
<tr><td>Gender</td><td>
<select name="gender">
<option>Male</option>
<option>Female</option>
<option>Others</option>
</select>
</td></tr>
<tr><td>Email</td><td><input type="text" name="email"></td></tr>
<tr><td>Mobile No</td><td><input type="text" name="mobile"></td></tr>
<tr><td>Address</td><td><input type="text" name="address"></td></tr>
<tr><td>City</td><td><input type="text" name="city"></td></tr>
<tr><td>State</td><td><input type="text" name="state"></td></tr>
</table>
<input type="submit" name="add" value="Add User"/>
<input type="submit" name="home" value="Home"/>
</form>
</center>
</body>
</html>
