<?php header("Content-type: text/xml; charset=utf-8"); ?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:syn="http://purl.org/rss/1.0/modules/syndication/">

    <channel rdf:about="http://www.nada.kth.se/media/Theses/"> 
        <title>Examensarbeten medieteknik</title>
        <link>http://www.nada.kth.se/media/Theses/</link>
        <description>Examensarbeten inom medieteknik.</description>
        <dc:language>sv</dc:language>
        <dc:rights>Copyright KTH/Nada/Media</dc:rights>
        <dc:date><?php 
            $date = date("c");
            print utf8_encode($date);
             ?></dc:date>

        <dc:publisher>KTH/Nada/Media</dc:publisher>
        <dc:creator>bjornh@kth.se</dc:creator>
        <syn:updatePeriod>daily</syn:updatePeriod>
        <syn:updateFrequency>1</syn:updateFrequency>
        <syn:updateBase>2006-01-01T00:00+00:00</syn:updateBase>

        <items>
            <rdf:Seq>
                <rdf:li rdf:resource="http://www.nada.kth.se/media/Theses/pdf/Exjobb%20eller%20projektarbete.pdf"/>
                <rdf:li rdf:resource="http://www.nada.kth.se/media/Theses/pdf/exjobbsannons_office.doc"/>
                <rdf:li rdf:resource="http://www.nada.kth.se/media/Theses/pdf/Mex-20050329.pdf"/>
                <rdf:li rdf:resource="http://www.nada.kth.se/media/Theses/pdf/Xarbete_fortum.doc"/>
            </rdf:Seq>
        </items>
        <image rdf:resource="http://www.nada.kth.se/media/images/kth.png"/>
    </channel>
<?php
    // Connect using host, username, password and databasename
    $link = mysqli_connect('localhost', 'rsslab', 'rsslab', 'rsslab');

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
</rdf:RDF>