<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>

	<xsl:template match="/">
  	<html>
  		<xsl:apply-templates select="//PARTY[@SHORTNAME='ENH']/@REALNAME"/>
  	</html>
	</xsl:template>

	<xsl:template match="//PARTY[@SHORTNAME='ENH']/@REALNAME">
  		<p><xsl:value-of select="."/></p>
	</xsl:template>
</xsl:stylesheet>