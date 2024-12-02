<?php
include("adminHeader.php");

$host = "localhost";
$port = "5432";
$dbName = "webBalagtas01";
$user = "postgres";
$password = "Kuz18647";

// Create connection string
$connectionString = "host=$host port=$port dbname=$dbName user=$user password=$password";

// Establish connection
$conn = pg_connect($connectionString);


$user = null; // Initialize user variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['sendID'];

    // Prepare the SQL query to fetch user details
    $query = "SELECT * FROM tblAccount WHERE accountid = $1";
    $result = pg_prepare($conn, "fetchData", $query); // Use $query here
    $result = pg_execute($conn, "fetchData", array($id));

    // Check if the user was found
    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result); // Fetch user data
    } else {
        die("Error: User not found.");
    }
}
// Close the connection
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="bg-orange-400 flex items-center justify-center h-screen relative">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md relative">
        <a href="mainPage.php" target="_top" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition duration-200 text-lg">
            &times; <!--Should Replace it-->
        </a>
        <h2 class="text-3xl font-bold text-center mb-6">Edit Account</h2>
        <form action="updateAcc.php" method="POST" id="editAccFrm">
            <div class="grid grid-cols gap-4 mb-4">
                <input type="hidden" name="sendID" value="<?php echo htmlspecialchars($user['accountid']); ?>">
                <label for="name" class="block text-sm font-medium">Name:</label>
                <input type="text" id="name" name="name01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo htmlspecialchars($user['name']); ?>">

                <label for="username" class="block text-sm font-medium">Username:</label>
                <input type="text" id="username" name="username01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo htmlspecialchars($user['username']); ?>">

                <label for="password" class="block text-sm font-medium">New Password:</label>
                <input type="password" id="password" name="password01" class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="20">

                <label for="confirm-password" class="block text-sm font-medium">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirmPass01" class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="20">
                <div id="error" class="hidden text-red-500">Passwords do not match!</div>
                
                <div class="mb-4">
                <label class="block text-gray-700">Account Type:</label>
                
                <div class="mb-4">
                    <!--This is the start of radio button-->
                <div class="flex items-center">
                <label class="flex items-center mr-6">
                    <input type="radio" name="userType" value="Admin" class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required/>
                    <span class="ml-2 text-gray-700">Admin</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="userType" value="Regular" class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required />
                    <span class="ml-2 text-gray-700">Regular</span>
                </label>
            </div>
            <!--This is the end of radio button-->
            </div>
            </div>
            <button type="submit" class="w-full bg-stone-700 text-white p-2 rounded transition duration-200 hover:bg-stone-600">
                Confirm
            </button>
        </form>
        <form id="deleteForm" method="POST" action="deleteAccFrm.php">
                <input type="hidden" name="accountid" value="<?php echo htmlspecialchars($user['accountid']); ?>">
                <button type="button" class="w-full px-4 py-2 bg-red-500 text-white rounded" 
                        onclick="confirmDelete()">
                    Delete Account
                </button>
            </form>
    </div>
    </div>
<script>
    function confirmDelete() {
    const confirmation = confirm("Are you sure you want to delete this account?");
        if (confirmation) {
            document.getElementById('deleteForm').submit();
        }
    }
        document.getElementById('accountForm').addEventListener('submit', function (event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const error = document.getElementById('error');
    
            if (password !== confirmPassword) {
                event.preventDefault(); // Prevent form submission
                error.classList.remove('hidden'); // Show error
            } else {
                error.classList.add('hidden'); // Hide error
                // Allow form to submit to register.php
                // This part is optional if you don't want to show alert
                // alert('Account created successfully!'); 
            }
        });
    </script>
</body>
</html>



