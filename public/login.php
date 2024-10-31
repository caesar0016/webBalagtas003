<?php
// At the top of your file to handle messages
$message = '';
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-orange-500">
    <div class="flex h-screen">
        <!-- Left Side: Login Form -->
        <div class="w-1/3 flex items-center justify-center bg-orange-300">
            <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-sm"> <!-- Card with stronger shadow -->
                <h2 class="text-3xl font-bold text-center mb-6">Login</h2>
                <form action="loginValidate.php" method="post">
                    <label for="username" class="block mb-2 text-sm font-medium">Username:</label>
                    <input type="text" id="username" name="loginUser" required class="border border-gray-300 p-2 rounded w-full mb-4" placeholder="Enter your username">
                    
                    <label for="password" class="block mb-2 text-sm font-medium">Password:</label>
                    <input type="password" id="password" name="loginPass" required class="border border-gray-300 p-2 rounded w-full mb-4" placeholder="Enter your password">
                    
                    
                    <button type="submit" class="w-full bg-stone-700 text-white p-2 rounded transition duration-200">Login</button>
                </form>
                <div id="message" class="text-red-600 mt-4">
                    <?php if (isset($_GET['message'])) echo htmlspecialchars($_GET['message']); ?>
                </div>
            </div>
        </div>
        
        <!-- Right Side: Image -->
        <div class="w-2/3 bg-indigo-300 flex items-center justify-center">
            <img src="img/sample03.jpg" alt="Sample" class="object-cover h-full w-full">
        </div>
    </div>
</body>
</html>
