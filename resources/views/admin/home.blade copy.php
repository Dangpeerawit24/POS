<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slide-In Navbar with Close Button</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <a href="#" class="text-lg font-semibold text-gray-800">MyLogo</a>
                <!-- Menu Button -->
                <div class="md:hidden">
                    <label for="menu-toggle" class="cursor-pointer">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </label>
                    <input type="checkbox" id="menu-toggle" class="hidden">
                </div>
                <!-- Desktop Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Home</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium">ขายหน้าร้าน</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Services</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Slide-in Menu -->
    <div id="menu" class="fixed inset-0 bg-white z-20 transform -translate-x-full transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">
            <!-- Close Button -->
            <div class="flex justify-end p-4">
                <button id="close-menu" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <!-- Menu Links -->
            <div class="flex flex-col h-full  items-center space-y-6">
                <a href="#" class="text-gray-600 hover:text-gray-900 text-lg font-medium">Home</a>
                <a href="#" class="text-gray-600 hover:text-gray-900 text-lg font-medium">About</a>
                <a href="#" class="text-gray-600 hover:text-gray-900 text-lg font-medium">Services</a>
                <a href="#" class="text-gray-600 hover:text-gray-900 text-lg font-medium">Contact</a>
            </div>
        </div>
    </div>

    <script>
        const toggle = document.querySelector('#menu-toggle');
        const menu = document.querySelector('#menu');
        const closeMenu = document.querySelector('#close-menu');

        // Open menu
        toggle.addEventListener('change', () => {
            if (toggle.checked) {
                menu.classList.remove('-translate-x-full');
            } else {
                menu.classList.add('-translate-x-full');
            }
        });

        // Close menu
        closeMenu.addEventListener('click', () => {
            menu.classList.add('-translate-x-full');
            toggle.checked = false;
        });
    </script>
</body>
</html>
