<?php
// admin/dashboard.php
include 'header.php';

// Fetch stats
$members_result = $conn->query("SELECT COUNT(*) as total FROM members");
$total_members = $members_result->fetch_assoc()['total'];

$payments_result = $conn->query("SELECT SUM(amount) as total FROM payments WHERE MONTH(payment_date) = MONTH(CURRENT_DATE())");
$monthly_earning = $payments_result->fetch_assoc()['total'];
?>

<h1>Dashboard</h1>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>

<div style="display: flex; gap: 1.5rem; margin-top: 2rem;">
    <div class="glass-card" style="flex: 1;">
        <h3>Total Members</h3>
        <p style="font-size: 2rem; color: var(--primary-color); font-weight: 600;"><?php echo $total_members; ?></p>
    </div>
    <div class="glass-card" style="flex: 1;">
        <h3>Monthly Earnings</h3>
<p style="font-size: 2rem; color: var(--primary-color); font-weight: 600;">&#8377;<?php echo number_format($monthly_earning ?? 0, 2); ?></p></div>
</div>

<div class="glass-card" style="margin-top: 2rem;">
    <h3>Quick Actions</h3>
    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
        <a href="members.php" class="neumorphic-btn">Manage Members</a>
        <a href="billing.php" class="neumorphic-btn">Manage Billing</a>
    </div>
</div>

<?php include 'footer.php'; ?>