<?php
session_start();
if (!isset($_SESSION['login_user'])){
	header("location: ../login/index.php");
}

require_once('../inc/connection.php');
if (isset($_POST['name']) || isset($_POST['username'])){
		$name=$_POST['name'];
		$clan=$_POST['clan'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$password=md5($password);

		$sql="INSERT INTO customer (c_name, c_clan, c_email, c_tp) VALUES ('$name', '$clan', '$email','$phone')";
		$sql2="INSERT INTO users(username,password,ulevel) VALUES ('$username','$password','0')";
		$result=mysqli_query($connection,$sql);
		$result2=mysqli_query($connection,$sql2);
		if (($result) || ($result2)) {
				 echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			} else {
				echo "<script type='text/javascript'>alert('failed!')</script>";
				$sql=mysqli_error($connection);
			}
}else{
	$sql="";
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
	<title>eSports Gaming Community</title>
<link rel="stylesheet" href="../css/navmenu.css">
<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
<link rel="stylesheet" href="../css/style.css" />
	<style>
	.box {
	background-color:#e0e0d1;
	color:black;
	font-weight:bold;
	margin:20px auto;
	height:320px;
	width: 600px;
	}
	</style>
</head>
<body>
	<div id="profile">
		<b id="welcome">User : <i><?php echo $_SESSION['login_user']; ?></i></b>
		<b id="logout"><a href="login/logout.php">Log Out</a></b>
	</div>
<p align="center"><img src="../img/logo.png"></p>
<h1 align="center"> eSports Comapany Managment System</h1>
<?php
require_once('../process/menu.php');
echo $menu;
 ?>

<h1 align="center">Add New Customer Record</h1>
<form method ="POST" action="addcustomer.php">
<fieldset>
<legend>User Info</legend>
	<div class="col">
		<p>
			<label for="name">Name</label>
			<input name="name" type="text" />
		</p>
		<p>
			<label for="clan">Clan name</label>
			<input name="clan" type="text" />
		</p>
		<p>
			<label for="Email">Email</label>
			<input name="email" type="Email" />
		</p>
		<p>
			<label for="Phone">Phone Number</label>
			<input name="phone" type="text" size="10" pattern="[0-9]{10}"/>
		</p>
	</div>
	<div class="col">
		<p>
			<label for="username">username</label>
			<input name="username" type="text" />
		</p>
		<p>
			<label for="password">password</label>
			<input name="password" type="password" />
		</p>
	<br>
        <p>
        <input name="submit" type="Submit" value="Add"/>
        <input name="reset" type="reset" value="Clear Form">
  </form>
  </p>
  </div>
</fieldset>
</body>
</html>
