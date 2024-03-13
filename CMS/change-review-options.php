<?php
echo"<option value='' disabled selected>Select Rating Category</option>";
if (isset($_GET['typeOfService'])){
    $type=$_GET['typeOfService'];
    if($type==1){
        echo "<option value='0'>All</option>";
        echo "<option value='1'>Service</option>";
        echo "<option value='2'>Food Quality</option>";
        echo "<option value='3'>Cleanliness</option>";
        echo "<option value='4'>Atmosphere</option>";
    }
    else{
        echo "<option value='0'>All</option>";
        echo "<option value='1'>Delivery Time</option>";
        echo "<option value='2'>Food Quality</option>";
        echo "<option value='3'>Cleanliness</option>";
        echo "<option value='4'>Packaging</option>";
        echo "<option value='5'>Customer Service</option>";
    }
}