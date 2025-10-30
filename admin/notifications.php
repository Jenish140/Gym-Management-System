<?php
// admin/notifications.php
include 'header.php';
$message = '';

if (isset($_POST['send_notification'])) {
    $member_id = $_POST['member_id']; // "all" or specific ID
    $notify_message = $_POST['message'];
    
    if ($member_id == "all") {
        $stmt = $conn->prepare("INSERT INTO notifications (member_id, message) VALUES (NULL, ?)");
        $stmt->bind_param("s", $notify_message);
    } else {
        $stmt = $conn->prepare("INSERT INTO notifications (member_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $member_id, $notify_message);
    }
    
    if ($stmt->execute()) {
        $message = "<div class='message success'>Notification sent!</div>";
    } else {
        $message = "<div class='message error'>Error: " . $stmt->error . "</div>";
    }
}

$members = $conn->query("SELECT member_id, name FROM members");
?>

<h1>Assign Notification</h1>
<?php echo $message; ?>

<div class="glass-card">
    <form action="notifications.php" method="POST">
        <div class="form-group">
            <label>Send To</label>
            <select name="member_id" required>
                <option value="all">All Members</option>
                <?php while ($row = $members->fetch_assoc()): ?>
                <option value="<?php echo $row['member_id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" rows="5" required></textarea>
        </div>
        <button type="submit" name="send_notification" class="neumorphic-btn">Send Notification</button>
    </form>
</div>

<?php include 'footer.php'; ?>