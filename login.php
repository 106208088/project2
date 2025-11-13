<?php
session_start();

if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    header("Location:manage.php");
    exit();
}

$pageTitle = "SWC IT - Manager Login";
include_once 'header.inc';
require_once 'settings.php'; 

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $input_password = isset($_POST['password']) ? $_POST['password'] : '';

    $conn = @new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        $login_error = "Database connection failed. Cannot verify credentials.";
    } else {
    
        $stmt = $conn->prepare("SELECT password_hash FROM managers WHERE username = ?");
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $stored_hash = $row['password_hash'];

           
            if (password_verify($input_password, $stored_hash)) {
                
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_user'] = $input_username;
                header("Location: manage.php");
                exit();
            } else {
          
                $login_error = "Invalid username or password.";
            }
        } else {
         
            $login_error = "Invalid username or password.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<h2>Manager Login</h2>

<section class="login-form-container">
    <p>Please log in to access the Expression of Interest management interface.</p>
    
    <?php if ($login_error): ?>
        <p style="color: red; font-weight: bold;"><?php echo $login_error; ?></p>
    <?php endif; ?>

    <form action="manager_login.php" method="post" class="apply-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Log In</button>
    </form>
</section>

<?php
include_once 'footer.inc';
?>