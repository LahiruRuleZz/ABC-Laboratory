<?php
include_once "db_connection.php";

$response = array(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $userType = mysqli_real_escape_string($conn, $_POST["user_type"]);
    $fullName = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phone_number"]);
    $dateOfBirth = mysqli_real_escape_string($conn, $_POST["date_of_birth"]);

    // Check if the email or phone number already exists
    $checkUser = "SELECT * FROM users WHERE email = '$email' OR phone_number = '$phoneNumber'";
    $checkResult = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($checkResult) > 0) {
        // User exists
        $response["success"] = false;
        $response["message"] = "Email address or phone number already exists.";
    } else {
        // No user found, proceed with the insert
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, user_type, full_name, email, phone_number, date_of_birth) 
                VALUES ('$username', '$hashed_password', '$userType', '$fullName', '$email', '$phoneNumber', '$dateOfBirth')";

        if (mysqli_query($conn, $sql)) {
            // Insert successful
            $response["success"] = true;
            $response["message"] = "User added successfully!";
        } else {
            // Insert failed
            $response["success"] = false;
            $response["message"] = "Failed to add user. Please try again.";
        }
    }

    mysqli_close($conn);
    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // Not a POST request
    header("Location: usermanage.php");
    exit();
}
