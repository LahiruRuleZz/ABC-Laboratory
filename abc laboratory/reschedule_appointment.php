<?php
include('db_connection.php');

if (isset($_POST['appointment_id']) && isset($_POST['new_appointment_date'])) {
    $appointmentId = $_POST['appointment_id'];
    $newDate = $_POST['new_appointment_date'];

    $query = "UPDATE appointments SET appointment_date = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $newDate, $appointmentId);

    if ($stmt->execute()) {
        echo "Appointment rescheduled successfully.";
    } else {
        echo "Error rescheduling appointment.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Missing information.";
}
?>
