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
margin-top: 30px;
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
?>



<?php
print_r ($db->connect_error);

if (isset($_GET['value'])) {
      $sequence_value = $_GET['value'];
      
echo '<a class="button" href="download_sequences.php?value=' . $sequence_value . '">Download all sequences</a><br>';

      $all_sequence= $db->query("SELECT Distinct Bin FROM bin_sample_abundance JOIN community_sample_metadata ON community_sample_metadata.Community_Sample=bin_sample_abundance.Sample WHERE community_sample_metadata.Origin='$sequence_value'") or die($db->error);
      
      if (mysqli_num_rows($all_sequence) !==0) {
echo '<div class="table-container">';
echo '<table>';

while($row = $all_sequence ->fetch_assoc()) {
        $values = array_values($row);
        foreach ($values as $value) {
		echo "<a href=\"/final_genomes/" . $value . ".fna.gz\" download=\"" . $value . ".fna.gz\">" . $value . "</a>";
        }
        echo "<br>";
}

}else{
 echo "<p class=\"box\">Sorry, no matching records available!</p>";
 }
 }
 else {
 echo "<p class=\"box\">Sorry, no parameters found!</p>";
}
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



