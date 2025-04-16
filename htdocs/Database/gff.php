<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
// Timestamp to check if script is working
echo date("H:i:s");

// Connection to database "metagenomeCollection"
$servername = "localhost";
$username = "root";    
$password = "password";
$dbname = "metagenomeCollection";
$db = new mysqli($servername, $username, $password, $dbname);

//managing errors
if ($db->connect_error) {
        die("Error " . $db->connect_error);
}
echo "Connected Sucessfully";

print_r ($db->connect_error);

$gff_cluster = $db->query("SELECT DISTINCT Bin FROM gff_ffn_faa");
while($row = $gff_cluster ->fetch_assoc()) {
        $values = array_values($row);
        foreach ($values as $value) {
                echo "<a href=\"gff_ID.php?value=$value\">$value</a>";
        }
        echo "<br>";
}

$db->close();
?>

