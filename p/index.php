<?php include 'prefix.php';?>
<page>

<?php
  // Connect using host, username, password and databasename
  $link = mysqli_connect('localhost', 'yimingf', 'yimingf-xmlpub13', 'yimingf');

  // Check connection
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  
  $lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
  
  if ($lang == 'de') {
    // The SQL query
    $query = "SELECT num, name, description, height, weight, capture
            FROM pokemon_de
            ORDER BY num ASC";
  } else {
	  $query = "SELECT num, name, description, height, weight, capture
            FROM pokemon
            ORDER BY num ASC";
  }

  // Execute the query
  if (($result = mysqli_query($link, $query)) === false) {
   printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
   exit();
  }

  $returnstring = '';
  // Loop over the resulting lines
  while ($line = $result->fetch_object()) {
    // Store results from each row in variables
    $num            = $line->num;
    $name           = $line->name;
    $description    = htmlspecialchars($line->description);
    $height         = $line->height;
    $weight         = $line->weight;
    $capture        = $line->capture;

    // Store the result we want by appending strings to the variable $returnstring
    $returnstring   .= "<item>\n";
    $returnstring   .= "<num>$num</num>\n";
    $returnstring   .= "<name>$name</name>\n";
    $returnstring   .= "<description>$description</description>\n";
    $returnstring   .= "<height>$height</height>\n";
    $returnstring   .= "<weight>$weight</weight>\n";
    $returnstring   .= "<capture>$capture</capture>\n";
    $returnstring   .= "</item>\n";
  }

  // Free result and just in case encode result to utf8 before returning
  // http://www.the-art-of-web.com/php/dataexport/
  mysqli_free_result($result);
  print utf8_encode($returnstring);
?>
</page>
<?php include 'postfix.php';?>
