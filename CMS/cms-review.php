<?php 
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cms.css">
    <link rel="stylesheet" href="cms-review.css">
</head>

<body>
    <?php
        include "cms-nav.php";
    ?>
    <div class="container">
        <main class="reviewMain">
            <div class="Title">
                <section class="title-text">
                    <h1 class="first-part">Reviews</h1>
                </section>
                <section class="title-img">
                    <img src="../Malaz Design\Malaz---icon cropped.png">
                </section>
            </div>
            <form class='filtering-form' id='filter-reviews'>
                <div class="formin">
                    <div  class="inputt">
                        <label for="type-of-service" class="inLabel">Type</label>
                        <div class="radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type-of-service" id="delivery" value="0" checked>
                                <label class="form-check-label" for="delivery">
                                    Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type-of-service" id="in-house" value="1">
                                <label class="form-check-label" for="in-house">
                                    In House
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="inputt">
                        <label for="rating-categories" class="inLabel">Organize By</label>
                        <select class="form-select" aria-label="Default select example" name="rating-categories" id='ratings-cat'>
                            <option value='' disabled selected>Select Rating Category</option>
                            <option value='0'>All</option>
                            <option value='1'>Delivery Time</option>;
                            <option value='2'>Food Quality</option>;
                            <option value='3'>Cleanliness</option>;
                            <option value='4'>Packaging</option>;
                            <option value='5'>Customer Service</option>;
                        </select>
                    </div>
                    <div class="inputt">
                        <label for="orderOfRating" class="inLabel">Order From</label>
                        <select class="form-select" aria-label="Default select example" name="orderOfRating" id="order-rate">
                            <option value="0" disabled selected>Select Order</option>
                            <option value="1">Best to Worst</option>
                            <option value="2">Worst to Best</option>
                        </select>
                    </div>
                </div>
                
                <div class="inputt">
                    <button type="reset" class="btn btn-light bs" id="reset">Reset</button>
                </div>
            </form> 
        </main>
    </div>
    <!-- Display the reviews -->
    <div class="tcontainer p-2 overflow-scroll">
        <table class="table table-striped table-bordered table-sm" border='1' id='review-table'>
            <?php
            include("../config.php");
            $st=0;
            $query="SELECT * from review where ServiceType=?";
            $stmt=$conn->prepare($query);
            $stmt->bind_param("i", $st);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            require('cms-review-table.php');
            DeliveryTable($result);
            $conn->close();
            ?>
        </table>
    </div>

    <?php
    include "cms-footer.php";
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="cms-review.js"></script>
</body>

</html>
<?php
}else{
    header("Location: ../Home/index.php");
}
?>