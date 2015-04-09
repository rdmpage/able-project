<?php
/**
 * Extract text from ABBYY XML file retaining simple formatting information.
 * This is an alternative to ABBYY_to_TEI_by_XMLReader.
 * XMLReader requires the input to be valid XML, this text based script does not.
 * Comments to the code, including design decisions, in separate file ABBYY_to_TEI_notes.odt.
 * @author  Dauvit King
 * @package ABLE_project
 * @since   October 2009
 * @ver     1.7
 */

// set file name - change this variable to select volume for conversion
$volume = 'bulletinofbritis53entolond';

// message to prove we are running
echo "Hello from ABBYY XML to TEI XML with formatting\n";

// set up files
$fn_in = 'C:\ABLE\BoB\source\\'.$volume.'_abbyy.xml';
$fin = fopen($fn_in, 'r') or exit("Failed to open input xml file: {$fn_in} \n");
$fn_hd = 'C:\ABLE\BoB\wip\\'.$volume.'_teiheader.xsl';
$fhd = fopen($fn_hd, 'r') or exit("Failed to open input xml file: {$fn_hd} \n");
$fn_out = 'C:\ABLE\BoB\wip\\'.$volume.'_abbyy_to_tei.xml';
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
    if (strpos($buffer, '</tei:teiHeader>') != false) {
        break;
    }
}
echo "Writing TEI text\n";
fwrite($fout, $tei_middle);
while ($buffer = fgets($fin)) {
    $buffer = ltrim($buffer);
    $buffer5 = substr($buffer, 0, 5);
    switch ($buffer5) {
        case '<line':
            $line = explode('<', $buffer);
            foreach ($line as $element) {
                $element4 = substr($element, 0, 4);
                switch ($element4) {
                    case 'form':
                        if (strpos($element, 'bold=') !== false) {
                            $output .= '<tei:hi rend="bold">';
                            $hi_count++;
                        }
                        if (strpos($element, 'italic=') !== false) {
                            $output .= '<tei:hi rend="italic">';
                            $hi_count++;
                        }
                        if (strpos($element, 'fs=') !== false) { 
                            preg_match('/fs=("[^"]*")/', $element, $size);
                            $t = $size[1];
                            if ($old_fontsize !== $t) {
                                $output .= '<tei:hi rend='.$t.'>';
                                $old_fontsize = $t;
                                $hi_count++;
                            }
                        }
                        break;
                    case '/for':
                        for ($i = 0; $i < $hi_count; ++$i) {
                            $output .= '</tei:hi>';
                        }
                        $hi_count = 0;
                        break;
                    case 'char':
                        $t = strpos($element, '>') + 1;
                        $output .= substr($element, $t);
                        break;
                    case '/lin':
                        $output .= '<tei:lb/>';
                        break;
                    case '/par':
                        $output .= '</tei:p>';
                        break;
                    default: $output .= '';
                }
            }
            $output .= "\n";
            break;   
        case '<par ':
        case '<par>':
            $output = '<tei:p>';
            break;
        case '</par':
            $output = "</tei:p>\n";
            break;
        case '<page':
            $output = "<tei:div>\n";
            break;
        case '</pag':
            $output = "<tei:pb/>\n</tei:div>\n";
            break;
        default : $output = '';
    }
    fwrite($fout, $output);
    $output = '';
}
fwrite($fout, $tei_end);

// close down script
fclose($fin) or exit("Failed to close input xml file: {$fn_in} \n");
fclose($fhd) or exit("Failed to close input xsl file: {$fn_hd} \n");
fclose($fout) or exit("Failed to close output xml file: {$fn_out} \n");
echo "Goodbye from ABBYY XML to TEI XML with formatting\n";
?>