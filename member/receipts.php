<?php
// member/receipts.php
include 'header.php';
$member_id = $_SESSION['member_id'];

$payments = $conn->query("
    SELECT payment_id, amount, payment_date, notes 
    FROM payments 
    WHERE member_id = $member_id 
    ORDER BY payment_date DESC
");
?>

<h1>Your Bill Receipts</h1>

<div class="glass-table">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Receipt ID</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($payments->num_rows > 0): ?>
                <?php while ($row = $payments->fetch_assoc()): ?>
                <tr>
                    <td>RCPT-<?php echo $row['payment_id']; ?></td>
                    <td><?php echo $row['payment_date']; ?></td>
                    <td>&#8377;<?php echo number_format($row['amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['notes']); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">You have no payment receipts.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>