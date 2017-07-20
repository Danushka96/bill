<?php
session_start();
if (!isset($_SESSION['login_user'])){
	header("location: ../login/index.php");
}
require_once('../inc/connection.php');
if (isset($_POST['submit'])){
		$itemid=$_POST['item'];
        $client=$_POST['customer'];
		$name=$_POST['name'];
		$slots=$_POST['slots'];
		$price=$_POST['bill'];
		$to=$_POST['to'];
		$from=$_POST['from'];
		$ip=$_POST['ip'];
		$port=$_POST['port'];

		$sql="INSERT INTO server (s_name, s_slots, s_port, s_from, s_to, s_ip, s_item_id, s_customer_id) VALUES ('$name', '$slots', '$port', '$from', '$to', '$ip', '$itemid', '$client')";
		$sql2="UPDATE customer SET customer.c_bill='$price' where customer.c_id=$client";
		$result=mysqli_query($connection,$sql);
		$result3=mysqli_query($connection,$sql2);
		if ($result) {
				 echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			} else {
				echo "<script type='text/javascript'>alert('failed!')</script>";
				$sql=mysqli_error($connection);
			}
}else{
	$sql="";
}

if (isset($_POST['submit2'])){
	$item=$_POST['item'];
	$customer=$_POST['customer'];
	$name=$_POST['name'];
	$slots=$_POST['slots'];

	$search="SELECT i_pricem from item where i_id=$item";
	$result2=mysqli_query($connection,$search);
	$array2=mysqli_fetch_array($result2);
	$price=$array2['i_pricem'];
	if (($slots=="16")&&($item=="1")){
        echo $item;
	    $price=$price-"200";
    }elseif (($slots=="64")&&($item=="1")){
	    $price=$price+"200";
    }elseif (($slots>32)&&($item=="2")) {
        $price=$price+($price/64)*$slots;
    }
    if ($item=="2"){
        $option="<option value='100'>100</option><option value='200'>200</option><option value='512'>512</option>";
    }else{
        $option="";
    }
}else{
	$item="";
	$customer="";
	$name="";
	$slots="";
	$price="";

}

//This Genarates the select Part
$select="";
$search="SELECT * FROM item";
$sresult=mysqli_query($connection,$search);
if (mysqli_num_rows($sresult)>0){
    $str="";
    while($row=mysqli_fetch_assoc($sresult)){
        if ($item==$row['i_id']){
            $select="selected";
        }else{
            $select="";
        }
        $str.="<option value='$row[i_id]'".$select.">$row[i_name]</option>";
    }
}

//Search Customers
$csearch="SELECT * FROM customer";
$cresult=mysqli_query($connection,$csearch);
if (mysqli_num_rows($cresult)>0){
    $cstr="";
    while($crow=mysqli_fetch_assoc($cresult)){
        $cstr.="<option value='$crow[c_id]'>$crow[c_name]</option>";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
	<title>eSports Company</title>
<link rel="stylesheet" href="../css/navmenu.css">
<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css" />
    <style>
</style>
</head>
<body>
	<div id="profile">
		<b id="welcome">User : <i><?php echo $_SESSION['login_user']; ?></i></b>
		<b id="logout"><a href="../login/logout.php">Log Out</a></b>
	</div>
<p align="center"><img src="../img/logo.png"></p>
<h1 align="center"> eSports Company Managment System</h1>
<?php
require_once('../process/menu.php');
echo $menu;
 ?>


<h1 align="center">Add New Order Record</h1>
<form method ="post" action="addorder.php" >
    <fieldset>
        <legend>Server Information</legend>
        <div class="col">
            <p>
                <label for="type">Item Type</label>
                <select name="item">
                    <?php if (isset($str)){ echo $str; } ?>
                </select>
            </p>
            <p>
                <label for="customer">Client Name</label>
                <select name="customer">
                     <?php if (isset($cstr)){ echo $cstr; } ?>
                </select>
            </p>
            <p>
                <label for="name">Server Name</label>
                <input name="name" type="text" value="<?php echo $name; ?>"/>
            </p>
            <p>
                <label for="slots">Slots</label>
                <select name="slots">
                    <option value="16" <?php if ($slots=='16') {echo "selected";} ?> >16</option>
                    <option value="32" <?php if ($slots=='32') {echo "selected";} ?> >32</option>
                    <option value="64" <?php if ($slots=='64') {echo "selected";} ?> >64</option>
                    <?php echo $option; ?>
                </select>
            </p>
            <p>
                <label for="bill">Cost</label>
                <input name="bill" type="number" value="<?php echo $price; ?>"/>
            </p>

            <button type="submit" name= "submit2" formmethod="post" formaction="addorder.php">Calculate</button>
        </div>
        <div class="col">
            <p>
                <label for="from">start Date</label>
                <input name="from" type="date" value="<?php echo date('20y-m-d');?>"/>
            </p>
            <p>
                <label for="to">End Date</label>
                <input name="to" type="date" />
            </p>
            <p>
                <label for="ip">Server IP</label>
                <input name="ip" type="text"/>
            </p>
            <p>
                <label for="port">Server Port</label>
                <input name="port" type="number"/>
            </p>
            <br><br>
      <input name="submit" type="Submit" value="Add"/>
      <input name="reset" type="reset" value="Clear Form">
  </form>
 </div>
</body>
</html>
