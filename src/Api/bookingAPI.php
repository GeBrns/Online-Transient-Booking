<?php
// Include database connection file
include "db.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Handle CORS headers
if (isset($_SERVER['HTTP_ORIGIN'])){
    // Set allowed origin
    header('Access-Control-Allow-Origin: http://localhost:5173');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
        // Set allowed HTTP methods
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])){
        // Set allowed HTTP headers
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, XCSRF-Token, Authorization");
    }
    exit(0);
}

// Initialize response variables
$res = array('error' => false);

// Handle GET request to fetch events
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Prepare the SQL statement to fetch events
    $sql = "SELECT * FROM bookings";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $events = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = array(
                'event_id' => $row['id'],
                'title' => $row['name'],
                'start' => $row['startDate'] . 'T' . $row['startTime'],
                'end' => $row['endDate'] . 'T' . $row['endTime'],
                'color' => '#378006',
                'note' => $row['note'],
                'room' => $row['room']
            );
        }
        $res['data'] = $events;
    } else {
        $res['error'] = true;
        $res['message'] = "Error fetching events: " . mysqli_error($conn);
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($res);
    exit();
}

// Handle POST request to add an event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve event data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate the data (you can add more validation as needed)

    // Prepare SQL statement to insert the event into the database
    $sql = "INSERT INTO bookings (name, startDate, endDate, startTime, endTime, room, note) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Bind parameters and execute the statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $data['title'], $data['start'], $data['end'], $data['startTime'], $data['endTime'], $data['room'], $data['note']);
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($result) {
        $res['status'] = true;
        $res['id'] = mysqli_insert_id($conn); // Get the ID of the inserted event
    } else {
        $res['error'] = true;
        $res['message'] = "Error adding event: " . mysqli_error($conn);
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($res);
    exit();
}

// Return default response if no action is specified
echo json_encode($res);
?>
