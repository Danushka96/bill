<?php
session_start();
if (!isset($_SESSION['login_user'])){
	header("location: login/index.php");
}
require_once('process/permissions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wood Arts Company</title>
<link rel="stylesheet" href="css/navmenu.css">
<link rel="stylesheet" href="css/index.css">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

</head>
<body>
			<div id='profile'><b id='welcome'>User : <i>
			<?php echo $_SESSION['login_user']; ?>
			</i></b><b id='logout'><a href='login/logout.php'>Log Out</a></b></div>

<p align="center"><img src="img/logo.png"></p>
<h1 align="center"> Wood Arts Comapany Managment System</h1>

<h2>You have logged in as,
	<?php echo $_SESSION['login_user'];?>
</h2>

<br>


</body>
</html>
