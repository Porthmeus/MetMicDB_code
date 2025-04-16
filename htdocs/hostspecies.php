<html>
<head>
	<link rel="stylesheet"  href="cssstyles.css">
	<title>MetMic</title>
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

.secondary-navbar {
    background-color: #f2f2f2;
    padding: 10px 0;
}

.divider {
    background-color: #f2f2f2;
    padding: 5px;
    margin-left: 10px;
    font-weight: bold;
    text-align: left;
}

.button {
  position: relative;
  margin-top: 15px;
  margin-left: 80% !important;
  display: inline-block;
  background-color: #04aa6D;
  padding: 5px;
  width: 275px;
  color: white !important;
  text-align: center;
  border: 4px double #04aa6D;
  border-radius: 10px;
  font-size: 20px;
  cursor: pointer; 
  text-decoration: none;
}

.button:hover {
    color: #007bff !important;
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
<a class="button" href="download_all_metabun.php">Download all metadata and abundances as .csv file</a><br>

<a class="button" href="download_all_sequences.php">Download all corresponding sequences as .csv file</a><br>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connection to database "metagenomeCollection"
$config = require __DIR__ . '/config/config.php';
$db = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
);



// Managing errors
if ($db->connect_error) {
    die("Error " . $db->connect_error);
}

// Check if connection error exists
print_r($db->connect_error);

$all_species = $db->query("SELECT DISTINCT Species FROM host_taxonomy ORDER BY Species ASC") or die($db->error);

$current_letter = '';
if (mysqli_num_rows($all_species) !== 0) {
    echo "<br>";
    while ($row = $all_species->fetch_assoc()) {
        $species = $row['Species'];
        
        // Only print if the value is not "NA"
        if ($species !== "NA") {
            $first_letter = strtoupper(substr($species, 0, 1));

            if ($first_letter != $current_letter) {
                echo "<div id='$first_letter' class='divider'>$first_letter</div>";
                $current_letter = $first_letter;
            }

            echo "<a href=\"menuhosts.php?value=$species\">$species</a><br>";
        }
    }
} else {
    echo "<p class=\"box\">Sorry, no matching records available!</p>";
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


