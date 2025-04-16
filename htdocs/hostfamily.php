<html>
<head>
	<link rel="stylesheet"  href="cssstyles.css">
	<title>MetMic DB</title>
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

.divider {
    background-color: #f2f2f2;
    padding: 5px;
    margin-left: 10px;
    font-weight: bold;
    text-align: left;
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

<div class="content">
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

$all_family = $db->query("SELECT DISTINCT Family FROM host_taxonomy ORDER BY Family ASC") or die($db->error);

$current_letter = '';
if (mysqli_num_rows($all_family) !== 0) {
    echo "<br>";
    while ($row = $all_family->fetch_assoc()) {
        $family = $row['Family'];
        
        // Only print if the value is not "NA"
        if ($family !== "NA") {
            $first_letter = strtoupper(substr($family, 0, 1));

            if ($first_letter != $current_letter) {
                echo "<div id='$first_letter' class='divider'>$first_letter</div>";
                $current_letter = $first_letter;
            }

            echo "<a href=\"menuhosts.php?value=$family\">$family</a><br>";
        }
    }
} else {
    echo "<p class=\"box\">Sorry, no matching records available!</p>";
}

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
