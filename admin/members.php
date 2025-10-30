<?php
// admin/members.php
include 'header.php';

$message = '';

// Handle Add Member
if (isset($_POST['add_member'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $join_date = $_POST['join_date'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO members (name, email, phone, join_date, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $join_date, $password);
    if ($stmt->execute()) {
        $message = "<div class='message success'>Member added successfully!</div>";
    } else {
        $message = "<div class='message error'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Handle Delete Member
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM members WHERE member_id = $id");
    $message = "<div class='message success'>Member deleted successfully!</div>";
}

// Handle Search
$search = $_GET['search'] ?? '';
$search_query = "SELECT * FROM members WHERE name LIKE ? OR email LIKE ?";
$stmt = $conn->prepare($search_query);
$search_param = "%" . $search . "%";
$stmt->bind_param("ss", $search_param, $search_param);
$stmt->execute();
$members = $stmt->get_result();
?>

<h1>Manage Members</h1>
<?php echo $message; ?>

<div class="glass-card">
    <h2>Add New Member</h2>
    <form action="members.php" method="POST">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone">
            </div>
            <div class="form-group">
                <label>Join Date</label>
                <input type="date" name="join_date" required>
            </div>
            <div class="form-group">
                <label>Password (for member login)</label>
                <input type="password" name="password" required>
            </div>
        </div>
        <button type="submit" name="add_member" class="neumorphic-btn">Add Member</button>
    </form>
</div>

<div class="glass-table" style="margin-top: 2rem;">
    <h2>Search & View Members</h2>
    <form action="members.php" method="GET" style="margin-bottom: 1rem;">
        <div class="form-group" style="max-width: 400px;">
            <input type="text" name="search" placeholder="Search by name or email..." value="<?php echo htmlspecialchars($search); ?>">
        </div>
    </form>
    
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $members->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['member_id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo $row['join_date']; ?></td>
                <td class="actions">
                    <a href="members.php?delete=<?php echo $row['member_id']; ?>" onclick="return confirm('Are you sure?')" class="delete">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php 
$stmt->close();
include 'footer.php'; 
?>