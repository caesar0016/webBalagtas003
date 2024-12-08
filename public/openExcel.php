    <?php
    require 'C:/xampp/htdocs/webBalagtas003/vendor/autoload.php'; // Load Composer's autoloader

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

    // Path to the dataset folder
    $datasetFolder = 'C:/Dataset'; // Change this if needed

    // Get the filename from the query string (passed via GET)
    $fileName = urldecode($_GET['file']); // Decode the file name
    $filePath = $datasetFolder . '/' . $fileName; // Full file path

    // Check if the file exists before proceeding
    if (!file_exists($filePath)) {
        die("Error: The file does not exist at path: " . $filePath);
    }

    // Try loading the spreadsheet
    $sheet = null; // Initialize $sheet variable to avoid undefined error

    try {
        $reader = new XlsxReader();
        $spreadsheet = $reader->load($filePath);
        $sheet = $spreadsheet->getActiveSheet(); // Get the active sheet
    } catch (Exception $e) {
        die('Error loading spreadsheet: ' . $e->getMessage());
    }

// Handle form submission to update the Excel data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sheet !== null) {
    // Loop through the posted data and update the spreadsheet
    foreach ($_POST as $cellReference => $newValue) {
        // Skip the submit button or the "add row" button
        if ($cellReference != 'submit' && $cellReference != 'addRow' && $cellReference != 'addColumn') {
            // Update the cell with the new value from the form
            $sheet->setCellValue($cellReference, $newValue);
        }
    }

    // Check and remove empty rows
    removeEmptyRows($sheet);

    // Remove empty columns
    removeEmptyColumns($sheet);

    // Save the modified spreadsheet back to the file
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);
    echo "<p class='text-green-600'>File updated successfully!</p>";
}

// Add a new row if the "Add Row" button is clicked
if (isset($_POST['addRow']) && $sheet !== null) {
    $lastRow = $sheet->getHighestRow(); // Get the last row
    $newRow = $lastRow + 1; // Increment for the new row

    // Insert a new row before the new row position
    $sheet->insertNewRowBefore($newRow, 1); // Insert new row

    // Optionally, you can pre-fill the new row with empty data or default values
    $highestColumn = $sheet->getHighestColumn(); // Get the highest column (e.g., 'D')
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // Convert to column index

    // Loop through each column in the newly inserted row
    for ($col = 1; $col <= $highestColumnIndex; $col++) {
        // Set each cell in the new row to empty (or set default values)
        $cellReference = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $newRow;
        $sheet->setCellValue($cellReference, ''); // Blank out the new row
    }
}

// Add a new column if the "Add Column" button is clicked
if (isset($_POST['addColumn']) && $sheet !== null) {
    $highestColumn = $sheet->getHighestColumn(); // Get the highest column letter (e.g., 'D')
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // Convert to column index
    
    // Convert the new column index to a column letter
    $newColumnIndex = $highestColumnIndex + 1;
    $newColumnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($newColumnIndex); // Convert back to letter (e.g., 'E')

    // Insert a new column before the new column letter
    $sheet->insertNewColumnBefore($newColumnLetter, 1); // Insert a new column

    // Optionally, add a header name for the new column (e.g., "New Column")
    $newColumnHeader = '';
    $sheet->setCellValue($newColumnLetter . '1', $newColumnHeader); // Set header for the new column
}

// Function to remove empty rows
function removeEmptyRows($sheet) {
    $highestRow = $sheet->getHighestRow(); // Get the highest row number

    // Get the highest column letter (e.g., 'D')
    $highestColumn = $sheet->getHighestColumn();
    // Convert column letter to column index
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    // Loop through each row from the last to the second (excluding the header row)
    for ($row = $highestRow; $row >= 2; $row--) {
        $isEmpty = true;

        // Loop through each column in the row to check if all cells are empty
        for ($col = 1; $col <= $highestColumnIndex; $col++) {
            // Use getCell() to get the cell at the current column and row
            $cellReference = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
            $cell = $sheet->getCell($cellReference);
            
            if ($cell->getValue() !== null && $cell->getValue() !== '') {
                $isEmpty = false;
                break;
            }
        }

        // If the row is empty, remove it
        if ($isEmpty) {
            $sheet->removeRow($row);
        }
    }
}

