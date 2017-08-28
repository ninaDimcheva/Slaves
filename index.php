<?php
$slaves = "slaves.txt";
$masters = "masters.txt";
$arraySlaves = json_decode(file_get_contents($slaves), true);
$arrayMasters = json_decode(file_get_contents($masters), true);
$nameSlave = null;
$priceSlave = 0;
$kgStrawberry = 0;
$nameMaster = null;
$passwordMaster = null;
$money = 0;
$kgMaster = 0;
if(isset($_POST['saveSlave'])){
	$nameSlave = $_POST['nameSlave'];
	$priceSlave = $_POST['priceSlave'];
	$kgStrawberry = $_POST['kgStrawberries'];
	$arraySlaves[] = $nameSlave . ":" . $priceSlave . ":" . $kgStrawberry;
	var_dump($arraySlaves);
	file_put_contents($slaves, json_encode($arraySlaves));
}
if(isset($_POST['saveMaster'])){
	$nameMaster = $_POST['nameMaster'];
	$passwordMaster = $_POST['password'];
	$money = $_POST['money'];
	$arrayMasters[] = $nameMaster . ":" . $passwordMaster . ":" . $money . ":" . $kgMaster;
	file_put_contents($masters, json_encode($arrayMasters));
	header("Location:login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New slave and new master here</title>
</head>
<body>
<form method="post">
	<fieldset>
		<legend>New slave</legend>
		Name of the slave:
		<input type="text" name="nameSlave"><br/><br/>
		Price of the slave [$]:
		<input type="number" name="priceSlave"><br/><br/>
		Amount of dialed strawberry [kg]:
		<input type="number" name="kgStrawberries"><br/><br/>
		<input type="submit" value="Save" name="saveSlave"><br/><br/>
	</fieldset>
	<br/><br/>
</form>
<form method="post">
	<fieldset>
		<legend>New master:</legend>
		Username:
		<input type="text" name="nameMaster"><br/><br/>
		Password:
		<input type="password" name="password"><br/><br/>
		Balance:
		<input type="number" name="money"><br/><br/>
		<input type="submit" value="Save" name="saveMaster"><br/><br/>
	</fieldset>
</form>
<a href="login.php">LOG IN</a>


</body>
</html>