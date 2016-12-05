<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="html" indent="yes"/>

<xsl:template match="/">
  <xsl:apply-templates/>
</xsl:template>

<xsl:template match="report">
  <html>
    <head>
			<META http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
			<link href="http://www.csc.kth.sep/~bjornh/2D1517/kthstandard.mac.css" type="text/css" rel="stylesheet"/>
			<title><xsl:value-of select="head/title"/></title>
		</head>
		<body>
			<h1>
				<xsl:value-of select="head/title" />
			</h1>

			<p>
      Authors:
      <xsl:for-each select="head/authors/author">
				<xsl:value-of select="."/>
				<xsl:if test="position() != last()">
				  <xsl:text>, </xsl:text>
				</xsl:if>
			</xsl:for-each>
    	</p>

    	<p>
      Keywords:
      <xsl:for-each select="head/keywords/keyword">
				<xsl:value-of select="."/>
				<xsl:if test="position() != last()">
				  <xsl:text>, </xsl:text>
				</xsl:if>
			</xsl:for-each>
    	</p>

    	<p>
    		<xsl:apply-templates select="body" mode="toc" />
    	</p>
    	<xsl:apply-templates select="body" />

		</body>
  </html>
</xsl:template>

<xsl:template match="body" mode="toc">
	<xsl:for-each select="h1">
		<xsl:variable name="i" select="position()" />
			<xsl:copy-of select="$i"/>.&#160;
			<a href="#{generate-id()}">
				<xsl:value-of select="@title"/>
			</a>
		<br/>
		<xsl:for-each select="h2">
			<xsl:variable name="j" select="position()" />
				<xsl:copy-of select="$i"/>.<xsl:copy-of select="$j"/>.&#160;
				<a href="#{generate-id()}">
					<xsl:value-of select="@title"/>
				</a>
			<br/>
			<xsl:for-each select="h3">
	  		<xsl:variable name="k" select="position()" />
					<xsl:copy-of select="$i"/>.<xsl:copy-of select="$j"/>.<xsl:copy-of select="$k"/>.&#160;
					<a href="#{generate-id()}">
						<xsl:value-of select="@title"/>
					</a>
				<br/>
			</xsl:for-each>
		</xsl:for-each>
	</xsl:for-each>
</xsl:template>

<xsl:template match="body">
	<xsl:for-each select="h1">
		<xsl:variable name="i" select="position()" />
			<a name="{generate-id()}"></a>
			<h2>
				<xsl:copy-of select="$i"/>.&#160;<xsl:value-of select="@title"/>
			</h2>
			<xsl:for-each select="p">
				<p><xsl:value-of select="."/></p>
			</xsl:for-each>
		<xsl:for-each select="h2">
			<xsl:variable name="j" select="position()" />
				<a name="{generate-id()}"></a>
				<h3>
					<xsl:copy-of select="$i"/>.<xsl:copy-of select="$j"/>.&#160;<xsl:value-of select="@title"/>
				</h3>
				<xsl:for-each select="p">
					<p><xsl:value-of select="."/></p>
				</xsl:for-each>
			<xsl:for-each select="h3">
	  		<xsl:variable name="k" select="position()" />
					<a name="{generate-id()}"></a>
					<h4>
						<xsl:copy-of select="$i"/>.<xsl:copy-of select="$j"/>.<xsl:copy-of select="$k"/>.&#160;<xsl:value-of select="@title"/>
					</h4>
					<xsl:for-each select="p">
						<p><xsl:value-of select="."/></p>
					</xsl:for-each>
			</xsl:for-each>
		</xsl:for-each>
	</xsl:for-each>
</xsl:template>

</xsl:stylesheet>


