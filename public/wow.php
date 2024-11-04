<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> <!-- Your custom styles -->
    <title>Comprehensive Dashboard</title>
</head>
<body>
    <header class="bg-teal-700 text-white p-4 flex justify-between items-center flex-wrap">
    <h1 class="text-3xl font-medium">
            <a href="mainPage.php">🗺️ Comprehensive Dashboard Balagtas, Bulacan</a>
        </h1>
        <nav>
            <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                <li><a href="#" class="text-white text-3xl font-small">Name</a></li>
                <li class="relative"> 
                <button id="dropdownButton" class="focus:outline-none">
                    <img src="img/ic_menu.png" alt="Menu Icon" class="w-8 h-8">
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg hidden">
                    <ul class="py-2">
                        <li><a href="accountSettings.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Account Settings</a></li>
                        <li><a href="createAccount.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Register Account</a></li>
                        <li><a href="manageAcc.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Manage Account</a></li>
                        <li><a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</a></li>
                    </ul>
                </div>
                </li>
            </ul>
        </nav>
    </header>

    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Optional: Close the dropdown if clicked outside
        window.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
