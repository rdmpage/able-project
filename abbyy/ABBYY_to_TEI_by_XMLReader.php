<?php
/**
 * Convert ABBYY XML to TEI XML using XMLReader.
 * Comments to the code of the previous version are in separate file ABBYY_to_TEI_by_XMLReader_notes.odt.
 * This version writes out the font size only if it has changed.
 * @author  Dauvit King
 * @package ABLE_project
 * @since   November 2009
 * @ver     1.6
 */

// message to prove we are running
echo "Hello from ABBYY to TEI by XMLReader\n";
// get volume name
if ($argc == 2) {
    $volume = $argv[1];
} else {
    exit("No volume name supplied\nScript closing\n");
}
 
// message to prove we are running
echo "Processing {$volume} files\n";

// set up files
//$fn_in='/host/ABLE/BoB/source/'.$volume.'_abbyy.xml';
$fn_in = 'C:\ABLE\BoB\source\\'.$volume.'_abbyy.xml';
$xml = new XMLReader();
$xml->open($fn_in, 'UTF-8') or exit("Failed to open input xml file: {$fn_in} \n");;
//$fn_hd = '/host/ABLE/BoB/wip/'.$volume.'_teiHeader.xsl';
$fn_hd = 'C:\ABLE\BoB\wip\\'.$volume.'_teiheader.xsl';
$fhd = fopen($fn_hd, 'r') or exit("Failed to open input xsl file: {$fn_hd} \n");
//$fn_out = '/host/ABLE/BoB/wip/'.$volume.'_abbyy_to_tei_by_xmlreader.xml';
$fn_out = 'C:\ABLE\BoB\wip\\'.$volume.'_abbyy_to_tei_by_xmlreader.xml';
$fout = fopen($fn_out, 'w') or exit("Failed to open output xml file: {$fn_out} \n");

//define TEI XML
$tei_begin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<tei:TEI xmlns:tei=\"http://www.tei-c.org/ns/1.0\" xmlns:txm=\"http://taxonomic-trial/namespace\">
";
$tei_middle = "<tei:text>\n";
$tei_end = "</tei:text>\n</tei:TEI>";

// intialise variables
$hi_count = 0;
$old_fontsize = 0;
$output = '';
$write = false;

// main processing
echo "Writing TEI header\n";
fwrite($fout, $tei_begin);
while ($buffer = fgets($fhd)) {
    if ('<tei:teiHeader' == substr($buffer, 0, 14)) {
        $write = true; 
    }
    if ($write) {
        fwrite ($fout, $buffer);
    }
    if (stripos($buffer, '</tei:teiHeader>') != false) {
        break;
    }
}
echo "Writing TEI text\n";
fwrite($fout, $tei_middle);
while ($xml->read()) {
    /*
    if ($xml->nodeType == XMLREADER::TEXT) {
        $output .= $xml->readString(); // doesn't work! spaces not retrieved! hence replacement below using charParams element
    */
    if ($xml->nodeType == XMLREADER::ELEMENT && $xml->localName =='charParams') {
        $xml->read();
        $char = $xml->value;
        $output .= htmlspecialchars($char, ENT_QUOTES, 'UTF-8');
    } elseif ($xml->nodeType == XMLREADER::ELEMENT && $xml->localName =='formatting') {
        if ($xml->moveToAttribute('bold')) {
            $output .= '<tei:hi rend="bold">';
            $hi_count++;
        }
        if ($xml->moveToAttribute('italic')) {
            $output .= '<tei:hi rend="italic">';
            $hi_count++;
        }
        if ($xml->moveToAttribute('fs')) { 
            $t = $xml->value;
            if ($old_fontsize !== $t) {
                $output .= '<tei:hi rend="'.$t.'">';
                $old_fontsize = $t;
                $hi_count++;
            }
        }
    } elseif ($xml->nodeType == XMLREADER::ELEMENT && $xml->localName =='page') {
        fwrite($fout, "<tei:div>\n");
    } elseif ($xml->nodeType == XMLREADER::ELEMENT && $xml->localName =='par') {
        fwrite($fout, '<tei:p>');
    } elseif ($xml->nodeType == XMLREADER::END_ELEMENT && $xml->localName =='formatting') {
        for ($i = 0; $i < $hi_count; ++$i) {
            $output .= '</tei:hi>';
        }
        $hi_count = 0;
    } elseif ($xml->nodeType == XMLREADER::END_ELEMENT && $xml->localName =='line') {
        fwrite($fout, $output.'<tei:lb/>');
        $output ='';
    } elseif ($xml->nodeType == XMLREADER::END_ELEMENT && $xml->localName =='page') {
        fwrite($fout, "<tei:pb/>\n</tei:div>\n");
    } elseif ($xml->nodeType == XMLREADER::END_ELEMENT && $xml->localName =='par') {
        fwrite($fout, "</tei:p>\n");
    }
}
fwrite($fout, $tei_end);

// close down script
$xml->close($fn_in) or exit("Failed to close input xml file: {$fn_in} \n");;
fclose($fhd) or exit("Failed to close input xsl file: {$fn_hd} \n");
fclose($fout) or exit("Failed to close output text file: {$fn_out} \n");
echo "\nGoodbye from ABBYY to TEI by XMLReader\n";
?>
