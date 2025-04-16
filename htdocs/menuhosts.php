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
      $hostvalue = $_GET['value'];

        $all_species = $db->query("SELECT DISTINCT Species FROM host_taxonomy WHERE Domain='$hostvalue' OR Phylum='$hostvalue' OR Class='$hostvalue' OR tax_order='$hostvalue' OR Family='$hostvalue' OR Genus='$hostvalue' OR Species='$hostvalue' ORDER BY Species ASC") or die($db->error);

while ($row = $all_species->fetch_assoc()) {
    $values = array_values($row);

    foreach ($values as $value) {
	    echo "<a href=\"metadata1.php?value=$value\">$value</a><br>";
    }
}
}
$db->close();
?>
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


