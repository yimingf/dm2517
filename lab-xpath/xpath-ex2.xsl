<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>

	<xsl:template match="/">
  	<html>
  		<xsl:apply-templates select="//ELECTORAL[@VOTES>300]/@NAME"/>
  	</html>
	</xsl:template>

	<xsl:template match="//ELECTORAL/@NAME">
  		<p><xsl:value-of select="." /></p>
	</xsl:template>
</xsl:stylesheet>