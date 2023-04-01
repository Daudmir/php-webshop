<?php 
session_start();

// Check if the user is an admin
if (!isset($_SESSION['admin'])) {
    // Display the message
    echo "Restricted Area: requires authentication";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css">
</head>
<body class="bg-gray-200">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed. -->
                    <!--
                      Heroicon name: outline/menu

                      Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <!--
                      Heroicon name: outline/x

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0">
                    <a href="index.php" class="text-white text-xl font-bold">Webshop</a>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">Home</a>
                        <a href="products.php"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">Products</a>
                        <?php if(!isset($_SESSION['email'])): ?>
                        <a href="register.html"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">Sign up</a>
                        <a href="login.html"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">Log in</a>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['email'])): ?>
                          <form action="logout.php" method="post" class="inline-block" name="logoutForm">
    <button type="submit" name="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Log out</button>
</form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </nav>
    <section class="max-w-6xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-10">Admin Dashboard</h1>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <a href="/webshop-php/create.php" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">New Product</a>
            </div>
            <?php 
                $servername = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'webshop_db';
                $connection = new mysqli($servername, $username, $password, $database);
                $sql = "SELECT * FROM products";
                $result = $connection->query($sql);
                while($row = $result->fetch_assoc()){
                    echo "<div class='p-4 border-b border-gray-200'>
                            <div class='flex justify-between items-center'>
                                <h3 class='font-bold'>$row[product_name]</h3>
                                <div>
                                    <a href='/webshop-php/edit-product.php?id=$row[id]' class='bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg mr-2'>Edit</a>
                                    <a href='/webshop-php/delete.php?id=$row[id]' class='bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg'>Remove</a>
                                </div>
                            </div>
                            <p class='text-gray-600'>Price: $row[product_price]</p>
                            <p class='text-gray-600'>Description: $row[product_desc]</p>
                            <p class='text-gray-600'>Image: $row[product_image]</p>
                        </div>";
                }
            ?>
        </div>
    </section>
</body>
</html>