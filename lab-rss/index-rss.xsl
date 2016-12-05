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
       <title>Lab 3 feed</title>
     </head>
     <body>
       <xsl:apply-templates select="//rss:item"/>
     </body>
   </html>
  </xsl:template>

  <xsl:template match="//rss:item">
    <a>
      <xsl:attribute name="href">
        <xsl:apply-templates select="rss:link"/>
      </xsl:attribute>
      <h2>
        <xsl:apply-templates select="rss:title"/>
      </h2>
    </a>
    <p>
      <xsl:apply-templates select="rss:description"/>
    </p>
  </xsl:template>

  <xsl:template match="rss:link">
    <xsl:value-of select="." />
  </xsl:template>

  <xsl:template match="rss:title">
    <xsl:value-of select="." />
  </xsl:template>

  <xsl:template match="rss:description">
    <xsl:value-of select="." />
  </xsl:template>

</xsl:stylesheet>

