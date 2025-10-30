<?php 
// index.php
include 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Management System - Welcome</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Specific styles for the landing page */
        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            height: 80vh;
            padding: 2rem;
        }
        .hero h1 {
            font-size: 4rem;
            color: white;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            margin-bottom: 1rem;
        }
        .hero h1 span {
            color: var(--primary-color);
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
        }
        .hero-buttons {
            display: flex;
            gap: 1.5rem;
        }
        footer {
            text-align: center;
            padding: 1.5rem;
            background: var(--glass-color);
            border-top: var(--glass-border);
            margin-top: auto;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <main class="hero">
        <h1>Welcome to <span>GYM System</span></h1>
        <p>Your one-stop solution for managing gym memberships, payments, and schedules. Login to access your portal.</p>
        <div class="hero-buttons">
            <a href="admin/index.php" class="neumorphic-btn">Admin Login</a>
            <a href="member/index.php" class="neumorphic-btn">Member Login</a>
        </div>
    </main>

    <footer>
        &copy; <?php echo date('Y'); ?> GYM Management System. All rights reserved.
    </footer>

    <script src="js/script.js"></script>
</body>
</html>