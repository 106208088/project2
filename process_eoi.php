<?php
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
  die("Database connection failed");
}

// Sanitize & validate
$job_ref = trim($_POST['job_ref']);
$first = trim($_POST['first_name']);
$last = trim($_POST['last_name']);
$email = trim($_POST['email']);

if ($job_ref == "" || $first == "" || $last == "") {
  die("Error: Required fields missing");
}

$query = "INSERT INTO eoi (job_ref, first_name, last_name, street, suburb, state, postcode, email, phone, skill1, skill2, skill3, other_skills)
VALUES (
  '$job_ref',
  '$first',
  '$last',
  '".mysqli_real_escape_string($conn, $_POST['street'])."',
  '".mysqli_real_escape_string($conn, $_POST['suburb'])."',
  '{$_POST['state']}',
  '{$_POST['postcode']}',
  '$email',
  '{$_POST['phone']}',
  ".(isset($_POST['skill1']) ? 1 : 0).",
  ".(isset($_POST['skill2']) ? 1 : 0).",
  ".(isset($_POST['skill3']) ? 1 : 0).",
  '".mysqli_real_escape_string($conn, $_POST['other_skills'])."'
)";

if (mysqli_query($conn, $query)) {
  $id = mysqli_insert_id($conn);
  echo "<p>Thank you, your application has been received!<br>Your EOI number is: <strong>$id</strong></p>";
} else {
  echo "<p>Database error: ".mysqli_error($conn)."</p>";
}

mysqli_close($conn);
?>
