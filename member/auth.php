<?php
// member/auth.php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT member_id, name, email, password FROM members WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct
            $_SESSION['member_id'] = $row['member_id'];
            $_SESSION['member_name'] = $row['name'];
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: index.php");
        exit;
    }
    $stmt->close();
}
$conn->close();
?>