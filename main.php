<?php
session_start();
$file = "slaves.txt";
$buyFile = "mySlaves.txt";
$masters = "masters.txt";
$arraySlaves = json_decode(file_get_contents($file), true);
$arraySlavesToBuy = json_decode(file_get_contents($buyFile), true);
$arrayMasters = json_decode(file_get_contents($masters), true);
$nameSlave = null;
$priceSlave = 0;
$kgStrawberries = 0;
$colorRow = 0;
$slaveToBuy = null;
$priceSlaveToBuy = 0;
$kgStrawberriesToBuy = 0;
$transaction = true;
$ballance = 0;
$kgMaster = 0;
$username = null;
$password = null;
$count = 0;
if (isset($_SESSION['logged']) && $count === 0) {
	if ($_SESSION['logged']) {
	    $username = $_SESSION['username'];
	    $password = $_SESSION['password'];
		$ballance = $_SESSION['money'];
		$kgMaster = $_SESSION['kg'];
	}
}
if (isset($_POST['buySlave'])) {
	$slaveToBuy = $_POST['hidden'];
	echo $slaveToBuy;
	echo "<br/><br/>";
	$nameSlaveToBuy = explode(":", $slaveToBuy)[0];
	$priceSlaveToBuy = explode(":", $slaveToBuy)[1];
	$kgStrawberriesToBuy = explode(":", $slaveToBuy)[2];
	$count++;
}
		if ($ballance >= $priceSlaveToBuy) {
			$arraySlavesToBuy[] = $slaveToBuy;
			file_put_contents($buyFile, json_encode($arraySlavesToBuy));
			$ballance = $ballance - $priceSlaveToBuy;
			$kgMaster = $kgMaster + $kgStrawberriesToBuy;
			foreach ($arrayMasters as $key => $value) {
				$master = explode(":", $value)[0];
				$passwordMaster = explode(":", $value)[1];
				if ($master === $username && $passwordMaster === $password) {
					$newvalue = $master . ":" . $passwordMaster . ":" . $ballance . ":" . $kgMaster;
					echo "<br/><br/>";
//					str_replace($value, $newvalue, $arrayMasters);
                    unset($arrayMasters[$key]);
                    $arrayMasters[] = $newvalue;
					var_dump($arrayMasters);
					file_put_contents($masters, json_encode($arrayMasters));
				}
			}
		}
		if($ballance == 0){
		$transaction = false;
 
}
if (isset($_POST['logout'])) {
	$_SESSION['logged'] = false;
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
    <title>Buy a slave</title>
    <style>
        table {
            font-family: arial, sans -serif;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        #buySlave {
            border: 1px solid black;
            border-radius: 30%;
            padding: 15px 32px;
            text-align: center;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td>Name of the slave</td>
        <td>Price[$]</td>
        <td>Kg strawberries</td>
        <td>Buy</td>
    </tr>
	<?php
	foreach ($arraySlaves as $value) {
		$nameSlave = explode(":", $value)[0];
		$priceSlave = explode(":", $value)[1];
		$kgStrawberries = explode(":", $value)[2];
		if ($colorRow % 2 === 0) {
			echo "<tr bgcolor='gray'>";
		}
		else {
			echo "<tr bgcolor='red'>";
		}
		echo "<td>$nameSlave</td><td>$priceSlave</td><td>$kgStrawberries</td><td>
               <form method='post'>
               <input type='submit' name='buySlave' value='Buy slave'>
               <input type='hidden' name='hidden' value= $value>
               </form>
              </td>";
		echo "</tr>";
		$colorRow ++;
	}
	?>
</table>
<br/><br/>
<h3>Ballans: <?php echo $ballance; ?> $</h3>
<?php
if (!$transaction) {
	echo "Your balance is not enough to buy " . $nameSlave . ". Please take a look at out other suggestions! Thank you!";
}
?>
<h3>Pickled strawberries: <?php echo $kgMaster; ?>[kg]</h3>
<form method="post">
    <input type="submit" name="logout" value="Log out">
</form>
<a href="mySlaves.php">View all your slaves</a>
</body>
</html>