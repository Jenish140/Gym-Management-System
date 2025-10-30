<?php
// admin/header.php
include '../config.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="main-container">
        <aside class="sidebar">
            <h2>GYM <span>Admin</span></h2>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="billing.php">Billing & Packages</a></li>
                    <li><a href="notifications.php">Notifications</a></li>
                    <li><a href="reports.php">Reports</a></li>
                </ul>
            </nav>
            <a href="logout.php" class="neumorphic-btn logout">Logout</a>
        </aside>
        <main class="content-area">