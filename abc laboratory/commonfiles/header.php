<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            margin-top: auto; /* Push logout button to the bottom of the sidebar */
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-item">
        <?php
        session_start();
        if (isset($_SESSION['user_type']) && isset($_SESSION['full_name'])) {
            echo "<a href='#'><i class='fas fa-user mr-2'></i>Welcome " . ucfirst($_SESSION['full_name']) . "</a>";
        }
        ?>
    </div>
    <div class="sidebar-item">
        <a href="#"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
    </div>
    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') : ?>
        <div class="sidebar-item">
            <a href="usermanage.php"><i class="fas fa-user mr-2"></i>User Accounts</a>
        </div>
    <?php endif; ?>
    <div class="sidebar-item">
        <a href="#"><i class="fas fa-calendar-alt mr-2"></i>Appointment</a>
    </div>
    <div class="sidebar-item">
        <a href="#"><i class="fas fa-chart-bar mr-2"></i>Report</a>
    </div>
    <div class="sidebar-item logout-btn">
        <?php
        if (isset($_SESSION['user_type']) && isset($_SESSION['full_name'])) {
            echo "<a href='login.php'><i class='fas fa-sign-out-alt mr-2'></i>Logout</a>"; // Changed to 'logout.php' for the logout link
        }
        ?>
    </div>
</div>

