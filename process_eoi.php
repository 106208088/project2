<?php
session_start();
$pageTitle = "SWC IT - Application Processing";
include_once 'header.inc';
require_once 'settings.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Location: apply.php');
    exit();
}

function sanitise_input($data) {
 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$jobref = sanitise_input($_POST['jobref']);
$fname = sanitise_input($_POST['firstname']);
$lname = sanitise_input($_POST['lastname']);
$dob = sanitise_input($_POST['dob']);
$gender = isset($_POST['gender']) ? sanitise_input($_POST['gender']) : '';
$street = sanitise_input($_POST['street']);
$suburb = sanitise_input($_POST['suburb']);
$state = sanitise_input($_POST['state']);
$postcode = sanitise_input($_POST['postcode']);
$email = sanitise_input($_POST['email']);
$phone = sanitise_input($_POST['phone']);
$others = sanitise_input($_POST['others']);

$skills_array = isset($_POST['skills']) && is_array($_POST['skills']) ? $_POST['skills'] : [];
$skills = sanitise_input(implode(", ", $skills_array));

$error_msg = "";

if (empty($jobref) || empty($fname) || empty($lname) || empty($dob) || empty($gender) ||
    empty($street) || empty($suburb) || empty($state) || empty($postcode) || empty($email) || empty($phone)) {
    $error_msg .= "<li>All required fields must be filled.</li>";
}

if (!preg_match("/^[A-Za-z\-' ]{1,20}$/", $fname) || !preg_match("/^[A-Za-z\-' ]{1,20}$/", $lname)) {
    $error_msg .= "<li>First and Last names must be max 20 characters and contain only letters, hyphens, or apostrophes.</li>";
}

if (!empty($dob)) {
    $dob_time = strtotime($dob);
    $min_age_time = strtotime('-15 years');
    if ($dob_time > $min_age_time) {
        $error_msg .= "<li>You must be at least 15 years old to apply.</li>";
    }
}

if (strlen($street) > 40 || strlen($suburb) > 40) {
    $error_msg .= "<li>Street address and suburb/town must be a maximum of 40 characters.</li>";
}

$valid_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
if (!in_array($state, $valid_states)) {
    $error_msg .= "<li>Invalid state selected.</li>";
}
if (!preg_match("/^\d{4}$/", $postcode)) {
    $error_msg .= "<li>Postcode must contain exactly 4 digits.</li>";
}

$pc_state_map = [
    'VIC' => ['3', '8'], 'NSW' => ['1', '2'], 'QLD' => ['4', '9'],
    'NT' => ['0'], 'WA' => ['6'], 'SA' => ['5'], 'TAS' => ['7'], 'ACT' => ['0'],
];

if (!empty($postcode) && !empty($state)) {
    $pc_start = substr($postcode, 0, 1);
    if (isset($pc_state_map[$state]) && !in_array($pc_start, $pc_state_map[$state])) {
        $error_msg .= "<li>Postcode is inconsistent with the selected state ($state).</li>";
    }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_msg .= "<li>Email address format is invalid.</li>";
}

if (!preg_match("/^[\d\s]{8,12}$/", $phone)) {
    $error_msg .= "<li>Phone number must be between 8 and 12 digits or spaces.</li>";
}

if (!empty($skills_array) && empty($others)) {
    $error_msg .= "<li>You must provide details in the 'Other skills' field if you select any of the primary skills.</li>";
}


if ($error_msg) {
    echo "<h2>Application Failed Validation</h2>";
    echo "<p>Please <a href='apply.php'>return to the application page</a> and correct the following errors:</p>";
    echo "<ul>$error_msg</ul>";
} else {

    $conn = @new mysqli($host, $user, $pwd, $sql_db);

    if ($conn->connect_error) {
        echo "<h2>Application Failed</h2><p>Database connection failed. Please contact support. Error: " . $conn->connect_error . "</p>";
    } else {
        $table_check_sql = "SHOW TABLES LIKE 'eoi'";
        $table_exists = $conn->query($table_check_sql)->num_rows > 0;

        if (!$table_exists) {
            $create_table_sql = "
            CREATE TABLE eoi (
                EOInumber INT AUTO_INCREMENT PRIMARY KEY,
                Job_Reference_Number VARCHAR(5) NOT NULL,
                First_name VARCHAR(20) NOT NULL,
                Last_name VARCHAR(20) NOT NULL,
                DOB DATE NOT NULL,
                Gender VARCHAR(10) NOT NULL,
                Street_address VARCHAR(40) NOT NULL,
                Suburb VARCHAR(40) NOT NULL,
                State VARCHAR(3) NOT NULL,
                Postcode VARCHAR(4) NOT NULL,
                Email_address VARCHAR(50) NOT NULL,
                Phone_number VARCHAR(12) NOT NULL,
                Skills_list TEXT,
                Other_skills TEXT,
                Status VARCHAR(10) DEFAULT 'New'
            );";
            if (!$conn->query($create_table_sql)) {
                echo "<h2>Application Failed</h2><p>Error creating EOI table: " . $conn->error . "</p>";
                $conn->close();
                include_once 'footer.inc';
                exit();
            }
        }

        $stmt = $conn->prepare("INSERT INTO eoi (Job_Reference_Number, First_name, Last_name, DOB, Gender, Street_address, Suburb, State, Postcode, Email_address, Phone_number, Skills_list, Other_skills, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')");
        
        $stmt->bind_param("sssssssssssss", $jobref, $fname, $lname, $dob, $gender, $street, $suburb, $state, $postcode, $email, $phone, $skills, $others);

        if ($stmt->execute()) {
            $eoi_number = $conn->insert_id; 

            echo "<h2>Application Successful!</h2>";
            echo "<p>Thank you for your Expression of Interest. Your application has been successfully submitted.</p>";
            echo "<h3>Your unique EOI Number is: <strong>$eoi_number</strong></h3>";
            echo "<p>Please keep this number for future reference.</p>";
            echo "<h4>Summary of Submitted Data (for review):</h4><ul><li>Job Ref: $jobref</li><li>Name: $fname $lname</li><li>Email: $email</li></ul>";

        } else {
    
            echo "<h2>Database Error</h2>";
            echo "<p>An unexpected error occurred while saving your application. Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}

include_once 'footer.inc';
?>
