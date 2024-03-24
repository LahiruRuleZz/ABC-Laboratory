<?php
// fetchUserDetails.php

require_once 'UserManager.php';
require_once 'dbConnection.php'; 

session_start();


$userId = $_SESSION['user_id'] ?? 0; 

$userManager = new UserManager($db);
$userDetails = $userManager->getUserDetails($userId);

if ($userDetails) {
    echo "<p>Username: " . htmlspecialchars($userDetails['username']) . "</p>";
    echo "<p>Full Name: " . htmlspecialchars($userDetails['full_name']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($userDetails['email']) . "</p>";
    echo "<p>Phone Number: " . htmlspecialchars($userDetails['phone_number']) . "</p>";
    echo "<p>Date of Birth: " . htmlspecialchars($userDetails['date_of_birth']) . "</p>";
} else {
    echo "<p>User details not found.</p>";
}
?>
