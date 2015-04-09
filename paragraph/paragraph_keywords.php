<?php
/**
 * an associative array of keywords and matching taXMLit elements
 * used by apply_paragraph_keywords.php
 * @author  Dauvit King
 * @package ABLE_project
 * @since   February 2010
 * @version 1.0
 */
$keywords = array(
    'ABSTRACT' => 'AbstractParagraph',
    'ACKNOWLEDGEMENTS' => 'AcknowledgmentsParagraph',
    'ACKNOWLEDGMENTS' => 'AcknowledgmentsParagraph',
    'APPENDIX' => 'AppendixParagraph',
    'BIBLIOGRAPHY.' => 'BibliographyTitle',
    'BIOLOGY' => 'DistributionAndOrSpecimenParagraph',
    'COLOR.' => 'SameLanguageDescriptionParagraph',
    'COLOUR.' => 'SameLanguageDescriptionParagraph',
    'Colour' => 'SameLanguageDescriptionParagraph',
    'Colour:' => 'SameLanguageDescriptionParagraph',
    'COLOURATION.' => 'SameLanguageDescriptionParagraph',
    'COMMENT.' => 'DiscussionParagraph',
    'COMMENTS.' => 'DiscussionParagraph',
    'CONTENTS.' => 'ContentsTitle',
    'DESCRIPTION' => 'SameLanguageDescriptionParagraph',
    'DESCRIPTION.' => 'SameLanguageDescriptionParagraph',
    'DESCRIPTIONS' => 'SameLanguageDescriptionParagraph',
    'DESCRIPTIONS.' => 'SameLanguageDescriptionParagraph',
    'DIAGNOSIS,' => 'SameLanguageDiagnosisParagraph',
    'DIAGNOSIS.' => 'SameLanguageDiagnosisParagraph',
    'DIAGNOSTIC.' => 'SameLanguageDiagnosisParagraph',
    'DIFFERENTIATING' => 'SameLanguageDiagnosisParagraph',
    'DISCUSSION.' => 'DiscussionParagraph',
    'DISTRIBUTION' => 'DistributionAndOrSpecimenParagraph',
    'DISTRIBUTION.' => 'DistributionAndOrSpecimenParagraph',
    'Female' => 'SameLanguageDescriptionParagraph',
    'Female.' => 'SameLanguageDescriptionParagraph',
    'Female:' => 'SameLanguageDescriptionParagraph',
    'FIG.' => 'ImageOrTableCaptionString',
    'FRONTISPIECE' => 'FrontispieceParagraph',
    'FRONTISPIECE.' => 'FrontispieceParagraph',
    'INTRODUCTION' => 'IntroductoryParagraph',
    'INDEX' => 'IndexTitle',
    'HOST' => 'SameLanguageDiagnosisParagraph',
    'HOSTS.' => 'SameLanguageDiagnosisParagraph',
    'Male' => 'SameLanguageDescriptionParagraph',
    'Male.' => 'SameLanguageDescriptionParagraph',
    'Male:' => 'SameLanguageDescriptionParagraph',
    'MATERIAL' => 'DistributionAndOrSpecimenParagraph',
    'MATERIAL.' => 'DistributionAndOrSpecimenParagraph',
    'Measurements' => 'SameLanguageDescriptionParagraph',
    'MEASUREMENTS.' => 'SameLanguageDescriptionParagraph',
    'NOMENCLATURE.' => 'NomenclaturalTypeParagraph',
    'PLATE' => 'ImageOrTableCaptionString',
    'RANGE' => 'DistributionAndOrSpecimenParagraph',
    'REMARKS.' => 'DiscussionParagraph',
    'SPECIMENS' => 'DistributionAndOrSpecimenParagraph',
    'TABLE' => 'ImageOrTableCaptionString',
    'TAB.' => 'ImageOrTableCaptionString',
);
/*
Candidate terms   

> ADDENDUM
>> ANATOMY
> ANNEX (ANNEXES)

AppendixParagraph
    APPENDIX

    
    > BIBLIOGRAPHY
> BIOLOGY
>
>> COLORATION
> alt: COLOURATION, COLOUR, COLOR
> CONTENTS
>> CONCLUSIONS

SameLanguageDescriptionParagraph
    DESCRIPTION / DESCRIPTIONS
    DETAILED [DESCRIPTION]

SameLanguageDiagnosisParagraph
    DIAGNOSIS
    DIAGNOSTIC
> Not sure that an adjective would be used as a paragraph header. [as in 
> 'diagnostic features'? - chris]
I would call that a noun phrase, provided that it ended with a full stop.  Just an adjective followed by a full stop I think unlikely.  
[Dave]

>> DIMENSIONS

DiscussionParagraph
    DISCUSSION

DistributionAndOrSpecimenParagraph
    DISTRIBUTION

>> ECOLOGY
> ERRATA
> ETYMOLOGY
>> FIG. / FIGURE

FrontispieceParagraph
    FRONTISPIECE

IndexSection ????
    INDEX

IntroductoryParagraph
    INTRODUCTION

> KEY
>> LITERATURE
>> MATERIAL
>> MEASUREMENTS
> MORPHOLOGY
>> PLATE
> PREFACE
> RANGE
>> REFERENCES
>> REMARKS
> REPOSITORIES
>> RESULTS
>> REVIEW
> SPECIMENS [EXAMINED]
>> SUMMARY
>> SYNOPSIS
>> TABLE / TAB.

*/
?>