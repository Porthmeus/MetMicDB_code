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
    font-size: 40;
}

.content a:hover {
    color: #007bff;
}

.box-container {
        display: flex;
}

.box {
        width: 700px;
        height: 375px;
        margin: 0 100px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
	font-size: 40px;
	text-decoration: none;
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
	$metadata_value = $_GET['value'];
}

$db->close();

?>

<br>
<a class="button" href="downloadmetabun.php?value=<?php echo $metadata_value; ?>">Download metadata and abundances</a><br>

<div style="display: flex; align-items: center; justify-content: center; height: 100px;">
    <span style="font-size: 25px; text-align: center;"><b><?php echo $metadata_value; ?></b></span>
</div>

<div class="box-container">
<div class="box">
 <a href="metadata.php?value=<?php echo $metadata_value; ?>">Metadata</a>
</div>
<div class="box">
	       <a href="abundances.php?value=<?php echo $metadata_value; ?>">Abundances</a>
</div>
<div class="box">
	       <a href="sequences.php?value=<?php echo $metadata_value; ?>">Sequences</a>
</div>
<div class="box">
		<a href="presentspecies.php?value=<?php echo $metadata_value; ?>">Present Species</a>
</div>
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
