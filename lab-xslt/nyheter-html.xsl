<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <xsl:template match="page">
   <html>
    <head>
      <title><xsl:value-of select="title"/></title>
    </head>
    <meta>
      <xsl:attribute name="name">author</xsl:attribute>
      <xsl:attribute name="content">
        <xsl:value-of select="author"/>
      </xsl:attribute>
    </meta>
    <meta>
      <xsl:attribute name="name">version</xsl:attribute>
      <xsl:attribute name="content">
        <xsl:value-of select="version"/>
      </xsl:attribute>
    </meta>
    
    <body>
      <h1>Nyheter</h1>
      <ul>
        <xsl:for-each select="newscolumn/news">
        <li>
          <a>
            <xsl:attribute name="href">
              <xsl:value-of select="link"/>
            </xsl:attribute>
            <strong><xsl:value-of select="title"/></strong></a>
            - 
            <strong><xsl:value-of select="date/day"/>&#160;<xsl:value-of select="date/month"/>&#160;<xsl:value-of select="date/year"/>.</strong>
            <xsl:value-of select="content"/>
        </li>
        </xsl:for-each>
      </ul>

      <h1>Projektstatus</h1>
      <ul>
        <xsl:for-each select="statuscolumn/project">
        <li>
          <a>
            <xsl:attribute name="href">
              <xsl:value-of select="link"/>
            </xsl:attribute>
            <strong><xsl:value-of select="title"/></strong></a>
            <ul>
              <xsl:for-each select="release">
                <li>
                  <strong><xsl:value-of select="version"/>&#160;-&#160;<xsl:value-of select="status"/></strong>
                  <xsl:value-of select="comment"/>
                </li>
              </xsl:for-each>
            </ul>
        </li>
        </xsl:for-each>
      </ul>
      
    </body>
   </html>
  </xsl:template>

</xsl:stylesheet>

