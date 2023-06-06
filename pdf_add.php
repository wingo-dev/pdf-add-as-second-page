<?php
require_once('vendor/autoload.php');

$pdf = new \setasign\Fpdi\Fpdi();

// The path to the PDF file that you want to import
$fileToImport = 'goPizzago-Sepa Mandat_11-05-23.pdf';

// Get the number of pages in the source file
$pageCount = $pdf->setSourceFile($fileToImport);

// Loop through each page in the source file
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // Import a page
    $templateId = $pdf->importPage($pageNo);

    // Get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // Add a new page to the generated document
    // Use the size of the imported page to set the size of the new page
    $pdf->AddPage($size['orientation'], $size);

    // Use the imported page in the generated document
    $pdf->useTemplate($templateId);
}

// Add a new page to the document
$pdf->AddPage();

// Set the font, color, and position
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(5, 5);

// Write some text on the new page
$pdf->Write(0, 'This is just a simple text on the new page');

// Output the document
$pdf->Output('F', 'generated.pdf');
