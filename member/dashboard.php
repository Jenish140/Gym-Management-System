<?php
// member/dashboard.php
include 'header.php';
$member_id = $_SESSION['member_id'];

// Fetch member details ("View details")
$member_result = $conn->query("SELECT * FROM members WHERE member_id = $member_id");
$member = $member_result->fetch_assoc();

// Fetch subscription details
$sub_result = $conn->query("
    SELECT p.name, s.end_date 
    FROM subscriptions s
    JOIN packages p ON s.package_id = p.package_id
    WHERE s.member_id = $member_id 
    ORDER BY s.end_date DESC 
    LIMIT 1
");
$subscription = $sub_result->fetch_assoc();
?>

<h1>Dashboard</h1>
<p>Welcome, <?php echo htmlspecialchars($member['name']); ?>!</p>

<div class="glass-card" style="margin-top: 2rem;">
    <h2>Your Details</h2>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($member['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($member['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($member['phone']); ?></p>
        <p><strong>Joined On:</strong> <?php echo $member['join_date']; ?></p>
    </div>
</div>

<div class="glass-card" style="margin-top: 2rem;">
    <h2>Your Current Package</h2>
    <?php if ($subscription): ?>
        <p style="font-size: 1.2rem;"><strong>Package:</strong> <?php echo htmlspecialchars($subscription['name']); ?></p>
        <p style="font-size: 1.1rem;"><strong>Expires on:</strong> <?php echo $subscription['end_date']; ?></p>
    <?php else: ?>
        <p>You do not have an active package.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>