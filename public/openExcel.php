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
        die("Error: The file does not exist.");
    }

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
        echo "<p class='text-green-600'>File updated successfully!</p>";
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
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
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
                            ?>
                        </tbody>
                    </table>
                </div>

                <br>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <input type="submit" name="submit" value="Save Changes" 
                        class="px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300 shadow-md focus:outline-none" />
                </div>
            </form>
        </div>

    </body>
    </html>
