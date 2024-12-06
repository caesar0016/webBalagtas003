<?php
// Path to the dataset folder
$datasetFolder = 'C:/Dataset';

// Scan the folder and get all files
$files = array_diff(scandir($datasetFolder), array('.', '..')); // Exclude '.' and '..'

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $targetFile = $datasetFolder . '/' . basename($_FILES['fileToUpload']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (optional, here we allow up to 10MB)
    if ($_FILES['fileToUpload']['size'] > 10000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (optional, here we allow only .xlsx and .csv)
    if ($fileType != "xlsx" && $fileType != "csv") {
        echo "Sorry, only XLSX and CSV files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . " has been uploaded.";
            // Refresh the page to update the file list
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset Folder</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dataset Files</h1>

        <!-- File Upload Form -->
        <div class="mb-6">
            <h2 class="text-xl text-gray-800 mb-2">Upload New File</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="flex items-center space-x-4">
                    <input type="file" name="fileToUpload" class="px-4 py-2 border border-gray-300 rounded-md">
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Upload</button>
                </div>
            </form>
        </div>

        <!-- Table of dataset files -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600">
                    <th class="py-3 px-6 text-left">File Name</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-6 text-gray-700"><?php echo htmlspecialchars($file); ?></td>
                        <td class="py-4 px-6">
                            <!-- Open File Button -->
                            <form action="openExcel.php" method="GET" style="display:inline;">
                                <input type="hidden" name="file" value="<?php echo urlencode($file); ?>">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Open</button>
                            </form>

                            <!-- Delete File Button -->
                            <form action="deleteExcel.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                <input type="hidden" name="file" value="<?php echo urlencode($file); ?>">
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
