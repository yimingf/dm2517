<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:rss="http://purl.org/rss/1.0/"
                xmlns:dc="http://purl.org/dc/elements/1.1/"
                xmlns:syn="http://purl.org/rss/1.0/modules/syndication/"
                xmlns="http://www.w3.org/1999/xhtml"
                version="1.0">
<xsl:output indent="yes"/> 

<xsl:template match="page">
  <html>
    <head>
      <meta charset="utf-8"/>
      <title>p</title>
    </head>
    <body>
      <p>
        <a href="./new.php">new pokemon</a>
        <a href="./d.php">export to excel</a>
        <a href="./index.php?lang=de">deustch</a>
        <a href="./index.php?lang=en">english</a>
        <a href="./img_upload.php">upload image</a>
        <form method="POST" action="search.php" id="searchform">
          <select name="category">
            <option value="">Select</option>
            <option value="num">Number</option>
            <option value="name">Name</option>
            <option value="height">Height</option>
            <option value="weight">Weight</option>
          </select>
          <input type="text" name="name" />
          <input type="submit" name="submit" value="Search" />
        </form>
      </p>
      <xsl:apply-templates select="//item"/>
     </body>
   </html>
  </xsl:template>

  <xsl:template match="//item">
    <a>
      <h2>
        no. <xsl:value-of select="num"/>&#160;<xsl:value-of select="name"/>
      </h2>
    </a>
    <p>
      <a>
        <xsl:attribute name="href">
          ./edit.php?num=<xsl:value-of select="num"/>
        </xsl:attribute>
        edit
      </a>
    </p>
    <p>
      height: <xsl:value-of select="height"/> m
    </p>
    <p>
      weight: <xsl:value-of select="weight"/> kg
    </p>
    <p>
      <xsl:value-of select="description"/>
    </p>
    <p>
      how to capture: <xsl:value-of select="capture"/>
    </p>
  </xsl:template>

</xsl:stylesheet>

