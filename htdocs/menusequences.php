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

if (isset($_GET['value'])) {
      $sequence_value = $_GET['value'];

      $all_sequence= $db->query("SELECT Distinct Bin FROM taxonomy_generalstats WHERE Species='$sequence_value'") or die($db->error);

while($row = $all_sequence ->fetch_assoc()) {
        $values = array_values($row);
        foreach ($values as $value) {
                echo "<a href=\"/final_genomes/" . $value . ".fna.gz\" download=\"" . $value . ".fna.gz\">" . $value . "</a>";
        }
        echo "<br>";
}
}
$db->close();

