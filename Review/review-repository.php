<?php
include('../config.php');
if(session_status()!=2){
    session_start();
}
$account = isset($_SESSION['id'])?($_SESSION['id']):(3);
//leaves a review as a guest for delivery
function leaveAGuestReviewDelivery($email, $serviceType)
{
    global $conn;
    // Check if the required POST variables are set
    if (!isset($_POST['ratedeliverytime']) || !isset($_POST['ratefoodquality']) || !isset($_POST['ratepackaging']) || !isset($_POST['ratecustomerservice'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['ratedeliverytime']);
    $field2 = intval($_POST['ratefoodquality']);
    $field3 = intval($_POST['ratecleanliness']);
    $field4 = intval($_POST['ratepackaging']);
    $field5 = intval($_POST['ratecustomerservice']);
    $msg = isset($_POST['delMsg']) ? ($_POST['delMsg']) : (null);
    $acNum = 3;
    $curDate = date('Y-m-d');
    // Prepare the SQL query
    $sendReview = "INSERT INTO review (ReviewDate, AccountNum, GuestEmail, ServiceType, Field1, Field2, Field3, Field4, Field5, Message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sendReview);
    if (!$stmt) {
        // Handle the error
        return false;
    }
    // Bind the parameters to the query
    $stmt->bind_param("sisiiiiiss", $curDate, $acNum, $email, $serviceType, $field1, $field2, $field3, $field4, $field5, $msg);
    // Execute the query
    $result = $stmt->execute();
    if (!$result) {
        // Handle the error
        return false;
    }
    // Close the statement
    $stmt->close();
    // Return true if the query was successful
    return true;
}
//leaves a review as a guest for someone who went to a restaurant branch
function leaveAGuestReviewHouse($email, $serviceType)
{
    global $conn;
    // Check if the required POST variables are set
    if (!isset($_POST['rateservice']) || !isset($_POST['ratefoodquality2']) || !isset($_POST['ratecleanliness2']) || !isset($_POST['rateatmosphere']) || !isset($_POST['location'])) {
        return false;
    }
    $field1 = intval($_POST['rateservice']);
    $field2 = intval($_POST['ratefoodquality2']);
    $field3 = intval($_POST['ratecleanliness2']);
    $field4 = intval($_POST['rateatmosphere']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $acNum = 3;
    $msg = isset($_POST['inMsg']) ? ($_POST['inMsg']) : (null);
    $curDate = date('Y-m-d');
    // Prepare the SQL query
    $sendReview = "INSERT INTO review (ReviewDate, AccountNum, GuestEmail, ServiceType, Field1, Field2, Field3, Field4, Location, Message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sendReview);
    if (!$stmt) {
        // Handle the error
        return false;
    }
    // Bind the parameters to the query
    $stmt->bind_param("sisiiiiiss", $curDate, $acNum, $email, $serviceType, $field1, $field2, $field3, $field4, $location, $msg);
    // Execute the query
    $result = $stmt->execute();
    if (!$result) {
        // Handle the error
        return false;
    }
    // Close the statement
    $stmt->close();
    // Return true if the query was successful
    return true;
}
//creates a new guest reviewer
function newGuest($fname, $lname, $email)
{
    global $conn;
    // Sanitize the input data
    $email = mysqli_real_escape_string($conn, $email);
    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    // Prepare the SQL query
    $query = "INSERT INTO guestreviewer (Email, FirstName, LastName) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        // Handle the error
        return false;
    }
    // Bind the parameters to the query
    $stmt->bind_param("sss", $email, $fname, $lname);
    // Execute the query
    $result = $stmt->execute();
    if (!$result) {
        return false;
    }
    // Close the statement
    $stmt->close();
    // Return true if the query was successful
    return true;
}
// checks if this guest reviewer already exists
function findGuest($email)
{
    global $conn;
    // Sanitize the input data
    $email = mysqli_real_escape_string($conn, $email);
    // Prepare the SQL query
    $query = "SELECT * FROM guestreviewer WHERE Email = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return false;
    }
    // Bind the parameter to the query
    $stmt->bind_param("s", $email);
    // Execute the query
    $stmt->execute();
    // Get the result
    $result = $stmt->get_result();
    // Close the statement
    $stmt->close();
    // Return true if the guest was found
    return mysqli_num_rows($result) > 0;
}
//gets the account of the person reviewing
function findAccountInfo()
{
    global $account;
    global $conn;
    if ($account != 3) {
        $query = "SELECT * FROM account WHERE AccountNum = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("i", $account);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $accInfo = mysqli_fetch_array($result);
        return [$accInfo['FirstName'], $accInfo['LastName'], $accInfo['Email']];
    }
    return ['', '', ''];
}
//leaving a review for delivery when someone already has an account
function leaveAnAccountReviewDelivery($serviceType)
{
    global $conn;
    global $account;
    // Check if the required POST variables are set
    if (!isset($_POST['ratedeliverytime']) || !isset($_POST['ratefoodquality']) || !isset($_POST['ratepackaging']) || !isset($_POST['ratecustomerservice'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['ratedeliverytime']);
    $field2 = intval($_POST['ratefoodquality']);
    $field3 = intval($_POST['ratecleanliness']);
    $field4 = intval($_POST['ratepackaging']);
    $field5 = intval($_POST['ratecustomerservice']);
    $msg = isset($_POST['delMsg']) ? ($_POST['delMsg']) : (null);
    $curDate = date('Y-m-d');
    $email='no_one';
    // Prepare the SQL query
    $sendReview = "INSERT INTO review (ReviewDate, AccountNum, GuestEmail, ServiceType, Field1, Field2, Field3, Field4, Field5, Message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sendReview);
    if (!$stmt) {
        // Handle the error
        return false;
    }
    // Bind the parameters to the query
    $stmt->bind_param("sisiiiiiss", $curDate, $account, $email, $serviceType, $field1, $field2, $field3, $field4, $field5, $msg);
    // Execute the query
    $result = $stmt->execute();
    if (!$result) {
        // Handle the error
        return false;
    }
    // Close the statement
    $stmt->close();
    // Return true if the query was successful
    return true;
}
//leaving a review for in house when someone already has an account
function leaveAnAccountReviewHouse($serviceType)
{
    global $conn;
    global $account;
    // Check if the required POST variables are set
    if (!isset($_POST['rateservice']) || !isset($_POST['ratefoodquality2']) || !isset($_POST['ratecleanliness2']) || !isset($_POST['rateatmosphere']) || !isset($_POST['location'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['rateservice']);
    $field2 = intval($_POST['ratefoodquality2']);
    $field3 = intval($_POST['ratecleanliness2']);
    $field4 = intval($_POST['rateatmosphere']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $msg = isset($_POST['inMsg']) ? ($_POST['inMsg']) : (null);
    $curDate = date('Y-m-d');
    $email='no_one';
    // Prepare the SQL query
    $sendReview = "INSERT INTO review (ReviewDate, AccountNum, GuestEmail, ServiceType, Field1, Field2, Field3, Field4, Location, Message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sendReview);
    if (!$stmt) {
        // Handle the error
        return false;
    }
    // Bind the parameters to the query
    $stmt->bind_param("sisiiiiiss", $curDate, $account, $email, $serviceType, $field1, $field2, $field3, $field4, $location, $msg);
    // Execute the query
    $result = $stmt->execute();
    if (!$result) {
        // Handle the error
        return false;
    }
    // Close the statement
    $stmt->close();
    // Return true if the query was successful
    return true;
}
//adds the review to the database
function addReview()
{
    global $account;
    if (!isset($_POST['firstname']) || !isset($_POST['email']) || !isset($_POST['lastname']) || !isset($_POST['typeOfOrder'])) {
        return;
    }
    $email = $_POST['email'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $serviceType = intval($_POST['typeOfOrder']);
    if ($account != 3) {
        //if its someone with an account (account 3 is for guestreviewers);
        if($serviceType===0){
            leaveAnAccountReviewDelivery($serviceType);
        }
        else if ($serviceType===1){
            leaveAnAccountReviewHouse($serviceType);
        }
    } else {
        if (findGuest($email)) {
            //if the guest reviewer already exists
            if ($serviceType === 0) {
                leaveAGuestReviewDelivery($email, $serviceType);
            } else if ($serviceType === 1) {
                leaveAGuestReviewHouse($email, $serviceType);
            }
        } else {
            //creates new guest reviewer before leaving the review
            newGuest($fname, $lname, $email);
            if ($serviceType === 0) {
                leaveAGuestReviewDelivery($email, $serviceType);
            } else if ($serviceType === 1) {
                leaveAGuestReviewHouse($email, $serviceType);
            }
        }
    }
}
addReview();