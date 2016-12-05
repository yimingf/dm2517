<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>

	<xsl:template match="/">
  	<html>
  		<xsl:apply-templates select="//ELECTORAL[VALID[@PARTY='M' and @PERCENTAGE>18]]/@NAME"/>
  	</html>
	</xsl:template>

	<xsl:template match="//ELECTORAL[VALID[@PARTY='M' and @PERCENTAGE>18]]/@NAME">
  		<p><xsl:value-of select="."/></p>
	</xsl:template>
</xsl:stylesheet>