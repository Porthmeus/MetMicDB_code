<?php

error_reporting(E_ALL);
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
    $abundance_value = $_GET['value'];

    $all_abundance = $db->query("SELECT bin_sample_abundance.Bin, bin_sample_abundance.Sample, bin_sample_abundance.TPM_bin, bin_sample_abundance.TPM_wmed, bin_sample_abundance.TPM_med, bin_sample_abundance.relative_abundance FROM bin_sample_abundance LEFT JOIN community_sample_metadata ON community_sample_metadata.Community_Sample=bin_sample_abundance.Sample WHERE Origin='$abundance_value'") or die($db->error);

    if (mysqli_num_rows($all_abundance) !== 0) {
        $abundance = $all_abundance->fetch_all(MYSQLI_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="abundance.csv"');

        
        $file = fopen('php://output', 'w');

        
        fputcsv($file, array_keys($abundance[0]));
	foreach ($abundance as $row) {
            fputcsv($file, $row);
        }

        
        	fclose($file);
    		} else {
        	echo "Sorry, no matching records available!";
    }
} else {
    echo "no parameters";
}

$db->close();
search