// Function to remove empty columns
function removeEmptyColumns($sheet) {
    $highestRow = $sheet->getHighestRow(); // Get the highest row number

    // Get the highest column letter (e.g., 'D')
    $highestColumn = $sheet->getHighestColumn();
    // Convert column letter to column index
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    // Loop through each column from the last to the first (excluding the header row)
    for ($col = $highestColumnIndex; $col >= 1; $col--) {
        $isEmpty = true;

        // Loop through each row in the current column to check if all cells are empty
        for ($row = 2; $row <= $highestRow; $row++) { // Start from row 2 to skip header
            $cellReference = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
            $cell = $sheet->getCell($cellReference);

            if ($cell->getValue() !== null && $cell->getValue() !== '') {
                $isEmpty = false;
                break;
            }
        }

        // If the column is empty, remove it
        if ($isEmpty) {
            $sheet->removeColumnByIndex($col);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dataset - <?php echo basename($filePath); ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Make the table scrollable */
        .overflow-x-auto {
            max-height: 400px; /* Set a maximum height for the table */
            overflow-y: auto;  /* Enable vertical scrolling */
        }

        /* Sticky header style */
        th {
            position: sticky;
            top: 0;
            background-color: #f3f4f6; /* Make sure the header has a background */
            z-index: 10; /* Ensure the header stays above the table content */
        }

        th, td {
            text-align: left;
            padding: 12px 16px;
        }

        /* Optional: make sure the form's submit and add row buttons do not get pushed out */
        .flex {
            flex-wrap: wrap; /* Allow elements to wrap and avoid layout issues */
        }
    </style>
</head>
<body class="bg-gray-900 font-sans antialiased">

    <div class="max-w-6xl mx-auto p-6 relative">
        <!-- Close Button in the upper-right corner -->
        <a href="datasetList.php" class="absolute top-4 right-4 text-white bg-gray-600 rounded-full p-2 hover:bg-gray-700 transition duration-200">
            &times;
        </a>

        <h1 class="text-3xl font-semibold text-gray-100 mb-6 text-center">Edit Spreadsheet: <?php echo basename($filePath); ?></h1>

        <!-- Form to Edit Spreadsheet -->
        <form method="POST" action="" class="bg-white shadow-lg rounded-lg p-6 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg border-collapse">
                    <thead>
                        <tr class="bg-gray-300 text-gray-700">
                            <?php 
                            if ($sheet !== null) {
                                // Get the first row (headers) and make them editable
                                $firstRow = $sheet->getRowIterator()->current(); // Get the first row (headers)
                                foreach ($firstRow->getCellIterator() as $cell) {
                                    $cellReference = $cell->getCoordinate();
                                    $cellValue = $cell->getValue();
                                    echo "<th class='py-3 px-6 text-left'>
                                            <input type='text' name='$cellReference' value='" . htmlspecialchars($cellValue) . "' 
                                            class='w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500' />
                                          </th>";
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($sheet !== null) {
                            // Loop through all rows starting from the second row (excluding header)
                            $rowIndex = 2; // Starting from the second row (row 1 is header)
                            foreach ($sheet->getRowIterator(2) as $row) {
                                echo "<tr class='hover:bg-gray-100'>";
                                $colIndex = 0;
                                foreach ($row->getCellIterator() as $cell) {
                                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(++$colIndex); // Get column letter (A, B, C, ...)

                                    $cellValue = $cell->getValue();
                                    $cellReference = $colLetter . $rowIndex; // Get cell reference (e.g., A2, B2, C2)
                                    echo "<td class='py-3 px-6 border text-gray-700'>
                                            <input type='text' name='$cellReference' value='" . htmlspecialchars($cellValue) . "' 
                                            class='w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500' />
                                          </td>";
                                }
                                echo "</tr>";
                                $rowIndex++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <br>

            <!-- Submit Button -->
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <!-- Button to Add New Row -->
                    <button type="submit" name="addRow" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                        Add New Row
                    </button>
                    
                    <!-- Button to Add New Column -->
                    <button type="submit" name="addColumn" class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Add New Column
                    </button>
                </div>

                <div class="flex space-x-4">
                    <!-- Submit Changes -->
                    <input type="submit" name="submit" value="Save Changes" 
                           class="px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300 shadow-md focus:outline-none" />
                </div>
            </div>
        </form>
    </div>

</body>
</html>
