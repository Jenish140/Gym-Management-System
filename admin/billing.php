<?php
// admin/billing.php
include 'header.php';

$message = '';
// Handle Assign Package
if (isset($_POST['assign_package'])) {
    $member_id = $_POST['member_id'];
    $package_id = $_POST['package_id'];
    $start_date = $_POST['start_date'];
    
    // Get package duration
    $pkg_result = $conn->query("SELECT duration_months FROM packages WHERE package_id = $package_id");
    $duration = $pkg_result->fetch_assoc()['duration_months'];
    $end_date = date('Y-m-d', strtotime("+$duration months", strtotime($start_date)));

    $stmt = $conn->prepare("INSERT INTO subscriptions (member_id, package_id, start_date, end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $member_id, $package_id, $start_date, $end_date);
    if ($stmt->execute()) {
        $message = "<div class='message success'>Package assigned successfully!</div>";
    } else {
        $message = "<div class='message error'>Error: " . $stmt->error . "</div>";
    }
}

// Handle Create Bill (Log Payment)
if (isset($_POST['create_bill'])) {
    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO payments (member_id, amount, payment_date, notes) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $member_id, $amount, $payment_date, $notes);
    if ($stmt->execute()) {
        $message = "<div class='message success'>Payment logged successfully (Bill Receipt Created)!</div>";
    } else {
        $message = "<div class='message error'>Error: " . $stmt->error . "</div>";
    }
}

// Fetch members and packages for dropdowns
$members = $conn->query("SELECT member_id, name FROM members");
$packages = $conn->query("SELECT package_id, name, cost FROM packages");
?>

<h1>Billing & Packages</h1>
<?php echo $message; ?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <div class="glass-card">
        <h2>Assign Fee Package</h2>
        <form action="billing.php" method="POST">
            <div class="form-group">
                <label>Select Member</label>
                <select name="member_id" required>
                    <?php while ($row = $members->fetch_assoc()): ?>
                    <option value="<?php echo $row['member_id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Select Package</label>
                <select name="package_id" required>
                    <?php mysqli_data_seek($packages, 0); // Reset pointer ?>
                    <?php while ($row = $packages->fetch_assoc()): ?>
                    <option value="<?php echo $row['package_id']; ?>"><?php echo htmlspecialchars($row['name']); ?> (&#8377;<?php echo $row['cost']; ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" required>
            </div>
            <button type="submit" name="assign_package" class="neumorphic-btn">Assign Package</button>
        </form>
    </div>

    <div class="glass-card">
        <h2>Create Bill (Log Payment)</h2>
        <form action="billing.php" method="POST">
            <div class="form-group">
                <label>Select Member</label>
                <select name="member_id" required>
                    <?php mysqli_data_seek($members, 0); // Reset pointer ?>
                    <?php while ($row = $members->fetch_assoc()): ?>
                    <option value="<?php echo $row['member_id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" placeholder="e.g., 1500.50" required>
            </div>
            <div class="form-group">
                <label>Payment Date</label>
                <input type="date" name="payment_date" required>
            </div>
            <div class="form-group">
                <label>Notes (e.g., "Monthly Fee")</label>
                <input type="text" name="notes">
            </div>
            <button type="submit" name="create_bill" class="neumorphic-btn">Log Payment</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>