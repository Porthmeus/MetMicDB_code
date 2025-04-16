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

<a class="button" href="XSDAFAFAF">Download abundances as .csv file</a><br>

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
?>

<div class="table-container">
<table>
<?php

if (isset($_GET['value'])) {
      $abundance_value = $_GET['value'];

      $all_abundance= $db->query("SELECT bin_sample_abundance.Bin, bin_sample_abundance.Sample, bin_sample_abundance.TPM_bin, bin_sample_abundance.TPM_wmed, bin_sample_abundance.TPM_med, bin_sample_abundance.relative_abundance FROM bin_sample_abundance LEFT JOIN community_sample_metadata ON community_sample_metadata.Community_Sample=bin_sample_abundance.Sample WHERE Origin='$abundance_value'") or die($db->error);

if (mysqli_num_rows($all_abundance) !==0) {
                $abundance = $all_abundance->fetch_all(MYSQLI_ASSOC);
                echo '<table>';
                echo '<tr>';
                foreach (array_keys($abundance[0]) as $column) {
                        echo '<th>' . $column . '</th>';
                }
                echo '</tr>';

                foreach ($abundance as $row) {
                        echo '<tr>';
                        foreach ($row as $value) {
                                echo '<td>' . $value . '</td>';
                        }
                        echo '</tr>';
                }
		echo '</table>';
		echo '<br>';
}        else {
               echo "<p class=\"box\">Sorry, no matching records available!</p>";
        }

}
else{
	echo "no parameters";
}

$db->close();
?></table>
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

