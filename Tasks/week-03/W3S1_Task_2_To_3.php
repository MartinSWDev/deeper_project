<?php
//Test 3 Edit Line
if (!empty($_GET)) {

    $a = $_GET['a'];
    $b = $_GET['b'];
    $operation = $_GET['operation'];
    echo match ($operation) {
        "add" => $a + $b,
        "subtract" => $a - $b,
        "multiply" => $a * $b,
        "divide" => $a / $b,
        default => "The operations available add, subtract, multiply, and divide.",
    };
}
?>

<!doctype html>
<html>
<body>
<form>
    <label for="a">A:</label>
    <input type="number" name="a" id="a">
    <label for="b">B:</label>
    <input type="number" name="b" id="b">
    <label for="operation">Operaton:</label>
    <select id="operation" name="operation">
        <option value="add">Add</option>
        <option value="subtract">Subtract</option>
        <option value="multiply">Multiply</option>
        <option value="divide">Divide</option>
    </select>
    <button type="submit">Calculate</button>
</form>
</body>
</html>
