<?php
session_start();
include('db_connection.php');


$user_id = $_SESSION['user_id'];


$upcomingAppointmentsQuery = "SELECT * FROM appointments WHERE patient_id = $user_id AND appointment_date > NOW() ORDER BY appointment_date ASC";
$upcomingAppointmentsResult = $conn->query($upcomingAppointmentsQuery);


$pastAppointmentsQuery = "SELECT * FROM appointments WHERE patient_id = $user_id AND appointment_date <= NOW() ORDER BY appointment_date DESC";
$pastAppointmentsResult = $conn->query($pastAppointmentsQuery);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paitent Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            padding-top: 15px;
            color: #fff;
        }

        .sidebar-item {
            padding: 10px 20px;
            border-bottom: 1px solid #495057;
        }

        .sidebar-item a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar-item a:hover {
            color: #fff;
            text-decoration: none;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .main-content h2 {
            margin-bottom: 20px;
        }

        .welcome-message {
            margin-bottom: 20px;
        }

        .logout-btn {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-item">
            <?php

            if (isset($_SESSION['user_type']) && isset($_SESSION['full_name'])) {
                echo "<a href='#'><i class='fas fa-user mr-2'></i>Welcome " . ucfirst($_SESSION['full_name']) . "</a>";
            }
            ?>
        </div>
        <div class="sidebar-item">
            <a href="pwelcome.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
        </div>
        <div class="sidebar-item">
            <a href="appoinment.php"><i class="fas fa-calendar-alt mr-2"></i>Appointment</a>
        </div>
        <div class="sidebar-item">
            <a href="#"><i class="fas fa-chart-bar mr-2"></i>Report</a>
        </div>
        <div class="sidebar-item logout-btn">
            <?php
            if (isset($_SESSION['user_type']) && isset($_SESSION['full_name'])) {
                echo "<a href='login.php'><i class='fas fa-sign-out-alt mr-2'></i>Logout</a>";
            }
            ?>
        </div>
    </div>

    <div class="main-content">
        <main>
            <section id="schedule-appointment">
                <h2>Schedule a New Appointment</h2>
                <form action="appointment_handler.php" method="post">
                    <input type="hidden" name="action" value="schedule">
                    <div class="form-group">
                        <label for="appointment_date">Appointment Date and Time:</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="appointment_type">Appointment Type:</label>
                        <input type="text" name="appointment_type" id="appointment_type" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                </form>
            </section>


            <section id="upcoming-appointments">
                <h2>Upcoming Appointments</h2>
                <?php if ($upcomingAppointmentsResult->num_rows > 0) : ?>
                    <ul>
                        <?php while ($appointment = $upcomingAppointmentsResult->fetch_assoc()) : ?>
                            <li>
                                <span><?= $appointment['appointment_date'] ?></span>
                                <span><?= $appointment['appointment_type'] ?></span>
                                
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>No upcoming appointments.</p>
                <?php endif; ?>
            </section>

            <section id="past-appointments">
                <h2>Past Appointments</h2>
                <?php if ($pastAppointmentsResult->num_rows > 0) : ?>
                    <ul>
                        <?php while ($appointment = $pastAppointmentsResult->fetch_assoc()) : ?>
                            <li>
                                <span><?= htmlspecialchars($appointment['appointment_date'], ENT_QUOTES, 'UTF-8') ?></span>
                                <span><?= htmlspecialchars($appointment['appointment_type'], ENT_QUOTES, 'UTF-8') ?></span>
                                
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>No past appointments.</p>
                <?php endif; ?>
            </section>

        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>