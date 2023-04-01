<?php
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'webshop_db';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$id = "";
$product_name = "";
$product_price = "";
$product_desc = "";
$product_image = "";
$product_category = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /webshop-php/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $connection->query($sql);

    if ($result->num_rows == 0) {
        header("location: /webshop-php/index.php");
        exit;
    }

    $row = $result->fetch_assoc();
    $product_name = $row["product_name"];
    $product_price = $row["product_price"];
    $product_desc = $row["product_desc"];
    $product_image = $row["product_image"];
    $product_category = $row["product_category"];

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_desc = $_POST["product_desc"];
    $product_image = $_POST["product_image"];
    $product_category = $_POST["product_category"];

    if (empty($id) || empty($product_name) || empty($product_price) || empty($product_desc) || empty($product_image) || empty($product_category)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE products SET product_name='$product_name', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', product_category='$product_category' WHERE id=$id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "The product has now been updated";
            header("location: /webshop-php/administrator.php");
            exit;
        }
    }
}


$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-6xl mx-auto">
        <h1>New Product</h1>

        <?php
        if (!empty($errorMessage)){
            echo "
            <p>$errorMessage</p>";
        }
        ?>

        <form  method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_name">
            Name
            </label>
            <input id="title" name="product_name" value="<?php echo $product_name; ?>" type="text" placeholder="product_name" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_price">
            Price
            </label>
            <input id="product_price" name="product_price" value="<?php echo $product_price; ?>" type="text" placeholder="product_price" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_desc">
            Description
            </label>
            <input id="product_desc" name="product_desc" value="<?php echo $product_desc; ?>" type="text" placeholder="product_desc" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_image">
            Image
            </label>
            <input id="product_image" name="product_image" value="<?php echo $product_image; ?>" type="text" placeholder="product_image" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_category">
            Category
            </label>
            <input id="product_category" name="product_category" value="<?php echo $product_category; ?>" type="text" placeholder="product_category" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <?php 
        if ( !empty($successMessage)){
            echo "
            <p>$successMessage</p>
            ";
        }
        ?>

        <div>
            <button type="submit" class="bg-blue-500 py-2 px-3">submit</button>
            <button class="bg-blue-500 py-2 px-3" href="/webshop-php/index.php" role="button">cancel</button>
        </div>
        </form>
    </div>
</body>
</html>
