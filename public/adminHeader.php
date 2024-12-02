<?php
session_start();
?>
<header class="bg-teal-700 text-white sticky top-0 z-10">
    <link rel="stylesheet" href="css/style.css">
    <section class="max-w-4xl mx-auto p-4 flex justify-between items-center">
        <h1 class="text-3xl font-medium">
            <a href="mainPage.php">🗺️ Comprehensive Dashboard Balagtas, Bulacan</a>
        </h1>
        <div class="flex items-center"> <!--dropdownButton-->
            <div class="relative">
                <button id="dropdownButton" class="focus:outline-none text-black">
                    <div class="text-2xl font-small">
                    <?php
                        if (isset($_SESSION['username01'])) {
                            echo htmlspecialchars($_SESSION['username01']);
                        } else {
                            // If no session, display "Login" as clickable link
                            echo "<a href='login.php' class='text-2xl'>Login</a>";
                        }
                    ?>
                    </div>
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg hidden">
                    <ul class="py-2">
                        <li><a href="accountSettings.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Account Settings</a></li>
                        <li><a href="manageAcc01.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Manage Account</a></li>
                        <li><a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</header>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', (event) => { 
            event.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', () => {
            dropdownMenu.classList.add('hidden');
        });
    });
</script>
