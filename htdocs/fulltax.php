<html>
<head>
	<link rel="stylesheet"  href="cssstyles.css">
	<title>MetMicDB</title>
<style>
.divider {
    background-color: #f2f2f2;
    padding: 5px;
    margin-left: 10px;
    font-weight: bold;
    text-align: left;
}

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
}

.button:hover {
    color: #007bff !important;
    }
    
.furtherlinks {
width: 25%; 
float: right;
margin-right: 20px;
}

.tablebox {
width: 70%;
float: left;
}


.container::after {
content: "";
display: table;
clear: both;
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
      $speciesvalue = $_GET['value'];
      

        $all_taxonomy= $db->query("SELECT Domain, Phylum, Class, tax_order, Family, Genus, Species, Bin, Completeness, Contamination FROM taxonomy_generalstats WHERE Species='$speciesvalue'") or die($db->error);

      if (mysqli_num_rows($all_taxonomy) !==0) {
          
	      echo '<a class="button" href=download2.php?value=' . urlencode($speciesvalue) . '">Download this table as .csv file</a><br>';
	      
                $taxonomy = $all_taxonomy->fetch_all(MYSQLI_ASSOC);
                echo '<div class="container">';
                echo '<div class="tablebox">';
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
                        echo '</tr>';
                }
		echo '</table>';
		echo '</div>';
		
		
} else {
	echo "<p class=\"box\">Sorry, no matching records available!</p>";
}} else {
         echo "<p class=\"box\">Sorry, no parameters found!</p>";
	} 
	
	echo '<div class="furtherlinks">';
	//echo "<b>This organism can be found in the following hosts:</b><br>";
	echo '</div>';
	echo '</div>';
    
	

      echo "<br><br>";
  
    

	      if (isset($_GET['value'])) {
      $sequence_value = $_GET['value'];

      $all_sequence= $db->query("SELECT Distinct Bin FROM taxonomy_generalstats WHERE Species='$sequence_value'") or die($db->error);
      
      
      echo "<b>Downlad the corresponding species below:</b>";

while($row = $all_sequence ->fetch_assoc()) {
        $values = array_values($row);
        foreach ($values as $value) {
                echo "<a href=\"/final_genomes/" . $value . ".fna.gz\" download=\"" . $value . ".fna.gz\">" . $value . "</a>";
        }
        echo "<br>";
}
}





$db->close();
?>

</div>
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
