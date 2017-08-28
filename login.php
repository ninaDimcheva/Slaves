<?php
session_start();
$masters = "masters.txt";
$arrayMasters = json_decode(file_get_contents($masters), true);
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	foreach ($arrayMasters as $value){
		$fileUsername = explode(":", $value)[0];
		$filePassword = explode(":", $value)[1];
		$fileMoney = explode(":", $value)[2];
		$kgMaster = explode(":", $value)[3];
		if($username === $fileUsername && $password === $filePassword){
			$_SESSION['logged'] = true;
			$_SESSION['money'] = $fileMoney;
			$_SESSION['username'] = $fileUsername;
			$_SESSION['password'] = $filePassword;
			$_SESSION['kg'] = $kgMaster;
			header("Location: main.php");
		}
		else{
			$_SESSION['logged'] = false;
			header("Location: index.php");
		}
	}
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
</head>
<body>
<fieldset>
	<legend>Log in</legend>
	<form method="post" action="main.php">
	Username:
		<input type="text" name="username"><br/><br/>
		Password:
		<input type="password" name="password"><br/><br/>
		<input type="submit" name="submit" value="Log in"><br/><br/>
	</form>
	<a href="index.php">Register</a>
</fieldset>
<br/><br/>
</body>
</html>