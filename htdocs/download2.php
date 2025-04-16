<?php

// Connection to the database "metagenomeCollection"
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
//echo "Connected Sucessfully";
print_r ($db->connect_error);

if (isset($_GET['value'])) {
    $taxonomy_value = $_GET['value'];
    
 $all_taxonomy = $db->query("SELECT Domain, Phylum, Class, tax_order, Family, Genus, Species, Bin, Completeness, Contamination FROM taxonomy_generalstats WHERE MATCH (fulltext_search_col) AGAINST ('$taxonomy_value' IN NATURAL LANGUAGE MODE)") or die($db->error);

    if (mysqli_num_rows($all_taxonomy) !== 0) {
        $taxonomy = $all_taxonomy->fetch_all(MYSQLI_ASSOC);


        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="taxonomy_generalstats.csv"');

        $file = fopen('php://output', 'w');

        fputcsv($file, array_keys($taxonomy[0]));

        foreach ($taxonomy as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
        exit;
       }
       }

$db->close();
?>
