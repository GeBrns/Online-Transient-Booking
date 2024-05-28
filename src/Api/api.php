<?php
// Start output buffering and session
ob_start();
session_start();

// Include the database connection file
include "db.php";

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Handle Cross-Origin Resource Sharing (CORS) headers
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: http://localhost:5173');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, XCSRF-Token, Authorization");
    }
    exit(0);
}

// Initialize response array
$response = array('error' => false);

// Check if the 'action' parameter is set in the GET request
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    $validActions = array('Login', 'addusers', 'getuserinfo', 'deleteUser', 'updateUser');
    if (!in_array($action, $validActions)) {
        $response['error'] = true;
        $response['message'] = "Invalid action";
        echo json_encode($response);
        exit();
    }

    // Read the raw input data if available
    $rawInput = file_get_contents('php://input');
    $inputData = json_decode($rawInput, true);

    // Debugging: Log raw input and decoded data
    error_log("Raw input: " . $rawInput);
    error_log("Decoded input data: " . print_r($inputData, true));

    // Execute corresponding function based on action parameter
    switch ($action) {
        case 'Login':
            login($conn, $response);
            break;
        case 'addusers':
            addUsers($conn, $response);
            break;
        case 'getuserinfo':
            getUserInfo($conn, $response);
            break;
        case 'deleteUser':
            deleteUser($conn, $response);
            break;
        case 'updateUser':
            updateUser($conn, $response, $inputData);
            break;
    }
}

// Function to handle user login
function login($conn, &$response) {
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM `userslogin` WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $authToken = bin2hex(random_bytes(32));
                $_SESSION['authToken'] = $authToken;
                $_SESSION['email'] = $email;

                $response['error'] = false;
                $response['message'] = "Login Success";
                $response['authToken'] = $authToken;
            } else {
                $response['error'] = true;
                $response['message'] = "Incorrect password";
            }
        } else {
            $response['error'] = true;
            $response['message'] = "User not found";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Please provide both email and password";
    }
    echo json_encode($response);
    exit();
}


// Function to add a new user
function addUsers($conn, &$response) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO `userslogin`(`id`, `name`, `email`, `contact`, `password`) VALUES (NULL, '$name', '$email', '$contact', '$password')";
    if ($conn->query($sql)) {
        $response['error'] = false;
        $response['message'] = "Users Added Successfully";
        
        // Call fetchUsers to update the user list
        getUserInfo($conn, $response);
    } else {
        $response['error'] = true;
        $response['message'] = "Something went wrong";
    }
    echo json_encode($response);
    exit();
}

// Function to get user information
function getUserInfo($conn, &$response) {
    $sql = "SELECT * FROM `userslogin`";
    $res = $conn->query($sql);
    $userData = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            array_push($userData, $row);
        }
        $response['error'] = false;
        $response['user_Data'] = $userData;
    } else {
        $response['error'] = false;
        $response['message'] = "No Data Found";
    }
    echo json_encode($response);
    exit();
}

// Function to delete a user
function deleteUser($conn, &$response) {
    if (!isset($_POST['id']) && !isset($_GET['id'])) {
        $response['error'] = true;
        $response['message'] = "User ID is required.";
    } else {
        $userId = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
        $sql = "DELETE FROM `userslogin` WHERE id='$userId'";
        if ($conn->query($sql)) {
            $response['error'] = false;
            $response['message'] = "User deleted successfully.";
        } else {
            $response['error'] = true;
            $response['message'] = "Error deleting user: " . $conn->error;
        }
    }
    echo json_encode($response);
    exit();
}

// Function to update user information
function updateUser($conn, &$response, $userData) {
    if (!isset($userData['id']) || empty($userData['id'])) {
        $response['error'] = true;
        $response['message'] = "User ID is required.";
        echo json_encode($response);
        exit();
    }

    // Extract user data from input
    $id = $userData['id'];
    $name = isset($userData['name']) ? $userData['name'] : '';
    $email = isset($userData['email']) ? $userData['email'] : '';
    $contact = isset($userData['contact']) ? $userData['contact'] : '';
    $password = isset($userData['password']) ? password_hash($userData['password'], PASSWORD_DEFAULT) : '';

    // Build update query
    $sql = "UPDATE `userslogin` SET ";
    $updates = array();
    if (!empty($name)) {
        $updates[] = "name='$name'";
    }
    if (!empty($email)) {
        $updates[] = "email='$email'";
    }
    if (!empty($contact)) {
        $updates[] = "contact='$contact'";
    }
    if (!empty($password)) {
        $updates[] = "password='$password'";
    }
    $sql .= implode(', ', $updates) . " WHERE id='$id'";

    // Execute update query
    if ($conn->query($sql)) {
        $response['error'] = false;
        $response['message'] = "User updated successfully.";
        // Call fetchUsers to update the user list
        getUserInfo($conn, $response);
    } else {
        $response['error'] = true;
        $response['message'] = "Error updating user: " . $conn->error;
    }
    echo json_encode($response);
    exit();
}