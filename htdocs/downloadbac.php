<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connection to database "metagenomeCollection"
// Connection to database "metagenomeCollection"
$config = require __DIR__ . '/config/config.php';
$db = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
);


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);  // If connection fails, show error message
}

// Query to fetch taxonomy data
$all_taxonomy = $db->query("SELECT Domain, Phylum, Class, tax_order, Family, Genus, Species, Bin, Completeness, Contamination FROM taxonomy_generalstats");

if (!$all_taxonomy) {
    die("Query failed: " . $db->error);  // If query fails, show error message
}

if (mysqli_num_rows($all_taxonomy) === 0) {
    echo "<p class=\"box\">Sorry, no matching records available!</p>";
} else {
    $taxonomy = $all_taxonomy->fetch_all(MYSQLI_ASSOC);
    

    // Set headers for CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="taxonomy_generalstats.csv"');

    // Open PHP output stream to write the CSV file
    $file = fopen('php://output', 'w');

    // Write the CSV header (column names)
    fputcsv($file, array_keys($taxonomy[0]));

    // Write the data to the CSV file
    foreach ($taxonomy as $row) {
        fputcsv($file, $row);
    }

    // Close the file handle
    fclose($file);
}

// Close the database connection
$db->close();
?>

