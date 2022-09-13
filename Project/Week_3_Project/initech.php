<?php

class checkIn
{
    public $userName;
    public $rating;
    public $review;
    public $timestamp;
}

if (!empty(file_get_contents("php://input"))) {
    $data = json_decode(file_get_contents("php://input"), TRUE);

    $checkInInst = new checkIn();
    $checkInInst->userName = htmlspecialchars($data["userName"]);
    $checkInInst->rating = $data["rating"];
    $checkInInst->review = htmlspecialchars($data["review"]);
    $checkInInst->timestamp = date("d-m-Y H:i");


    if (file_exists("check-ins.txt")) {
        $oldCheckIns = file_get_contents("check-ins.txt");
        $unserialisedCheckIns = unserialize($oldCheckIns);
        array_push($unserialisedCheckIns, $checkInInst);
        $reSerialisedCheckIns = serialize($unserialisedCheckIns);
        file_put_contents("check-ins.txt", $reSerialisedCheckIns);
    } else {
        $newCheckIns = [];
        array_push($newCheckIns, $checkInInst);
        $serialisedNewCheckIns = serialize($newCheckIns);
        file_put_contents("check-ins.txt", $serialisedNewCheckIns);
    }
    die();

}
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Week 2 session 2 -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <title>Initech Really Cool Things</title>
    <style>
        .star-rating {
            display: inline-block;
            position: relative;
            font-family: FontAwesome;
        }

        .star-rating::before {
            content: "\f006 \f006 \f006 \f006 \f006";
        }

        .star-inner {
            position: absolute;
            top: 0;
            left: 0;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
        }

        .star-inner::before {
            content: "\f005 \f005 \f005 \f005 \f005";
            color: #f8ce0b;
        }

        .alert {
            margin-bottom: 0;
        }
    </style>
</head>


<body>
<div class="row">
    <!-- Spacer Div -->
    <div class="col-2"></div>

    <!-- Whole Page -->
    <div class="col-8">


        <!--Top Section-->
        <section class="carousel-and-info my-3 p-3 border border-secondary rounded-2">
            <div class="row">
                <!--Carousel-->
                <div class="container col-md-6 ">
                    <div id="carouselAll" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">"
                            <div class="carousel-item active">
                                <img src="../Assets/Cat1_1920by920.jpg" class="d-block w-100" alt="Large image of black and white kitten touching flower on cobbles">
                            </div>
                            <div class="carousel-item">
                                <img src="../Assets/Cat2_1920by920.jpg" class="d-block w-100" alt="Large picture of fat striped cat sat on bottom like human facing camera">
                            </div>
                            <div class="carousel-item">
                                <img src="../Assets/Cat3_1920by920.jpg" class="d-block w-100" alt="Large image of kitten on brown rug looking up at camera">
                            </div>

                        </div>
                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAll" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAll" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    </div>
                </div>

                <!--Intro Section-->
                <div class="container col-md-6">
                    <h1>Lorem Ipsum</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad beatae consectetur cumque
                        cupiditate distinctio doloribus eum ex excepturi harum hic, impedit iure minima placeat possimus
                        qui sit sunt totam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consequatur
                        cum distinctio inventore ipsa laudantium molestias nam nesciunt nisi, officia rem voluptate.
                        Animi consequuntur iure maiores, officia quis velit vitae.
                    </p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal">
                        Check In
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="review-form">
                                        <div class="form-group">
                                            <label for="userName">Name:</label>
                                            <input type="text" name="userName" id="userName" maxlength="20" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rating">Rating:</label>
                                            <input type="number" name="rating" id="rating" min="0" max="5">
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review:</label>
                                            <input type="text" name="review" id="review">
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#reviewModal">Submit Review
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Additional Information heading + Stats Container Below -->
        <h2 class="my-4">Additional Information</h2>
        <section class="section-2  my-3 p-3 border border-secondary rounded-2">
            <div class="container">
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="row"> Average Rating</th>
                        <td>
                            <div class="star-rating far fa-star">
                                <div class="star-inner starTotal fas fa-star">">

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"> Another Statistic</th>
                        <td>
                            78/100
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"> Yet Another Statistic</th>
                        <td>
                            Something
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Recent Check-Ins Container -->

        <div class="reviews">
            <h2 class="my-4">Recent Check-Ins</h2>
            <div id="reviews-go-here">
                <?php
                if (file_exists("check-ins.txt")) {
                    $reviews = file_get_contents("check-ins.txt");
                    $unserialisedReviews = array_reverse(unserialize($reviews));

                    foreach ($unserialisedReviews as $oldReviews) { ?>
                        <div class='container my-3 p-3 border border-secondary rounded-2'>
                            <div class='row'>
                                <p class=''><?= $oldReviews->userName ?></p>
                                <p class=''><?= $oldReviews->rating ?></p>
                            </div>
                            <div class='row'>
                                <p><?= $oldReviews->review ?></p>
                                <p><?= $oldReviews->timestamp ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="modal" id="successM" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your review was submitted
                    <button type="button" class="close" data-bs-dismiss="alert" data-toggle="modal" data-target="#successM" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="failM" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failure!</strong> Your review was not submitted
                    <button type="button" class="close" data-bs-dismiss="alert" data-toggle="modal" data-target="#failM" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Div Spacer -->
    <div class="col-2"></div>

</div>

<script>
    window.addEventListener("DOMContentLoaded", function () {

        $("#successM").hide();
        $("#failM").hide();

        $("#review-form").on("submit",async function (e) {
            e.preventDefault();
           await checkIn();
            $("#reviewModal").on('hidden.bs.modal', function () {
                $(this).find('#review-form').trigger('reset');
            })
        })


        function checkIn() {

            const userName = $("#userName").val();
            const rating = $("#rating").val();
            const review = $("#review").val();

            axios({
                method: 'post',
                url: 'initech.php',
                data: {
                    "userName":userName,
                    "rating": rating,
                    "review":review,
                },
            })
                .then(function (response) {
                    console.log(response);
                    if (response.statusText === "OK") {
                        $('#successM').toggle();
                    }
                    else {
                        console.log("failure to send")
                        $('#failM').toggle();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })

        }
    })


</script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>




