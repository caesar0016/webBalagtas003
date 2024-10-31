<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body class="bg-orange-400 flex items-center justify-center h-screen relative">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md relative">
        <a href="mainPage.php" target="_top" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition duration-200 text-lg">
            &times; <!--Should Replace it-->
        </a>
        <h2 class="text-3xl font-bold text-center mb-6">Account Settings</h2>
        <form action="register.php" method="POST" id="accountForm">
            <div class="grid grid-cols gap-4 mb-4">
                <label for="name" class="block text-sm font-medium">Name:</label>
                <input type="text" id="name" name="name01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

                <label for="username" class="block text-sm font-medium">Username:</label>
                <input type="text" id="username" name="username01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

                <label for="password" class="block text-sm font-medium">New Password:</label>
                <input type="password" id="password" name="password01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="20">

                <label for="confirm-password" class="block text-sm font-medium">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirmPass01" required class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="20">
                <div id="error" class="hidden text-red-500">Passwords do not match!</div>
                
            </div>
            <button type="submit" class="w-full bg-stone-700 text-white p-2 rounded transition duration-200 hover:bg-stone-600">Register</button>
        </form>
    </div>
    <script>
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



