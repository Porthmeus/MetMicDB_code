<?php

// Connection to database "metagenomeCollection"
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

print_r ($db->connect_error);

if (isset($_GET['value'])) {
    $metadata_value = $_GET['value'];

    $all_metadata = $db->query("SELECT * FROM community_sample_metadata WHERE Origin='$metadata_value'") or die($db->error);

    if (mysqli_num_rows($all_metadata) !== 0) {
        $metadata = $all_metadata->fetch_all(MYSQLI_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="metadata.csv"');

        $file = fopen('php://output', 'w');

        fputcsv($file, array_keys($metadata[0]));

        foreach ($metadata as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
    } else {
        echo "<p class=\"box\">Sorry, no matching records available!</p>";
    }
} else {
    echo "no parameters";
}
}

$db->close();

?>



