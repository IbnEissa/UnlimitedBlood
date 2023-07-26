<?php
// Get the user data from the request body
$fName = $_POST['fName'];
$mName = $_POST['mName'];
$lName = $_POST['lName'];
$gender = $_POST['gender'];
$bloodGroup = $_POST['bloodGroup'];
$email = $_POST['email'];
$birthDate = $_POST['birthDate'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$serverpassword = '';
$dbname = "unlimitedblood";

$conn = new mysqli($servername, $username, $serverpassword, $dbname);

// Check for errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query using a prepared statement
$stmt = $conn->prepare("INSERT INTO usersDetails (fName, mName, lName, gender, bloodGroup, email, birthDate, phoneNumber, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind the parameters
$stmt->bind_param("sssssssss", $fName, $mName, $lName, $gender, $bloodGroup, $email, $birthDate, $phoneNumber, $hashedPassword);

// Execute the query
$stmt->execute();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign UP</title>
</head>
<body>
  <form method="post">
    <label for="id">ID:</label>
    <input type="text" name="id" id="id"><br>

    <label for="fName">First Name:</label>
    <input type="text" name="fName" id="fName"><br>

    <label for="mName">Middle Name:</label>
    <input type="text" name="mName" id="mName"><br>

    <label for="lName">Last Name:</label>
    <input type="text" name="lName" id="lName"><br>

    <label for="gender">Gender:</label>
    <select name="gender" id="gender">
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select><br>

    <label for="bloodGroup">Blood Group:</label>
    <input type="text" name="bloodGroup" id="bloodGroup"><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>

    <label for="birthDate">Birth Date:</label>
    <input type="date" name="birthDate" id="birthDate"><br>

    <label for="phoneNumber">Phone Number:</label>
    <input type="tel" name="phoneNumber" id="phoneNumber"><br>

    <label for="password">Password:</label>
    <input type="text" name="password" id="password"><br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>