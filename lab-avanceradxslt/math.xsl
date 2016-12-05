<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:output method="html" indent="yes"/>

  <xsl:template match="/">
    <html>
      <head>
        <title>Extralaboration 1</title>
      </head>
      <body>
        <xsl:apply-templates/>
      </body>
    </html>
  </xsl:template>
  
  <xsl:template match="h1">
    <xsl:copy-of select="."/>
  </xsl:template>

  <xsl:template match="times">
    <xsl:call-template name="fibo">
      <xsl:with-param name="n" select="fact"/>
    </xsl:call-template>
    &#160;
    <xsl:call-template name="fibo">
      <xsl:with-param name="n" select="fib"/>
    </xsl:call-template>
    <xsl:value-of select="fact * fib"/>
  </xsl:template>

  <xsl:template name="fibo">
    <xsl:param name="n" select="0"/>
    <xsl:call-template name="fibo-guts">
      <xsl:with-param name="current" select="0"/>
      <xsl:with-param name="next" select="1"/>
      <xsl:with-param name="remaining" select="$n"/>
    </xsl:call-template>
  </xsl:template>
    
  <xsl:template name="fibo-guts">
    <xsl:param name="current" select="0"/>
    <xsl:param name="next" select="0"/>
    <xsl:param name="remaining" select="0"/>
    <xsl:choose>
      <xsl:when test="$remaining = 0">
        <xsl:value-of select="$current"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:call-template name="fibo-guts">
          <xsl:with-param name="current" select="$next"/>
          <xsl:with-param name="next" select="$current + $next"/>
          <xsl:with-param name="remaining" select="$remaining - 1"/>
        </xsl:call-template>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

</xsl:stylesheet>
