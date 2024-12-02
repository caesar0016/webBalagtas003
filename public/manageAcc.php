<?php
    include ("adminHeader.php");

        // connection.php
    $host = 'localhost';
    $db = 'webBalagtas03';
    $user = 'postgres';
    $pass = 'Kuz18647';

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }

    $sql = "select * from tblAccount where archiveflag = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 flex justify-between items-center">
        <h2 class="text-lg font-semibold mb-4">User Accounts</h2>
        <form action="archiveAccounts.php" method="post">
            <button type="submit" name="trashButton" class="px-4 py-2">
            🗑️
            </button>
        </form>
    </div>
    <div class="overflow-x-auto">
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
</body>

</html>