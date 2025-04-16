<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Timestamp to check if script is working
echo date("H:i:s");

// Connection to database "metagenomeCollection"
$config = require __DIR__ . '/config/config.php';
$db = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
);


//managing errors
if ($db->connect_error) {
        die("Error " . $db->connect_error);
}
echo "Connected Sucessfully";
print_r ($db->connect_error);

//SQL-Query Domain
if (isset($_GET['type']) && isset($_GET['name'])) {
	$searchType = $_GET['type'];
	$searchName = $_GET['name'];

	$all_domain = $db->query("SELECT Domain, Phylum, Class, tax_Order, Family, Genus, Species FROM taxonomy_generalstats WHERE Domain='$searchName'") or die($db->error);
	

	if (mysqli_num_rows($all_domain) !==0) {
		echo "<br>";
		while ($row = $all_domain ->fetch_assoc()) {
			foreach ($row as $key => $value) {
				echo"$key: $value<br>";
			}
		echo "<br>";
		foreach($row as $key => $value) {
			echo "$key: ";
			echo "<a href=\"bac.php?key=$key&value=$value\">$value</a>";
			echo "<br>";
		}
			echo "<br>";
		}
	}
	else {
		echo "Sorry, no matching records available!";
	}
}
$all_domain->free();

$db->close();
?>
