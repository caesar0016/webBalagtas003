<?php
require 'C:/xampp/htdocs/webBalagtas003/vendor/autoload.php'; // Load Composer's autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

// Specify the path to the file
$filePath = 'C:/xampp/htdocs/webBalagtas003/public/balagtasArea.xlsx'; 

// Load the existing spreadsheet
$reader = new XlsxReader();
$spreadsheet = $reader->load($filePath);

// Get the active sheet
$sheet = $spreadsheet->getActiveSheet();

// Handle form submission to update the Excel data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Loop through the posted data and update the spreadsheet
    foreach ($_POST as $cellReference => $newValue) {
        // Skip the submit button
        if ($cellReference != 'submit') {
            // Update the cell with the new value from the form
            $sheet->setCellValue($cellReference, $newValue);
        }
    }

    // Save the modified spreadsheet back to the file
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);
    echo "File updated successfully!";
}

echo '<form method="POST" action="">';
echo "<table border='1'>";

// Display the spreadsheet data as editable form fields
foreach ($sheet->getRowIterator() as $row) {
    echo "<tr>";
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); // Iterate through all cells
    foreach ($cellIterator as $cell) {
        $cellValue = $cell->getValue();
        $cellReference = $cell->getCoordinate(); // Get the cell reference (e.g., A1, B2)
        echo "<td><input type='text' name='$cellReference' value='$cellValue' /></td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "<br><input type='submit' name='submit' value='Save Changes' />";
echo "</form>";
?>
