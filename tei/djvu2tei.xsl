<?xml version="1.0" encoding="UTF-8" ?>

<!--
    Purpose: XSLT to convert DjVu XML to TEI XML
    		requires teiHeader XSL derived from source files accompanying Darwin Core metadata
    Author:  Dauvit King, for ABLE project, October 2009
	 -->

<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:tei="http://www.tei-c.org/ns/1.0">
	<xsl:include href="teiHeader.xsl"/>
	<xsl:output method="xml" encoding="UTF-8" indent="yes"/>
	<xsl:strip-space elements="*"/>
	<xsl:template match="DjVuXML">
		<tei:TEI>
			<xsl:call-template name="header"/>
			<tei:text>
				<xsl:apply-templates/>
			</tei:text>
		</tei:TEI>
	</xsl:template>
	<xsl:template match="BODY/OBJECT">
		<tei:div>
			<xsl:apply-templates select="HIDDENTEXT/PAGECOLUMN/REGION/PARAGRAPH"/>
			<tei:pb/>
		</tei:div>
	</xsl:template>
	<xsl:template match="HIDDENTEXT/PAGECOLUMN/REGION/PARAGRAPH">
		<tei:p>
			<xsl:for-each select="LINE">
				<xsl:value-of select="WORD/." separator=" "/>
				<xsl:if test="not(position()=last())">
					<tei:lb/>
				</xsl:if>
			</xsl:for-each>
		</tei:p>
	</xsl:template>
</xsl:stylesheet>
