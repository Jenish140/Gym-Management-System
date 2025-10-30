<?php
// member/notifications.php
include 'header.php';
$member_id = $_SESSION['member_id'];

// Fetch notifications for this member OR for all members (member_id IS NULL)
$notifications = $conn->query("
    SELECT message, created_at 
    FROM notifications 
    WHERE member_id = $member_id OR member_id IS NULL 
    ORDER BY created_at DESC
");

// Mark notifications as 'read' (In a real app, you'd do this more selectively)
$conn->query("UPDATE notifications SET status = 'read' WHERE member_id = $member_id");
?>

<h1>Notifications</h1>

<div class="glass-panel">
    <?php if ($notifications->num_rows > 0): ?>
        <?php while ($row = $notifications->fetch_assoc()): ?>
            <div class="glass-card" style="margin-bottom: 1rem;">
                <p><?php echo htmlspecialchars($row['message']); ?></p>
                <small style="opacity: 0.7;"><?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You have no notifications.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>