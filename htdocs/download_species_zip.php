<?php

$config = require __DIR__ . '/config/config.php';
$db = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
);


if (isset($_GET['value'])) {
    $sequence_value = $_GET['value'];
    $zipFileName = 'species_sequenes.tar.gz';  // Change the file extension to .gz

    $all_sequence = $db->query("SELECT DISTINCT Bin FROM taxonomy_generalstats WHERE Species='$sequence_value'") or die($db->error);

    $filesToArchive = [];

    while ($row = $all_sequence->fetch_assoc()) {
        $value = $row['Bin'];
        $filename = "final_genomes/$value.fna.gz";

        if (file_exists($filename)) {
            $filesToArchive[] = $filename;
        }
    }

    if (count($filesToArchive) > 0) {
        $tar = new PharData($zipFileName);
        
        foreach ($filesToArchive as $file) {
            $tar->addFile($file);
        }

        header('Content-Type: application/gzip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        readfile($zipFileName);
    } else {
        echo "No files to archive";
    }
}

$db->close();
?>

