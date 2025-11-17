<?php
session_start(); 

require_once 'settings.php'; 
include_once 'header.inc';

$pageTitle = "SWC IT - HR Manager Interface";
$feedback = "";

$EOI_STATUSES = ['New', 'Current', 'Final']; 

function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {

    header("Location:login.php");
    exit();
}

$conn = @new mysqli($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
    $feedback = "FATAL ERROR: Database connection failed. Cannot manage records. " . $conn->connect_error;
    echo "<h2 style='color:red;'>Database Connection Error</h2>";
    echo "<p style='color:red;'>" . $feedback . "</p>";
    include_once 'footer.inc';
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['action']) && $_POST['action'] == 'delete_ref') {
        $ref_to_delete = sanitise_input($_POST['delete_job_ref']);
        
        if (!empty($ref_to_delete)) {
            $stmt = $conn->prepare("DELETE FROM eoi WHERE Job_Reference_Number = ?");
            $stmt->bind_param("s", $ref_to_delete);
            
            if ($stmt->execute()) {
                $affected_rows = $stmt->affected_rows;
                $feedback = "<span style='color:green; font-weight:bold;'>SUCCESS: Deleted {$affected_rows} record(s) for Job Reference: {$ref_to_delete}.</span>";
            } else {
                $feedback = "<span style='color:red; font-weight:bold;'>ERROR: Failed to delete records: " . $stmt->error . "</span>";
            }
            $stmt->close();
        } else {
            $feedback = "<span style='color:red; font-weight:bold;'>ERROR: Job Reference for deletion cannot be empty.</span>";
        }
    } 
    
    else if (isset($_POST['action']) && $_POST['action'] == 'update_status') {
        $eoi_to_update = sanitise_input($_POST['eoi_number']);
        $new_status = sanitise_input($_POST['new_status']);
        
        if (!empty($eoi_to_update) && in_array($new_status, $EOI_STATUSES)) {
            $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
            $stmt->bind_param("ss", $new_status, $eoi_to_update);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $feedback = "<span style='color:green; font-weight:bold;'>SUCCESS: EOI {$eoi_to_update} status updated to '{$new_status}'.</span>";
                } else {
                    $feedback = "<span style='color:orange; font-weight:bold;'>WARNING: EOI {$eoi_to_update} not found or status already '{$new_status}'.</span>";
                }
            } else {
                $feedback = "<span style='color:red; font-weight:bold;'>ERROR: Failed to update status: " . $stmt->error . "</span>";
            }
            $stmt->close();
        } else {
            $feedback = "<span style='color:red; font-weight:bold;'>ERROR: Invalid EOI Number or Status provided.</span>";
        }
    }
}



$query = "SELECT * FROM eoi";
$params = [];
$types = "";
$where_clauses = [];


if (isset($_GET['job_ref_search']) && !empty($_GET['job_ref_search'])) {
    $ref = sanitise_input($_GET['job_ref_search']);
    $where_clauses[] = "Job_Reference_Number = ?";
    $params[] = $ref;
    $types .= "s";
} 

else if (isset($_GET['name_search']) && !empty($_GET['name_search'])) {
    $name = "%" . sanitise_input($_GET['name_search']) . "%";
    $where_clauses[] = "(First_name LIKE ? OR Last_name LIKE ?)";
    $params[] = $name;
    $params[] = $name;
    $types .= "ss";
}

if (!empty($where_clauses)) {
    $query .= " WHERE " . implode(" AND ", $where_clauses);
}

$query .= " ORDER BY EOInumber DESC";

$eoitable = null;
if ($stmt = $conn->prepare($query)) {
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $eoitable = $stmt->get_result();
    $stmt->close();
}
?>

<main class="container">

    <h2>HR Manager Portal</h2>

    <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['manager_user']); ?>.</p>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Log Out</button>
        </form>
    </div>

    <?php 

    if (!empty($feedback)) {
        echo "<p style='padding: 10px; border: 1px solid; border-radius: 5px; margin-bottom: 20px;'>" . $feedback . "</p>";
    }
    ?>

    <section class="manager-actions">
        <h3>1. Search Expressions of Interest</h3>
        
        <form action="manage.php" method="GET" class="search-form">
            <label for="job_ref_search">Search by Job Ref:</label>
            <input type="text" id="job_ref_search" name="job_ref_search" pattern="[A-Za-z0-9]{5}" placeholder="e.g., NA12B">
            <button type="submit">Search</button>
            <a href="manage.php" class="button" style="text-decoration: none; padding: 10px 15px; background-color: #f1f1f1; color: #333; border-radius: 4px;">View All</a>
        </form>
        
        <form action="manage.php" method="GET" class="search-form">
            <label for="name_search">Search by Name:</label>
            <input type="text" id="name_search" name="name_search" placeholder="First or Last Name">
            <button type="submit">Search</button>
        </form>
    </section>

    <section>
        <h3>Filtered EOI Results (<?php echo $eoitable ? $eoitable->num_rows : 0; ?> Records)</h3>
        
        <?php if ($eoitable && $eoitable->num_rows > 0): ?>
            <table class="eoi-table">
                <thead>
                    <tr>
                        <th>EOI No.</th>
                        <th>Ref. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $eoitable->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['EOInumber']); ?></td>
                        <td><?php echo htmlspecialchars($row['Job_Reference_Number']); ?></td>
                        <td><?php echo htmlspecialchars($row['First_name'] . ' ' . $row['Last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['Phone_number']); ?></td>
                        <td class="status-<?php echo htmlspecialchars($row['Status']); ?>"><?php echo htmlspecialchars($row['Status']); ?></td>
                        
                        <td>
                            <form action="manage.php<?php echo $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : ''; ?>" method="POST" style="display:inline-flex; gap: 5px;">
                                <input type="hidden" name="action" value="update_status">
                                <input type="hidden" name="eoi_number" value="<?php echo htmlspecialchars($row['EOInumber']); ?>">
                                <select name="new_status" required>
                                    <option value="">Update...</option>
                                    <?php foreach ($EOI_STATUSES as $status): ?>
                                        <?php if ($status != $row['status']): ?>
                                            <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Go</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="margin-top: 20px;">No EOIs found matching the criteria.</p>
        <?php endif; ?>
    </section>


    <section class="manager-actions">
        <h3>2. Delete All EOIs for a Job Reference (A.5.4)</h3>
        <p style="color: red; font-weight: bold;">⚠️ WARNING: This action is irreversible and deletes ALL records associated with the reference number.</p>
        <form action="manage.php" method="POST" class="delete-form">
            <label for="delete_job_ref">Job Reference to Delete:</label>
            <input type="text" id="delete_job_ref" name="delete_job_ref" pattern="[A-Za-z0-9]{5}" maxlength="5" required placeholder="e.g., NA12B">
            <button type="submit" name="action" value="delete_ref" style="background-color: #cc0000;">
                DELETE ALL RECORDS
            </button>
        </form>
    </section>

</main>

<?php

if (isset($conn)) {
    $conn->close();
}

include_once 'footer.inc';
?>