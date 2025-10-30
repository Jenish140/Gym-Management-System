<?php 
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <form action="auth.php" method="POST" class="glass-form">
            <h2>Member Login</h2>
            <?php if (!empty($_SESSION['error'])): ?>
                <p class="message error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="neumorphic-btn" style="width: 100%;">Login</button>
            <p style="text-align: center; margin-top: 1rem;"><a href="../index.php" style="color: var(--primary-color);">Back to Home</a></p>
        </form>
    </div>
</body>
</html>