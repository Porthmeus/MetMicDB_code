<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = require __DIR__ . '/config/config.php';
$db = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
);

if ($db->connect_error) {
    die("Error " . $db->connect_error);
}


    // Generate a unique temporary archive name with a timestamp
    $timestamp = time();
    $zipFileName = "species_sequences_$timestamp.zip";

    $all_sequence = $db->query("SELECT DISTINCT Bin FROM bin_sample_abundance LEFT JOIN community_sample_metadata ON community_sample_metadata.Community_Sample=bin_sample_abundance.Sample") or die($db->error);

    $filesToArchive = [];

    while ($row = $all_sequence->fetch_assoc()) {
        $value = $row['Bin'];
        $filename = "final_genomes/$value.fna.gz";

        if (file_exists($filename)) {
            $filesToArchive[] = $filename;
        }
    }

    if (count($filesToArchive) > 0) {
        // Create a new ZipArchive
        $zip = new ZipArchive();
        
        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Add files to the archive
            foreach ($filesToArchive as $file) {
                $zip->addFile($file, basename($file));
            }

            // Close the archive
            $zip->close();

            // Send the archive for download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
            readfile($zipFileName);

            // Clean up: delete the temporary archive file
            unlink($zipFileName);
        } else {
            echo "Failed to create the archive";
        }
    } 
$db->close();
?>

