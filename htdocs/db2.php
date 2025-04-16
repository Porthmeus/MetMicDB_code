<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="cssstyles.css">
<style>
.content a { 
    display: block;
    margin: 5px;
    text-decoration: none;
    color: #333;
}

.content a:hover {
    color: #007bff;
}

.table-container {
overflow-x:auto;
}

.box {
        width: 700px;
        height: 375px;
        margin: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 40px;
        text-decoration: none;
}



</style>
</head>
<body>
<nav class="navbar">
<ul>
      <li><a href="index.html">Home</a></li>
      <li class="dropdown">
        <a href="bac.html">Bacteria & Archaea</a>
        <div class="dropdown-content">
          <a href="bac.html">Domain</a>
          <a href="menuphylum.php">Phylum</a>
          <a href="menuclass.php">Class</a>
          <a href="menuorder.php">Order</a>
          <a href="menufamily.php">Family</a>
          <a href="menugenus.php">Genus</a>
          <a href="menuspecies.php">Species</a>
      </div>
    </li>
<li class="dropdown">
    <a href="hosts.php">Hosts</a>
<div class="dropdown-content">
          <a href="hostdomain.php">Domain</a>
          <a href="hostphylum.php">Phylum</a>
          <a href="hostclass.php">Class</a>
          <a href="hostorder.php">Order</a>
          <a href="hostfamily.php">Family</a>
          <a href="hostgenus.php">Genus</a>
          <a href="hostspecies.php">Species</a>
      </div>
</li>

  </ul>
</nav>
<div class="content">

<?php
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

$host_result = $_GET['search_for_host'];

if ($db->connect_error) {
        die("Error " . $db->connect_error);
}
echo "Connected Sucessfully";
print_r ($db->connect_error);
?>
<div class="table-container">
<table>
<?php
$all_host = $db->query("SELECT Community_Sample,
Origin,
sra_study,
bioproject,
biosample,
tax_id,
common_name,
sample_description,
environmental_package,
geographic_location_latitude,
geographic_location_longitude,
geographic_location_continent_ocean,
geographic_location_country_sea,
geographic_location_region_locality,
environment_biome,
environment_feature,
environment_material,
investigation_type,
experimental_factor,
ploidy,
sample_volume_or_weight_for_dna_extraction,
nucleic_acid_extraction,
relevant_standard_operating_procedures,
collection_date,
source_material_identifiers,
sample_collection_device_or_method,
sample_material_processing,
host_body_product,
host_disease_status,
host_common_name,
host_subject_id,
host_age,
host_sex,
host_body_habitat,
host_body_site,
host_life_stage,
gravidity,
host_diet,
host_genotype,
subspecific_genetic_lineage,
sequencing_method,
sequencingmachine,
library_layout,
library_selection,
library_type,
average_read_length,
decontamination,
decontamination_method,
Sample FROM community_sample_metadata WHERE MATCH (Origin) AGAINST ('$host_result')") or die ($db->error);       

if (mysqli_num_rows($all_host) !== 0) {
	$host = $all_host->fetch_all(MYSQLI_ASSOC);
	echo '<table>';
	echo '<tr>';
	foreach (array_keys($host[0]) as $column) {
		echo '<th>' . $column . '</th>';
	}
	echo '</tr>';

	foreach ($host as $row) {
		echo '<tr>';
		foreach ($row as $value) {
			echo '<td>' . $value . '</td>';
		}
		echo '<tr>';
	}
	echo '</table>';
	echo '<a href="download.php?value=' . urlencode($host_result) . '">Download as CSV</a>';
        echo "</pre>"; 
        }
 else {                                              
        echo "<p class=\"box\">Sorry, no matching records available!</p>";
 }

$all_host->free(); 


$db->close();
?>
</table>
</div>
</div>
</div>
<div class="image-wrapper">
<a href="https://www.metaorganism-research.com/"><img src="METAORAGANISM-LOGO_RGB_schwarz_zeile_en.jpg"></a>
</div>
<div class="footer">
        <ul>
			<li><a href="contact.html">Contact</a></li>
			 <li><a href="legal.html">Legal Notice</a></li>
                        <li><a href="https://www.uni-kiel.de/de/datenschutz">Privacy</a></li>

        </ul>
                </div>
</body>


</html> 

