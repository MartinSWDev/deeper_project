<?php

$answer = "";
$a = "";
$b = "";

class Calculation {
    public $timestamp;
    public $a;
    public $operation;
    public $b;
}

if(!empty($_GET)) {
    $a = $_GET['a'];
    $b = $_GET['b'];
    $operation = $_GET['operation'];

    $calculation = new Calculation();
    $calculation->timestamp = date("d-m-Y H:i");
    $calculation->a = $a;
    $calculation->operation = $operation;
    $calculation->b = $b;

    $serialisedCalc = serialize($calculation);
    file_put_contents(time().'.txt', $serialisedCalc);


    switch ($operation) {
        case "add":
            $answer = $a + $b;
            echo $answer;
            break;
        case "subtract":
            $answer = $a - $b;
            echo $answer;
            break;
        case "multiply":
            $answer = $a * $b;
            echo $answer;
            break;
        case "divide":
            $answer = $a / $b;
            echo $answer;
            break;
        default:
            echo "The operations available add, subtract, multiply, and divide.";
    }
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Axios-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Calculator</title>
</head>
<body>
<div class="container">
    <div class="m-5">
        <h1 class="p-3">Welcome To The Calculator</h1>
        <form id="calcform" method="get">
            <div class="form-group form-inline p-2">
                <label for="a">A:</label>
                <input type="number" class="form-control" name="a" id="a" placeholder="1">
            </div>
            <div class="form-group form-inline p-2">
                <label for="b">B:</label>
                <input type="number" class="form-control" name="b" id="b" placeholder="2">
            </div>
            <div class="form-group form-inline p-2">
                <label for="operation">Operaton:</label>
                <select id="operation" class="form-control" name="operation">
                    <option value="add">Add</option>
                    <option value="subtract">Subtract</option>
                    <option value="multiply">Multiply</option>
                    <option value="divide">Divide</option>
                </select>
            </div>
            <div class="form-group p-2">
                <label for="answer">Answer:</label>
                <input type="number" value="<?= $answer?>" class="form-control" name="answer" id="answer" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>

    <div class="container">
        <h2>Previous Calculations</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Timestamp</th>
                <th scope="col">Value of A</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach (glob("*.txt") as $previousCalcs) {
                $prevCalcFiles = file_get_contents($previousCalcs);
                $unserialisedCalc = unserialize($prevCalcFiles);
                echo "<tr>";
                echo "<th scope='row'>$unserialisedCalc->timestamp</th>";
                echo "<td>$unserialisedCalc->a</td>";
                echo "<td>$unserialisedCalc->operation</td>";
                echo "<td>$unserialisedCalc->b</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>


        <script>
            window.addEventListener('DOMContentLoaded', function() {
                $(".table tr").click(function () {
                    $(this).children("td").each(function (index) {
                        if (index === 0) {
                            $("#a").val(this.innerText);
                        }
                        if (index === 1) {
                            $("#operation").val(this.innerText);
                        }
                        if (index === 2) {
                            $("#b").val(this.innerText);
                        }
                        $("#answer").val(null);
                    })

                })

                let form = $('#calcform');
                form.on('submit', function(e) {
                    e.preventDefault();
                    calculator();
                });

            });

            function calculator() {
                let a = $('#a').val();
                let b = $('#b').val();
                let op = $('#operation').children('option:selected').val();

                axios.get("W3S1_Task_5_To_8.php?a=" + a + '&b=' + b + '&operation=' + op)
                    .then(res => {
                        console.log(res.data);
                        $("#answer").val(res.data);
                    })
            }


        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>