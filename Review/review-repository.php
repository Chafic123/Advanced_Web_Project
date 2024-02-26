<?php
include('../config.php');

$account = isset($_SESSION['account'])?($_SESSION['account']):(3);

function leaveAGuestReviewDelivery($email, $serviceType)
{
    global $conn;
    // Check if the required POST variables are set
    if (!isset($_POST['rate-deliverytime']) || !isset($_POST['rate-foodquality']) || !isset($_POST['rate-packaging']) || !isset($_POST['rate-customerservice'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['rate-deliverytime']);
    $field2 = intval($_POST['rate-foodquality']);
    $field3 = intval($_POST['rate-cleanliness']);
    $field4 = intval($_POST['rate-packaging']);
    $field5 = intval($_POST['rate-customerservice']);
    $msg = isset($_POST['del-msg']) ? ($_POST['del-msg']) : (null);
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

function leaveAGuestReviewHouse($email, $serviceType)
{
    global $conn;
    // Check if the required POST variables are set
    if (!isset($_POST['rate-service']) || !isset($_POST['rate-foodquality2']) || !isset($_POST['rate-cleanliness2']) || !isset($_POST['rate-atmosphere']) || !isset($_POST['location'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['rate-service']);
    $field2 = intval($_POST['rate-foodquality2']);
    $field3 = intval($_POST['rate-cleanliness2']);
    $field4 = intval($_POST['rate-atmosphere']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $acNum = 3;
    $msg = isset($_POST['in-msg']) ? ($_POST['in-msg']) : (null);
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
        // Handle the error
        return false;
    }
    // Close the statement
    $stmt->close();
    // Return true if the query was successful
    return true;
}

function findGuest($email)
{
    global $conn;
    // Sanitize the input data
    $email = mysqli_real_escape_string($conn, $email);
    // Prepare the SQL query
    $query = "SELECT * FROM guestreviewer WHERE Email = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        // Handle the error
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

function leaveAnAccountReviewDelivery($serviceType)
{
    global $conn;
    global $account;
    // Check if the required POST variables are set
    if (!isset($_POST['rate-deliverytime']) || !isset($_POST['rate-foodquality']) || !isset($_POST['rate-packaging']) || !isset($_POST['rate-customerservice'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['rate-deliverytime']);
    $field2 = intval($_POST['rate-foodquality']);
    $field3 = intval($_POST['rate-cleanliness']);
    $field4 = intval($_POST['rate-packaging']);
    $field5 = intval($_POST['rate-customerservice']);
    $msg = isset($_POST['del-msg']) ? ($_POST['del-msg']) : (null);
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

function leaveAnAccountReviewHouse($serviceType)
{
    global $conn;
    global $account;
    // Check if the required POST variables are set
    if (!isset($_POST['rate-service']) || !isset($_POST['rate-foodquality2']) || !isset($_POST['rate-cleanliness2']) || !isset($_POST['rate-atmosphere']) || !isset($_POST['location'])) {
        return false;
    }
    // Sanitize the input data
    $field1 = intval($_POST['rate-service']);
    $field2 = intval($_POST['rate-foodquality2']);
    $field3 = intval($_POST['rate-cleanliness2']);
    $field4 = intval($_POST['rate-atmosphere']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $msg = isset($_POST['in-msg']) ? ($_POST['in-msg']) : (null);
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

function addReview()
{
    global $account;
    if (!isset($_POST['firstname']) || !isset($_POST['email']) || !isset($_POST['lastname']) || !isset($_POST['type-of-order'])) {
        // Handle the error
        return;
    }

    $email = $_POST['email'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $serviceType = intval($_POST['type-of-order']);
    if ($account != 3) {
        if($serviceType===0){
            leaveAnAccountReviewDelivery($serviceType);
        }
        else if ($serviceType===1){
            leaveAnAccountReviewHouse($serviceType);
        }
    } else {
        if (findGuest($email)) {
            if ($serviceType === 0) {
                leaveAGuestReviewDelivery($email, $serviceType);
            } else if ($serviceType === 1) {
                leaveAGuestReviewHouse($email, $serviceType);
            }
        } else {
            newGuest($fname, $lname, $email);
            if ($serviceType === 0) {
                leaveAGuestReviewDelivery($email, $serviceType);
            } else if ($serviceType === 1) {
                leaveAGuestReviewHouse($email, $serviceType);
            }
        }
    }
}