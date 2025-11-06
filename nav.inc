<?php
// nav.inc: Contains the main navigation menu structure

// Get the current page filename to apply the 'active' class
$currentPage = basename($_SERVER['PHP_SELF']); 
?>
<nav class="main-nav" role="navigation" aria-label="Main menu">
  <ul>
    <li><a href="index.php" class="<?php if($currentPage == 'index.php') echo 'active'; ?>">Home</a></li>
    <li><a href="jobs.php" class="<?php if($currentPage == 'jobs.php') echo 'active'; ?>">Position Descriptions</a></li>
    <li><a href="apply.php" class="<?php if($currentPage == 'apply.php') echo 'active'; ?>">Apply</a></li>
    <li><a href="about.php" class="<?php if($currentPage == 'about.php') echo 'active'; ?>">About</a></li>
    <li><a href="privacy.php" class="<?php if($currentPage == 'privacy.php') echo 'active'; ?>">Privacy Policy</a></li>
    <li><a href="manage.php" class="<?php if($currentPage == 'manage.php') echo 'active'; ?>">Manager</a></li>
    <li><a href="enhancements.php" class="<?php if($currentPage == 'enhancements.php') echo 'active'; ?>">Enhancements</a></li>
  </ul>
</nav>