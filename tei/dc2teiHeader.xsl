<?xml version="1.0" encoding="UTF-8"?>
<!--
    Purpose: XSLT to convert Darwin Core XML to TEI header XML
        to create an XSLT header file to be included in the main DjVu to TEI XSL transformation
     Author:  Dauvit King, for ABLE project, October 2009
-->
<xsl:stylesheet version="2.0" exclude-result-prefixes="xs xdt err fn" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:tei="http://www.tei-c.org/ns/1.0" xmlns:dc="http://dublincore.org/xml/dc-dsp/2008/01/14" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:err="http://www.w3.org/2005/xqt-errors">
<xsl:output method="xml" encoding="UTF-8" indent="yes"/>
<xsl:strip-space elements="*"/>
<xsl:template match="dc">
<xsl:text disable-output-escaping="yes"><![CDATA[
<!-- Purpose: XSL with teiHeader elements from Darwin Core metadata
    to be included in main DjVu to TEI XSL transformer
    Author: Dauvit King for ABLE project, October 2009
-->
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:tei="http://www.tei-c.org/ns/1.0">
<xsl:template name="header">
<tei:teiHeader>
    <tei:fileDesc>
        <tei:titleStmt>
            <tei:title>
            ]]></xsl:text>
                <xsl:value-of select="*:title"/>
            <xsl:text disable-output-escaping="yes"><![CDATA[
            </tei:title>
            <tei:author>
            ]]></xsl:text>
                <xsl:value-of select="*:creator"/>
            <xsl:text disable-output-escaping="yes"><![CDATA[
            </tei:author>
            <tei:respStmt>
                <tei:resp>
                Converted as part of the ABLE project by
                </tei:resp>
                <tei:name>
                Dauvit King
                </tei:name>
            </tei:respStmt>
        </tei:titleStmt>
            <tei:publicationStmt>
                <tei:publisher>
                ]]></xsl:text>
                    <xsl:value-of select="*:publisher"/>
                <xsl:text disable-output-escaping="yes"><![CDATA[
                </tei:publisher>
            </tei:publicationStmt>
            <tei:sourceDesc>
                <tei:bibl>
                ]]></xsl:text>
                    <xsl:value-of select="*:description"/>
                <xsl:text disable-output-escaping="yes"><![CDATA[
                </tei:bibl>
            </tei:sourceDesc>
        </tei:fileDesc>
        <tei:encodingDesc>
            <tei:profileDesc>
                <tei:creation>
                This document has been converted to TEI XML as part of the ABLE project to make it more widely available to biodiversity researchers in a useful format.
                </tei:creation>
                <tei:language>
                ]]></xsl:text>
                    <xsl:value-of select="*:language"/>
                <xsl:text disable-output-escaping="yes"><![CDATA[
                </tei:language>
                <tei:textClass>
                ]]></xsl:text>
                    <xsl:value-of select="*:type"/>
                <xsl:text disable-output-escaping="yes"><![CDATA[
                </tei:textClass>
            </tei:profileDesc>
            <tei:editorialDecl>
                <tei:correction>
                    <tei:p>No corrections have been made in the text.</tei:p>
                </tei:correction>
                <tei:normalization>
                    <tei:p>The original source has not been regularized or normalized.</tei:p>
                </tei:normalization>
                <tei:quotation>
                    <tei:p>Quotation marks have not been processed. They are as in the original DjVu XML document.</tei:p>
                </tei:quotation>
                <tei:hyphenation>
                    <tei:p>Hyphens, including end-of-line hyphens, have not been processed. They are as in the original DjVu XML document.</tei:p>
                </tei:hyphenation>
                <tei:segmentation>
                    <tei:p>The text has been segmented based purely on layout based on page breaks. No language level segmetation, such as sentences, tone-units or graphemic, has been applied.</tei:p>
                </tei:segmentation>
                <tei:interpretation>
                    <tei:p>Additional mark up using taXMLit has been applied to the TEI XML based on analysis of the original source through the uBio and OpenCalais web services. (Add comment for fuzzy matching once this has been brought into the final workflow too.) </tei:p>
                </tei:interpretation>
            </tei:editorialDecl>
        </tei:encodingDesc>
    </tei:teiHeader>
    </xsl:template>
    </xsl:stylesheet>]]></xsl:text>
    </xsl:template>
</xsl:stylesheet>
