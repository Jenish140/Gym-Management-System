<?php error_reporting(0) ?>
<?php
// admin/reports.php

// This part must be at the very top, before any HTML
include '../config.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=member_report.csv');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Member ID', 'Name', 'Email', 'Phone', 'Join Date'));
    
    $result = $conn->query("SELECT member_id, name, email, phone, join_date FROM members ORDER BY member_id ASC");
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Include header *after* the export logic
include 'header.php';
?>

<h1>Export Reports</h1>

<div class="glass-card">
    <h2>Member Data</h2>
    <p>Click the button below to download a CSV report of all members.</p>
    <br>
    <a href="reports.php?export=true" class="neumorphic-btn">Export Member Report (CSV)</a>
</div>

<?php include 'footer.php'; ?>