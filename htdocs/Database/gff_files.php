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

$db = new mysqli($servername, $username, $password, $dbname);

//managing errors
if ($db->connect_error) {
        die("Error " . $db->connect_error);
}
echo "Connected Sucessfully";

print_r ($db->connect_error);

if (isset($_GET['value'])) {
      $idvalue = $_GET['value'];

        $all_gff= $db->query("SELECT Contig, Annotation, Start_position, End_position, Strand FROM gff_ffn_faa WHERE Sequence_ID='$idvalue'") or die($db->error);
        
if (mysqli_num_rows($all_gff) !==0) {
                $gff = $all_gff->fetch_all(MYSQLI_ASSOC);
                echo "<pre>";
                print_r($gff);
                echo "</pre>";
                }
        
        else {
                echo "Sorry, no matching records available!";
        }

}
else{
                echo "no parameters";}



$db->close();

