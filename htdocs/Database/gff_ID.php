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

 if (isset($_GET['value'])) {
      $clustervalue = $_GET['value'];

        $all_ids = $db->query("SELECT DISTINCT Sequence_ID FROM gff_ffn_faa WHERE Bin='$clustervalue'") or die($db->error);
        
if (mysqli_num_rows($all_ids) !==0) {
                echo "<br>";
                while ($row = $all_ids ->fetch_assoc()) {
                       $values = array_values($row);
                        foreach ($values as $value) {
                                echo "<a href=\"gff_files.php?value=$value\">$value</a>";

                        }
                
                        echo "<br>";
                }
        }
        else {
                echo "Sorry, no matching records available!";
         }
}
        else{
                echo "no parameters";}



$db->close();

      


