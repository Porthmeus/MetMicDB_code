<html>
        <head> 
                <link rel="stylesheet" href="cssstyles.css">
                <title>MetMicDB - Domain</title>
<style>


.divider {
    font-weight: bold;
    font-size: 20px;
    margin-top: 15px;
    margin-bottom: 5px;
    padding: 5px 0;
    background-color: #f2f2f2;
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
<div class="wrapper">
         <nav class="navbar">
    <ul>
     <li><a href="index.html">Home</a></li>
      <li class="dropdown">
        <a href="bac.html" class= "active dropbtn">Bacteria & Archaea</a>
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

<!--<nav class="secondary-navbar">
    <ul>
	<li><a href="#A">A</a></li>
        <li><a href="#B">B</a></li>
        <li><a href="#C">C</a></li>
        <li><a href="#D">D</a></li>
        <li><a href="#E">E</a></li>
        <li><a href="#F">F</a></li>
        <li><a href="#G">G</a></li>
        <li><a href="#H">H</a></li>
        <li><span class="grey-letter">I</span></li>
        <li><a href="#J">J</a></li>
        <li><a href="#K">K</a></li>
        <li><a href="#L">L</a></li>
        <li><a href="#M">M</a></li>
        <li><a href="#N">N</a></li>
        <li><a href="#O">O</a></li>
        <li><a href="#P">P</a></li>
        <li><span class="grey-letter">Q</span></li>
        <li><a href="#R">R</a></li>
        <li><a href="#S">S</a></li>
        <li><a href="#T">T</a></li>
        <li><a href="#U">U</a></li>
        <li><a href="#V">V</a></li>
        <li><a href="#W">W</a></li>
        <li><a href="#X">X</a></li>
        <li><span class="grey-letter">Y</span></li>
        <li><span class="grey-letter">Z</span></li>
    </ul>
</nav>-->


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
	$phylumvalue = $_GET['value'];

        $all_class = $db->query("SELECT DISTINCT Class FROM taxonomy_generalstats WHERE Phylum='$phylumvalue' ORDER BY Class ASC") or die($db->error);
        
$current_letter = '';
if (mysqli_num_rows($all_class) !==0) {
        echo "<br>";
         while ($row = $all_class ->fetch_assoc()) {
                  $class = $row['Class'];
                  $first_letter = strtoupper(substr($class, 0, 1));

                  if ($first_letter != $current_letter) {
                         echo "<div id='$first_letter' class='divider'>$first_letter</div>";
                                $current_letter = $first_letter;

                        }

                        echo "<a href=\"species.php?value=$class\">$class</a><br>";

                }
        }
        else {
                echo "<p class=\"box\">Sorry, no matching records available!</p>";
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
                        <li><a href="privacy.html">Privacy</a></li>
        </ul>
                </div>



</div>
        </body>
</html>


