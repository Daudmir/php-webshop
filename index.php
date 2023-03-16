<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/%22%3E"></script>
    <link href="https://unpkg.com/tailwindcss@%5E1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <section>
        <div>
            <?php 

            $database = 'webshop_db';
            $servername = 'localhost';
            $username = 'root';
            $password = '';

            $connection = new mysqli($servername, $username, $password, $database);

            $sql = "SELECT * FROM products";
            $result = $connection->query($sql);

            while($row = $result->fetch_assoc()){
                echo "<p>$row[id]</p> <p>$row[product_name]</p> <p>$row[product_price]</p> <p>$row[product_desc]</p> <p>$row[product_image]</p>
                <button href='/webshop-php/edit-product.php?id=$row[id]' class='bg-red-500'>Edit</button>
                <button href='/webshop-php/remove-product.php?id=$row[id]' class='bg-red-500'>Remove</button>";
            }
            ?>
        </div>
    </section>
</body>
</html>