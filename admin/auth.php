<?php
// admin/auth.php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT admin_id, username, password_hash FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            // Password is correct
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: index.php");
        exit;
    }
    $stmt->close();
}
$conn->close();
?>