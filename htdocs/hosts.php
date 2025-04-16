<!DOCTYPE html>
<html>
	<head>
                <link rel="stylesheet" href="cssstyles.css">
  <title>MetMicDB</title>
<style>

.divider {
    background-color: #f2f2f2;
    padding: 5px;
    margin-left: 10px;
    font-weight: bold;
    text-align: left;
}

.container {
        margin: 40px;
        position: relative;
}

.offcenter {
        position: relative;
        top: 50%;
        margin-left: 1250px;
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

.secondary-navbar {
    background-color: #f2f2f2;
    padding: 10px 0;
}

.secondary-navbar ul {
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
}

.secondary-navbar li {
    margin: 0 10px;
}

.secondary-navbar .grey-letter {
    display: inline;
    color: grey;
    font-weight: bold;
    text-decoration: none;
    margin: 0 10px;
}

.secondary-navbar a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

.secondary-navbar a:hover {
    color: #007bff;
}

.form {
        width: 400px;
        margin: auto;
        margin-top: 250px;
      }
     .input {
        padding: 4px 10px;
        border: 1;
        border-color: black;
        font-size: 16px;
      }
      .search {
        width: 75%;
      }
      .submit {
        width: 70px;
        background-color: #04aa6D;
        color: white;
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
		
		<div class="container">
		<div class="offcenter">
                <form action="db2.php" method="GET">
			 <input type ="text" name="search_for_host" placeholder="Enter your search query, e.g. '...'" size = 50>
			 <input type ="submit" name="submit" class="submit" value="Search"><br>
</div>


		</form>
<nav class="secondary-navbar">
    <ul>
        <li><a href="#A">A</a></li>
        <li><a href="#B">B</a></li>
        <li><a href="#C">C</a></li>
        <li><a href="#D">D</a></li>
        <li><a href="#E">E</a></li>
        <li><span class="grey-letter">F</span></li>
        <li><a href="#G">G</a></li>
        <li><a href="#H">H</a></li>
        <li><a href="#I">I</a></li>
        <li><span class="grey-letter">J</span></li>
        <li><span class="grey-letter">K</span></li>
        <li><a href="#L">L</a></li>
        <li><a href="#M">M</a></li>
        <li><a href="#N">N</a></li>
        <li><a href="#O">O</a></li>
        <li><a href="#P">P</a></li>
        <li><span class="grey-letter">Q</span></li>
        <li><a href="#R">R</a></li>
        <li><a href="#S">S</a></li>
        <li><a href="#T">T</a></li>
        <li><span class="grey-letter">U</span></li>
        <li><a href="#V">V</a></li>
        <li><span class="grey-letter">W</span></li>
        <li><span class="grey-letter">X</span></li>
        <li><span class="grey-letter">Y</span></li>
        <li><a href="#Z">Z</a></li>
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
echo "<br>";
print_r ($db->connect_error);

$all_taxonomy = $db->query("SELECT DISTINCT Origin FROM community_sample_metadata ORDER BY Origin ASC");

$current_letter = '';
while($row = $all_taxonomy ->fetch_assoc()) {
$origin= $row['Origin'];
                        $first_letter = strtoupper(substr($origin, 0, 1));

                        if ($first_letter != $current_letter) {
                                echo "<div id='$first_letter' class='divider'>$first_letter</div>";
                                $current_letter = $first_letter;

                        }

                        echo "<a href=\"metadata1.php?value=$origin\">$origin</a><br>";

                }

$db->close();
?>
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


