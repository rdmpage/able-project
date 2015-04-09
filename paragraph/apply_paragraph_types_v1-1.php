<?php
/**
 * tentatively mark up paragraph types based on list supplied by Dave and Chris
 * amended from v1.0 to use TEI tags rather than XML comments to indicate paragraph type
 * note the attrbute values are taXMLit paragraph types because that is what has been identified,
 * which means the attributess do not match those used by DCL,
 * e.g. DCL = description, taXMLit = SameLanguageDescriptionParagraph.
 * @author  Dauvit King
 * @package ABLE_project
 * @since   February 2010
 * @ver     1.1
 */

/**
 * set up script
 */
// message to prove we are running
echo "Hello from apply_paragraph_types with TEI div tags\n";
// get volume name
if ($argc == 2) {
    $volume = $argv[1];
    echo "Working on {$volume} files\n";
} else {
    exit("No volume name supplied\nScript closing\n");
}
// set up files
$fn_in = 'C:\ABLE\BoB\wip\\'.$volume.'_abbyy_to_tei_by_xmlreader.xml';
$fin = fopen($fn_in, 'r') or exit("Failed to open input xml file: {$fn_in} \n");
$fn_ky = 'C:\ABLE\BoB\scripts\paragraph_keywords.txt';
$fky = fopen($fn_ky, 'r') or exit("Failed to open input xsl file: {$fn_ky} \n");
$fn_out = 'C:\ABLE\BoB\wip\\'.$volume.'_tei_annotated_with_div.xml';
$fout = fopen($fn_out, 'w') or exit("Failed to open output xml file: {$fn_out} \n");
// get array of keywords and associated mark up tags
include_once 'paragraph_keywords.php';

/**
 * main processing
 */
echo "Processing input\n";
while ($buffer = fgets($fin)) {
    if (false != strpos($buffer, 'tei:p>')) {
        $s = strip_tags($buffer);
        $a = explode(' ', $s);
        foreach ($keywords as $key => $value) {
            if ($a[0] == $key) {
                // format output line 'nicely'
                // need to remove original line feed and replace with our own
                // if not then our closing tag is at the start of the next line in the output instead of the end of this line
                // while valid XML this is extremely confusing for the human reader!
                // let's keep it simple - all of the div on one line
                $buffer = '<tei:div type="'.$value.'">'.rtrim($buffer).'</tei:div>'."\n";
            }
        }
    }
    fwrite($fout, $buffer);
}
echo "Processed input\n";

/**
 * close down script
 */
fclose($fin) or exit("Failed to close input xml file: {$fn_in} \n");
fclose($fky) or exit("Failed to close input text file: {$fn_ky} \n");
fclose($fout) or exit("Failed to close output text file: {$fn_out} \n");
echo "Goodbye from apply_paragraph_types with TEI div tags\n";
?>