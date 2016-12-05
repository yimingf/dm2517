<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>

	<xsl:template match="/">
  	<html>
  		<xsl:apply-templates select="//PERSONELECTION[contains(@NAME, 'R')]"/>
  	</html>
	</xsl:template>

	<xsl:template match="//PERSONELECTION[contains(@NAME, 'R')]">
  		<p><xsl:value-of select="@NAME[not(.=../preceding::*/@NAME)]"/></p>
	</xsl:template>
</xsl:stylesheet>