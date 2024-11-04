<?php
include("adminHeader.php");

// connection.php
$host = 'localhost';
$db = 'webBalagtas01';
$user = 'postgres';
$pass = 'Kuz18647';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$sql = "SELECT * FROM tblAccount WHERE archiveflag = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-100">
    <div class="flex justify-between p-4">
        <div class="w-1/3 bg-white rounded-lg shadow-md p-6 mr-4">
            <!--This is the card 1--->
            <h2 class="text-3xl font-bold text-center mb-6">Register</h2>
            <form action="register.php" method="POST" id="accountForm">
                <div class="grid grid-cols gap-4 mb-4">
                    <label for="name" class="block text-sm font-medium">Name:</label>
                    <input type="text" id="name" name="name01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
    
                    <label for="username" class="block text-sm font-medium">Username:</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username01" 
                        required 
                        class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        oninput="this.value = this.value.replace(/\s/g, '');"> <!--Disables pressing space-->
                    <label for="password" class="block text-sm font-medium">Password:</label>
                    <input type="password" id="password" name="password01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="20" minlength="6"  >
    
                    <label for="confirm-password" class="block text-sm font-medium">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirmPass01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="20" minlength="6">
                    <div id="error" class="hidden text-red-500">Passwords do not match!</div>
    
                    <fieldset class="mt-4">
                        <legend class="block text-sm font-medium mb-2">Account Type:</legend>
                        <div class="flex items-center mb-2">
                            <input type="radio" id="regular" name="account_type" value="Regular" class="mr-2 border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                            <label for="regular" class="text-sm">Regular Account</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="radio" id="admin" name="account_type" value="Admin" class="mr-2 border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                            <label for="admin" class="text-sm">Admin Account</label>
                        </div>
                    </fieldset>
                    
                </div>
                <button type="submit" class="w-full bg-stone-700 text-white p-2 rounded transition duration-200 hover:bg-stone-600">Register</button>
            </form>
        </div>
        <div class="w-2/3 bg-white rounded-lg shadow-md p-6">
    <div class="max-w-4xl mx-auto rounded-lg overflow-hidden">
        <div class="p-6 flex justify-between items-center">
            <h2 class="text-3xl font-bold text-center mb-6">User Account</h2>
            <form action="archiveAccounts.php" method="post">
                <button type="submit" name="trashButton" class="px-4 py-2">
                    🗑️
                </button>
            </form>
        </div>
        <div class="overflow-y-auto" style="max-height: 500px;"> <!-- Set your desired height -->
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Account Type</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($users as $user): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6"><?php echo htmlspecialchars($user['name']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($user['accounttype']); ?></td>
                        <td class="py-3 px-6 flex space-x-2">
                            <form action="editOthersAcc.php" method="post">
                                <input type="hidden" name="sendID" value="<?php echo htmlspecialchars($user['accountid']); ?>">
                                <button type="submit" name="submitButton" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Edit Account
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    
</div>
        </div>
    </div>
</body>
</html>
