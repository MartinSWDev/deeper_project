<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class product
{
    public string $title;
}

if (!empty($_GET)|| !isset($_GET)) {
    $product = new product();
    $product->title = $_GET['title'];

    $serialisedCalc = serialize($product);
    file_put_contents('my-calculations.txt', $serialisedCalc, FILE_APPEND);

    $calcFromFile = file_get_contents('my-calculations.txt');
}
?>

<!DOCTYPE html>
<html lang="en">
<body>

<form action="" method="get">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <button type="submit">Submit</button>
</form>


</body>


</html>

