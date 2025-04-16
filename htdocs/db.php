<html>
<head>
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
        <a href="bac.html" class="active dropbtn">Bacteria & Archaea</a>
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


$taxonomy_result = $_GET['search_for_taxonomy'];

if ($db->connect_error) {
	die("Error " . $db->connect_error);
}
echo "Connected Sucessfully";
print_r ($db->connect_error);

$all_taxonomy = $db->query("SELECT Domain, Phylum, Class, tax_order, Family, Genus, Species, Completeness, Contamination FROM taxonomy_generalstats WHERE fulltext_search_col LIKE '%$taxonomy_result%' ") or die ($db->error);
if (mysqli_num_rows($all_taxonomy) !== 0) {
	$taxonomy = $all_taxonomy->fetch_all(MYSQLI_ASSOC);
	echo '<table>';
	echo '<tr>';
	foreach (array_keys($taxonomy[0]) as $column) {
		echo '<th>' . $column . '</th>';
	}
	echo '</tr>';

	foreach ($taxonomy as $row) {
		echo '<tr>';
		foreach ($row as $value) {
			echo '<td>' . $value . '</td>';
		}
		echo '<tr>';
	}
	echo '</table>';
        echo '<a href="download2.php?value=' . urlencode($taxonomy_result) . '">Download as CSV</a>';
        echo "</pre>";
        }
 else {
        echo "<p class=\"box\">Sorry, no matching records available!</p>";
 }
$all_taxonomy->free();


$db->close();
?>

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
