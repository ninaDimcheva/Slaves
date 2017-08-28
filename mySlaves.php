<?php
$file = "mySlaves.txt";
$arraySlaves = json_decode(file_get_contents($file), true);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My slaves</title>
	<style>
		table{
			font-family: arial, sans -serif;
			border-collapse: collapse;
		}
		
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
	</style>
</head>
<body>
<table>
	<tr>
		<td>Name of slave</td><td>Price [$]</td><td>Kg strawberries [kg]</td><td>Free</td>
	</tr>
	<?php
	foreach ($arraySlaves as $value){
		$nameSlave = explode(":", $arraySlaves)[0];
		$priceSlave = explode(":", $arraySlaves)[1];
		$kgStrawberries = explode(":", $arraySlaves)[2];
		echo "<tr>";
		echo "<td>$nameSlave</td><td>$priceSlave</td><td>$kgStrawberries</td><td></td>";
		echo "</tr>";
	}
	?>
</table>
</body>
</html>