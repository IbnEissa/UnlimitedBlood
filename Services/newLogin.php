<?php
// Get the phone number and password from the request body
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$serverpassword = "";
$dbname = "unlimitedblood";

$conn = new mysqli($servername, $username, $serverpassword, $dbname);

// Check for errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query using a prepared statement
$stmt = $conn->prepare("SELECT * FROM usersData WHERE phoneNumber = ?");

// Bind the phone number parameter
$stmt->bind_param("s", $phoneNumber);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check for errors
if ($conn->error) {
  die("Query failed: " . $conn->error);
}

// Check if a matching user was found
if ($result->num_rows > 0) {
  // Get the user data
  $row = $result->fetch_assoc();

  // Verify the password hash
  if (password_verify($password, $row['password'])) {
    // Password is correct, return success response
    $response = array('status' => 'success', 'message' => 'Login successful');
    echo json_encode($response);
  } else {
    // Password is incorrect, return error response
    $response = array('status' => 'error', 'message' => 'Invalid phone number or password');
    echo json_encode($response);
  }
} else {
  // User not found, return error response
  $response = array('status' => 'error', 'message' => 'Invalid phone number or password');
  echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>

  <h1>Login</h1>

  <form method="POST" >
    <label for="phoneNumber">Phone Number:</label>
    <input type="text" id="phoneNumber" name="phoneNumber" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
  </form>

</body>
</html>