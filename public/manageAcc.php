<?php
    include ("header.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">User Accounts</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Actions</th> <!-- New header for actions -->
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">John Doe</td>
                        <td class="py-3 px-6">john@example.com</td>
                        <td class="py-3 px-6">Admin</td>
                        <td class="py-3 px-6">Active</td>
                        <td class="py-3 px-6">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Account</button>
                        </td> <!-- Edit button -->
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">Jane Smith</td>
                        <td class="py-3 px-6">jane@example.com</td>
                        <td class="py-3 px-6">Editor</td>
                        <td class="py-3 px-6">Inactive</td>
                        <td class="py-3 px-6">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Account</button>
                        </td> <!-- Edit button -->
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">Emily Johnson</td>
                        <td class="py-3 px-6">emily@example.com</td>
                        <td class="py-3 px-6">Viewer</td>
                        <td class="py-3 px-6">Active</td>
                        <td class="py-3 px-6">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Account</button>
                        </td> <!-- Edit button -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>