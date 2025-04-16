<!DOCTYPE html>
<html>
        <head>
                <link rel="stylesheet" href="cssstyles.css">
  <title>MetMicDB</title>
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
        height: 400px;
        margin: auto;
        padding: 50px;
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
                <div class="wrapper">
         <nav class="navbar">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li class="dropdown">
        <a href="bac.html" class="dropbtn">Bacteria & Archaea</a>
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
    <a href="hosts.php" class="active dropbtn">Hosts</a>
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
<div class="wrapper">
<div class="content">


<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
// Timestamp to check if script is working
//echo date("H:i:s");

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
//echo "Connected Sucessfully";

print_r ($db->connect_error);

if (isset($_GET['value'])) {
      $species_value = $_GET['value'];

      $all_species= $db->query("SELECT DISTINCT Species FROM taxonomy_generalstats JOIN bin_sample_abundance ON taxonomy_generalstats.Bin=bin_sample_abundance.Bin JOIN community_sample_metadata ON bin_sample_abundance.Sample=community_sample_metadata.Community_Sample WHERE community_sample_metadata.Origin='$species_value'") or die($db->error);

      if ($all_species->num_rows > 0) {

while($row = $all_species ->fetch_assoc()) {
        $values = array_values($row);
	foreach ($values as $value) {
                echo "<a href=\"download_species_zip.php?value=$value\">$value</a>";
        }
        echo "<br>";
}
      }
else {
	echo "<br><p class=\"box\">Sorry, no matching records available!</p>";
}
}
$db->close();
?>
</div>
                </div>
</div>
                 <div class="image-wrapper">


<a href="https://www.metaorganism-research.com/"><img src="METAORAGANISM-LOGO_RGB_schwarz_zeile_en.jpg" class="img"></a>
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

