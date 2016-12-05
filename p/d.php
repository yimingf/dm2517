<?PHP
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "website_data_" . date('Ymd') . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $link = mysqli_connect('localhost', 'yimingf', 'yimingf-xmlpub13', 'yimingf');
  $flag = false;
  $returnstring = "";
  // set the initial value.
  $returnstring   .= "num\tname\theight\tweight\tdescription\thow to capture\t\n";

  $query = "SELECT num, name, description, height, weight, capture
            FROM pokemon
            ORDER BY num ASC";

  $result = mysqli_query($link, $query);
  // execute the query.

  while ($line = $result->fetch_object()) {
    // Store results from each row in variables
    $num            = $line->num;
    $name           = $line->name;
    $description    = htmlspecialchars($line->description);
    $height         = $line->height;
    $weight         = $line->weight;
    $capture        = $line->capture;

    $returnstring   .= "$num\t$name\t$height\t$weight\t$description\t$capture\t\n";
    // Store the result we want by appending strings to the variable $returnstring
  }
  echo $returnstring;
  exit;
?>