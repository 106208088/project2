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

    <?php include_once 'nav.inc'; ?>

  </header>
  <main class="container" role="main">