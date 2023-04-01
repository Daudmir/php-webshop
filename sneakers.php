<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/%22%3E"></script>
    <link href="https://unpkg.com/tailwindcss@%5E1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
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
    <div>
    <section id="products" class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-900 text-center mt-12 mb-20">Sneakers</h1>

                            <button id="menu-btn" class="bg-red-500">Menu</button>
<div id="menu">
  <ul class="mt-20">
    <li><a href="#" class="font-bold">Products</a></li>
    <li><a href="#">Clothes</a>
      <ul>
        <li><a href="t-shirt.php">T-Shirts</a></li>
      </ul>
    </li>
    <li><a href="#">Shoes</a>
      <ul>
        <li><a href="sneakers.php">Sneakers</a></li>
      </ul>
    </li>
  </ul>
</div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php 
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'webshop_db';

        $connection = new mysqli($servername, $username, $password, $database);

        $sql = "SELECT * FROM products WHERE product_category = 'Sneakers' LIMIT 3";
        $result = $connection->query($sql);

        while($row = $result->fetch_assoc()){
            echo "
            <div class='bg-white shadow-md rounded-lg p-6'>
                <img src='$row[product_image]' class='w-full h-62 object-cover object-center rounded-md mb-4'>
                <h2 class='text-lg font-medium text-gray-900 mb-2'>$row[product_name]</h2>
                <p class='text-gray-600 mb-4'>$row[product_desc]</p>
                <p class='text-gray-900 font-bold text-lg mb-2'>$$row[product_price]</p>
                <a href='#' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>Add to cart</a>
            </div>
            ";
        }
        ?>
    </div>
</section>
<script src="main.js"></script>
    </div>
</body>
</html>