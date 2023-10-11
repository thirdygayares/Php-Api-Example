<?php

// Include the User class
require_once __DIR__ . '/admin.php';

// Function to validate if all parameters are available
function areParametersAvailable($params)
{
    $available = true;
    $missingParams = "";

    foreach ($params as $param) {
        if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {
            $available = false;
            $missingParams = $missingParams . ", " . $param;
        }
    }

    // If parameters are missing
    if (!$available) {
        $response = array();
        $response['error'] = true;
        $response['message'] = 'Parameters ' . substr($missingParams, 1, strlen($missingParams)) . ' missing';

        // Displaying error
        echo json_encode($response);

        var_dump($_SERVER['HTTP_SECRET_KEY']);

        // Stopping further execution
        die();
    }
}

// Array to store the response
$response = array();

// If it is an API call
if (isset($_GET['apicall'])) {

    switch ($_GET['apicall']) {

        case 'createAdmin':
            // Check if required parameters are available or not
            areParametersAvailable(array('email', 'password'));

            // Creating a new User object
            $adminDb = new Admin();

            // Creating a new record in the database
            $result = $adminDb->createAdmin(
                $_POST['email'],
                $_POST['password'],
               
            );

            // If the record is created, add success to response
            if ($result) {
                $response['error'] = false;
                $response['message'] = 'admin created successfully';
            } else {
                // If the record is not added, there is an error
                $response['error'] = true;
                $response['message'] = 'Failed to create user. Please try again';
            }

            break;

         // The LOGIN operation
        case 'login':
            // First, check the parameters required for this request are available or not
            areParametersAvailable(array('email', 'password'));

            // Creating a new User object
            $adminDb = new Admin();

            // Attempting to log in
            $result = $adminDb->login(
                $_POST['email'],
                $_POST['password']
            );

            // If login is successful, adding user information to response
            if ($result !== null) {
                $response['error'] = false;
                $response['message'] = 'Login successful';
                $response['admin'] = $result;
            } else {
                // If login fails, there is an error
                $response['error'] = true;
                $response['message'] = 'Invalid username or password';
            }

            break;

        default:
            // If it is not a recognized API call
            $response['error'] = true;
            $response['message'] = 'Invalid API Call';
            break;
    }

} else {
    // If it is not an API call
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

// Displaying the response in JSON structure
echo json_encode($response);
