<?php
session_start();
if (!isset($_SESSION['login_user'])){
	header("location: ../login/index.php");
}
?>
<?php
require_once('../inc/connection.php');
if (isset($_POST['type']) || isset($_POST['itemname'])){
		$type=$_POST['type'];
		$pricem=$_POST['pricem'];
        $pricey=$_POST['pricey'];
		$ItemName=$_POST['itemname'];


		$sql="INSERT INTO item (i_name, i_pricem, i_pricey, i_type) VALUES ('$ItemName', '$pricem', '$pricey', '$type')";
		$result=mysqli_query($connection,$sql);
		if ($result) {
				 echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			} else {
				echo "<script type='text/javascript'>alert('failed!')</script>";
				$sql=mysqli_error($connection);
			}
}else{
	$sql="";
}
?>
<?php mysqli_close($connection); ?>

<!DOCTYPE html>
<html>
<head>
	<title>eSports Gaming</title>
<link rel="stylesheet" href="../css/navmenu.css">
<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
<link rel="stylesheet" href="../css/style.css" />
<style>
.box {
        background-color:#e0e0d1;
        color:black;
        font-weight:bold;
        margin:20px auto;
        height:270px;
        width: 600px;
    }
</style>
</head>
<body>
	<div id="profile">
		<b id="welcome">User : <i><?php echo $_SESSION['login_user']; ?></i></b>
		<b id="logout"><a href="../login/logout.php">Log Out</a></b>
	</div>
<p align="center"><img src="../img/logo.png"></p>
<h1 align="center">eSports Comapany Managment System</h1>
<?php
require_once('../process/menu.php');
echo $menu;
 ?>

<h1 align="center">Add New Item Record</h1>
<form method ="post" action="additem.php" >
<fieldset>
<legend>Item Info</legend>
  <div class="col">
      <p>
        <label for="type">Item Type</label>
        <select name="type">
          <option value="server">Server</option>
          <option value="VPS">VPS</option>
          <option value="Service">Service</option>
          <option value="mod">mod</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="itemname">Item Name</label>
        <input name="itemname" type="text" />
      </p>
      <p>
        <label for="Price">Price(Monthly)</label>
        <input name="pricem" type="number" min="0"/>
      </p>
      <p>
        <label for="Price">Price(Yearly)</label>
        <input name="pricey" type="number" min="0"/>
      </p>
      <p>
      <input name="submit" type="Submit" value="Add"/>
      <input name="reset" type="reset" value="Clear Form">
  </form>
  </p>
  </div>
  </fieldset>
</body>
</html>
