<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> <!-- Your custom styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Comprehensive Dashboard</title>
</head>
<body>
    <header class="bg-teal-500 text-black p-4 flex justify-between items-center flex-wrap">
        <h1 class="text-3xl font-medium mb-2 md:mb-0">🗺️ Comprehensive Dashboard Balagtas, Bulacan</h1>
        <nav>
            <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                <li><a href="#" class="text-black hover:underline text-3xl font-medium">Name</a></li>
                <div>
                    
                </div>
                <li class="relative"> 
                    <button id="dropdownButton" class="text-black hover:underline focus:outline-none text-3xl font-medium">Menu</button>
                    <ul id="dropdownMenu" class="hidden absolute right-0 bg-white text-black shadow-lg mt-2 rounded-md">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Web Development</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">SEO Services</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Graphic Design</a></li>
                    </ul>
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
