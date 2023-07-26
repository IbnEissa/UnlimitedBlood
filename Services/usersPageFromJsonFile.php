<?php

// Read the contents of the JSON file
$jsonData = file_get_contents('C:\xampp\htdocs\UnlimitedBlood\usersData.json');

// Set the response headers to indicate that the response is JSON
header('Content-Type: application/json');

// Return the JSON data as the response
echo $jsonData;