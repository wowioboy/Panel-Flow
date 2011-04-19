<?php
/** $Id: example1.php 2426 2006-11-18 19:59:26Z jrust $ */
/**
 * The simplest example. We convert an HTML file into a PDF file.
 * We also add a few custom headers/footers to the PDF.
 */
?>
<html>
<head>
  <title>Testing HTML_ToPDF</title>
</head>
<body>
  Creating the PDF from local HTML file....  Note that we customize the headers and footers!<br />
<?php
// Require the class
require_once dirname(__FILE__) . '/../HTML_ToPDF.php';

// Full path to the file to be converted
$htmlFile = dirname(__FILE__) . '/test.html';
// The default domain for images that use a relative path
// (you'll need to change the paths in the test.html page 
// to an image on your server)
$defaultDomain = 'www.rustyparts.com';
// Full path to the PDF we are creating
$pdfFile = dirname(__FILE__) . '/timecard.pdf';
// Remove old one, just to make sure we are making it afresh
@unlink($pdfFile);

// Instnatiate the class with our variables
$pdf =& new HTML_ToPDF($htmlFile, $defaultDomain, $pdfFile);
// Set headers/footers
$pdf->setHeader('color', 'blue');
$pdf->setFooter('left', 'Generated by HTML_ToPDF');
$pdf->setFooter('right', '$D');
$result = $pdf->convert();

// Check if the result was an error
if (is_a($result, 'HTML_ToPDFException')) {
    die($result->getMessage());
}
else {
    echo "PDF file created successfully: $result";
    echo '<br />Click <a href="' . basename($result) . '">here</a> to view the PDF file.';
}
?>
</body>
</html> 
