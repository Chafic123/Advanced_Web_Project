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
</head>

<body>
    <?php
        include("../config.php");
        include "cms-nav.php";
    ?>
    <div style="text-align: center;">
        <h1>Reviews</h1>
    </div>
    <form class='filtering-form' id='filter-reviews'>
        <div>
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
        <div>
            <label for="rating-categories">Organize By:</label>
            <select class="form-select" aria-label="Default select example" name="rating-categories" id='ratings-cat'>
                <option value='' disabled selected>Select Rating Category</option>
                <option value='0'>All</option>
                <option value='1'>Delivery Time</option>;
                <option value='2'>Food Quality</option>;
                <option value='3'>Cleanliness</option>;
                <option value='4'>Packaging</option>;
                <option value='5'>Customer Service</option>;
            </select>
            <small class="error" style="display:none;" id="rce">Please Select a Rating Order!</small>
        </div>
        <div>
            <label for="orderOfRating">Order From:</label>
            <select class="form-select" aria-label="Default select example" name="orderOfRating" id="order-rate">
                <option value="0" disabled selected>Select Order</option>
                <option value="1">Best to Worst</option>
                <option value="2">Worst to Best</option>
            </select>
            <small class="error" style="display:none;" id="roe">Please Select Rating Category!</small>
        </div>
        <button type="reset" class="btn btn-primary" id="reset">Reset</button>
    </form>
    <div>
        <table class='table' id='review-table'>
            <?php
            $st=0;
            $query="SELECT * from review where ServiceType=?";
            $stmt=$conn->prepare($query);
            if(!$stmt){
                return false;
            }
            $stmt->bind_param("i", $st);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            require('cms-review-table.php');
            DeliveryTable($result);
            ?>
        </table>
        
    </div>
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