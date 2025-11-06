<?php

$currentPage = basename($_SERVER['PHP_SELF']);

if (!isset($pageTitle)) { $pageTitle = "SWC IT - Careers"; } 
?>
<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo $pageTitle; ?></title>
  <meta name="description" content="SWC IT - Network Administrator and IT careers.">
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  <header class="site-header" role="banner">
    <div class="logo">
      <img src="images/Vm1Xdy5qcGc.png" alt="SWC IT Company Logo" width="150" height="60">
    </div>
    <h1>SWC IT</h1>
    <p class="tagline">Reliable infrastructure. Secure networks. Smart solutions.</p>

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
  </header>
  <main class="container" role="main">