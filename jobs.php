<?php
$pageTitle = "SWC IT - Position Descriptions";
include_once 'header.inc';
include_once 'settings.php';
$conn = @new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    echo "<h2>Error</h2><p>Could not load job descriptions. Database connection failed.</p>";
} else {
    $sql = "SELECT * FROM jobs";
    $result = $conn->query($sql);
}
    ?>

  <h2>Available Jobs</h2>
    <div class="jobs-container">
   <?php
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='job'>
            <h3>{$row['title']} ({$row['reference']})</h3>
            <p>{$row['description']}</p>
            <p><strong>Salary:</strong> {$row['salary_range']}</p>
            <p><strong>Report</strong> {$row['reporting_to']}</p>
            <p><strong>Respnsibilites</strong> {$row['responsibilities']}</p>
            <p><strong>Essential Skills</strong> {$row['essential_skills']}</p>
            <p><strong>Preferable Skills</strong> {$row['preferable_skills']}</p>
            <p><strong>Closing Date:</strong> {$row['closing_date']}</p>
            <a href='apply.php?job_ref={$row['reference']}'>Apply Now</a>
          </div>";
  }


    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        }
    } else {
        echo '<p>No current job positions available.</p>';
    }
    $conn->close();
}
include_once 'footer.inc';
?>
