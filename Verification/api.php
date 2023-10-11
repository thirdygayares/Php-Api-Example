<?php

// Include the User class
require_once __DIR__ . '/verification.php';

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


        // Stopping further execution
        die();
    }
}

// Array to store the response
$response = array();

// If it is an API call
if (isset($_GET['apicall'])) {

    switch ($_GET['apicall']) {

        case 'verification':
            // Check if required parameters are available or not
            areParametersAvailable(array('id'));

            // Creating a new Verification  object
            $verificationDb = new Verification();

            // Finding id in the database
            $result = $verificationDb->getStudentsInfo(
                $_POST['id'], 
            );

            // If the record is created, add success to response
            if ($result) {
                $response['error'] = false;
                $response['message'] = 'Verified successfully';
                $response['result'] = $result;

              $verificationDb->createSavedScan(
                    $_POST['id'], 
                );
                
                
            } else {
                // If the record is not added, there is an error
                $response['error'] = true;
                $response['message'] = 'Not Found';
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
