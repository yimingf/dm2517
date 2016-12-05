<?php include 'prefix.php';?>
<page>

<?php
    // Connect using host, username, password and databasename
    $link = mysqli_connect('localhost', 'yimingf', '4pahat0b1t0', 'pokemon');

    // Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    // The SQL query
    $query = "SELECT link, title, description, creator, feeddate
            FROM exjobbsfeed
            ORDER BY feeddate ASC";

    // Execute the query
    if (($result = mysqli_query($link, $query)) === false) {
       printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
       exit();
    }

    $returnstring = '';
    // Loop over the resulting lines
    while ($line = $result->fetch_object()) {
        // Store results from each row in variables
        $link           = preg_replace('/\s/', '%20', htmlspecialchars($line->link));
        $title          = $line->title;
        $description    = htmlspecialchars($line->description);
        $creator        = $line->creator;
        $feeddate       = preg_replace('/\s/', 'T', $line->feeddate);
        $feeddate       .= "+02:00";

        // Store the result we want by appending strings to the variable $returnstring
        $returnstring   .= "<item rdf:about=\"$link\">\n";
        $returnstring   .= "<title>$title</title>\n";
        $returnstring   .= "<link>$link</link>\n";
        $returnstring   .= "<description>$description</description>\n";
        $returnstring   .= "<dc:creator>$creator</dc:creator>\n";
        $returnstring   .= "<dc:date>$feeddate</dc:date>\n";
        $returnstring   .= "</item>\n";
    }

    // Free result and just in case encode result to utf8 before returning
    mysqli_free_result($result);
    print utf8_encode($returnstring);
?>
</page>
<?php include 'postfix.php';?>