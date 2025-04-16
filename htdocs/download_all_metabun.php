<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('memory_limit', '256M');

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

$all_metadata = $db->query("SELECT * FROM community_sample_metadata") or die($db->error);

if (mysqli_num_rows($all_metadata) !== 0) {
    $metadata = $all_metadata->fetch_all(MYSQLI_ASSOC);

    array_unshift($metadata, array_keys($metadata[0]));

    $abundanceFile = sys_get_temp_dir() . '/abundances.csv';

    $all_abundance = $db->query("SELECT bin_sample_abundance.Bin, bin_sample_abundance.Sample, bin_sample_abundance.TPM_bin, bin_sample_abundance.TPM_wmed, bin_sample_abundance.TPM_med, bin_sample_abundance.relative_abundance FROM bin_sample_abundance LEFT JOIN community_sample_metadata ON community_sample_metadata.Community_Sample=bin_sample_abundance.Sample") or die($db->error);
    if (mysqli_num_rows($all_abundance) !== 0) {
        $abundanceData = $all_abundance->fetch_all(MYSQLI_ASSOC);

        array_unshift($abundanceData, array_keys($abundanceData[0]));

        $abundanceCsv = arrayToCsv($abundanceData);
        file_put_contents($abundanceFile, $abundanceCsv);
    }

    $zipArchive = new ZipArchive();
    $zipFileName = sys_get_temp_dir() . '/metadata_abundances.zip';
    if ($zipArchive->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        $zipArchive->addFromString('metadata.csv', arrayToCsv($metadata));
        if (file_exists($abundanceFile)) {
            $zipArchive->addFile($abundanceFile, 'abundances.csv');
        }

        $zipArchive->close();
    }

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="download_files.zip"');
    header('Content-Length: ' . filesize($zipFileName));

    readfile($zipFileName);

    unlink($zipFileName);
    if (file_exists($abundanceFile)) {
        unlink($abundanceFile);
    }
} else {
    echo "Sorry, no matching records available!";
}

$db->close();

function arrayToCsv($array) {
    $output = fopen('php://temp', 'w');
    foreach ($array as $row) {
        fputcsv($output, $row);
    }
    rewind($output);
    $csv = stream_get_contents($output);
    fclose($output);
    return $csv;
}
?>

