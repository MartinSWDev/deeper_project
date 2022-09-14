<?php

use Carbon\Carbon;

//Load Dotenv
require_once realpath(__DIR__ . '/../../vendor/autoload.php');
Use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$siteKey = $_ENV['SITEKEY'];
$secretKey = $_ENV['SECRETKEY'];

class photoForm {
    public $userName;
    public $userDob;
    public $userEmail;
    public $userPicture;
    public $submitted;
}

if (!empty(file_get_contents("php://input"))) {
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $responseKey = $data['responseKey'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {
        $photoForm = new photoForm();
        $photoForm->userName = $data["userName"];
        $photoForm->userDob = $data["userDob"];
        $photoForm->userEmail = $data["userEmail"];
        $photoForm->submitted = Carbon::now()->timestamp;
    }
        if (!empty($data['userPicture'])) {
            $file = $data['userPicture'];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $responseMessage = '<div class="alert alert-warning" role="alert">Submission Error</div>';
        }
        else {
            $target_dir = 'uploads/' . $file['name'];
            if (!move_uploaded_file(
                $file['tmp_name'],
                $target_dir
            )) {
                throw new RuntimeException('Submission failed to store');
            }

            $photoForm->userPicture = $target_dir;
            $serialisedPhotoForm = serialize($photoForm);
            file_put_contents("$photoForm->submitted" . ".txt", $serialisedPhotoForm);

            $responseMessage = '<div class="alert alert-success" role="alert">Submission Success!</div>';
        }

}



?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootsrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!-- Axios-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/2c85c2123e.js" crossorigin="anonymous"></script>

    <!-- Google RECAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>Photo Submit</title>

    <!-- Set Carousel Control Colors -->
    <style>
        .carousel-control-next, .carousel-control-prev {
            color: black;
        }
    </style>

</head>
<body>
<h1>Photo Submit</h1>
<div class="container">
    <form id="pictureForm" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="userName">Name:</label>
            <input type="text" class="form-control" id="userName" name="userName">
        </div>
        <div class="form-group">
            <label for="userDob">Date of Birth:</label>
            <input type="date" class="form-control" id="userDob" name="userDob"> <!-- Change to date type -->
        </div>
        <div class="form-group">
            <label for="userEmail">Email:</label>
            <input type="email" class="form-control" id="userEmail" name="userEmail"> <!-- Change to email type -->
        </div>
        <div class="form-group">
            <label for="userPicture">Picture:</label>
            <input type="file" class="form-control" id="userPicture" name="userPicture"> <!-- Change to picture type -->
        </div>
        <div class="g-recaptcha" data-sitekey="<?=$siteKey?>"></div>
        <br/>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php if (isset($responseMessage)) echo $responseMessage; ?>
    </form>

    <!--Carousel-->
    <div class="container col-md-6 ">
        <div id="carouselPhotos" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php $images = array_diff(scandir('uploads/', SCANDIR_SORT_NONE), array('..', '.'));
                $head = $images[0];
                echo "<div class='carousel-item active'>";
                echo "<img src='uploads/$head' class='d-block w-100'>";
                echo "</div>";

                function getRestOfImages($i) {
                    return $i > 0;
                }

                $restOfImages = array_filter($images, 'getRestOfImages', ARRAY_FILTER_USE_KEY);
                foreach ($restOfImages as $images) {
                    echo "<div class='carousel-item'>";
                    echo "<img src='uploads/$images' class='d-block w-100'>";
                    echo "</div>";
                };
                ?>
            </div>

            <!-- Carousel Controls -->
            <div>
                <a class="carousel-control-prev" href="#carouselPhotos" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselPhotos" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>


</div>

<script>

    window.addEventListener('DOMContentLoaded', function() {
        let form = $('#pictureForm');
        form.on('submit', function(e) {
            e.preventDefault();
            pictureForm();
            console.log("Done1")
        });
    });

    function pictureForm() {

        let userName = $("#userName").val();
        let userDob = $("#userDob").val();
        let userEmail = $("#userEmail").val();
        let userPicture = $("#userPicture").val();
        console.log(userPicture)
        let response = grecaptcha.getResponse();

        //POST form data to same page
        axios({
            method: 'post',
            url: 'W4S1_Task_1_to_7.php',
            data: {
                "userName": userName,
                "userDob": userDob,
                "userEmail": userEmail,
                "userPicture": {userPicture,
                "responseKey": response
            }
        })
            .catch(function (err) {
                console.log(err);
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
