<?php
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'webshop_db';

$connection = new mysqli($servername, $username, $password, $database);

$name = '';
$price = '';
$description = '';
$image = '';

$errorMessage = '';
$succesMessage = '';

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    do {
        if (empty($name) || empty($price) || empty($description) || empty($image)) {
            $errorMessage = 'All the fields are required';
            break;
        }

        $sql = "INSERT INTO products (product_name, product_price, product_desc, product_image) " .
       "VALUES ('$name', '$price', '$description', '$image')";
$result = $connection->query($sql);

        $name = '';
        $price = '';
        $description = '';
        $image = '';

        $succesMessage = 'Product added correctly';
        
    }while (false);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/%22%3E"></script>
    <link href="https://unpkg.com/tailwindcss@%5E1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Web shop</title>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-medium mb-6">New Product</h2>

        <?php
        if ( !empty($errorMessage)){
            echo "
            <div class='bg-red-200 p-3 mb-6 rounded-md'>
                <strong class='text-red-600'>$errorMessage</strong>
            </div>
            ";
        }
        ?>

        <form method='post'>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Name</label>
                <input class='border-2 rounded-lg border-gray-400 py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300' type='text' name='name' value='<?php echo $name; ?>'>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Price</label>
                <input class='border-2 rounded-lg border-gray-400 py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300' type='text' name='price' value='<?php echo $price; ?>'>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Description</label>
                <input class='border-2 rounded-lg border-gray-400 py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300' type='text' name='description' value='<?php echo $description; ?>'>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Image</label>
                <input class='border-2 rounded-lg border-gray-400 py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300' type='text' name='image' value='<?php echo $image; ?>'>
            </div>

            <?php
            if ( !empty($succesMessage)){
                echo "
                <div class='bg-green-200 p-3 mb-6 rounded-md'>
                    <strong class='text-green-600'>$succesMessage</strong>
                </div>
                ";
            }
            ?>

            <div class="flex space-x-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-md" type='submit'>Submit</button>
                <a href="administrator.php" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium px-4 py-2 rounded-md" role='button'>Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>