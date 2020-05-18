<?php
require_once "database.php";
session_start();
  if (isset($_POST['add'])){
    header("Location: add.php");
    return;
  }
  if(isset($_POST['update'])){
    header("Location: updateUser.php");
    return;
  }
  if (isset($_POST['view'])){
    header("Location: viewUser.php");
    return;
  }
  if( isset($_POST['list'])){
    header("Location: list.php");
    return;
  }
  if( isset($_POST['delete'])){
    header("Location: delete.php");
    return;
  }
  $stmt= $pdo->prepare("SELECT userid, name, age, gender, email, mobile, address, city, state FROM userdb.userprofile");
  $stmt->execute();
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<title>User Profile</title>
<body>
<center>
<h1><p style="color:blue">User Profiles</p></h1>
<img src="user.png" width="200" height="200"/>
<?php
  if (isset($_SESSION['success'])){
      echo('<p style="color:green";>'.$_SESSION['success']."</p>\n");
      unset($_SESSION['success']);
  }
  if (isset($_SESSION['error'])){
       echo('<p style="color:red";>'.$_SESSION['error']."</p>\n");
       unset($_SESSION['error']);
  }
  if ($rows){
    echo('<table border="1">');
    echo('<tr><th>UserID</th><th>Name</th><th>Age</th><th>Gender</th><th>Email</th><th>Mobile</th><th>Address</th><th>City</th><th>State</th></tr>');
  }
  foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['userid']);
    echo("</td><td>");
    echo($row['name']);
    echo("</td><td>");
    echo($row['age']);
    echo("</td><td>");
    echo($row['gender']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td><td>");
    echo($row['mobile']);
    echo("</td><td>");
    echo($row['address']);
    echo("</td><td>");
    echo($row['city']);
    echo("</td><td>");
    echo($row['state']);
    echo("</td></tr>\n");
  }
?>
</table></br>
<form method="POST">
<input type="submit" name="add" value="Add User"/>
<input type="submit" name="update" value="Update User"/>
<input type="submit" name="view" value="View User"/>
<input type="submit" name="delete" value="Delete User"/>
</center>
</form>
</body>
</html>
