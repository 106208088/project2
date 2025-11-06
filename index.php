<?php
// index.php
// SWC IT Careers Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SWC IT - Careers</title>
  <meta name="description" content="SWC IT - Network Administrator and IT careers.">
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  <?php include('header.inc'); ?>

  <main class="container" role="main">
    <section>
      <h2>Welcome — Network Administrator Careers</h2>
      <p>
        SWC IT is a fictitious but realistic IT company specialising in enterprise network design,
        monitoring and cybersecurity. We are recruiting talented people to join our engineering team.
      </p>
      <figure>
        <img src="images/working.jpg" alt="IT team discussing network diagram" style="max-width:100%;">
        <figcaption>Our Network Engineering team at work.</figcaption>
      </figure>
    </section>

    <section>
      <h3>Why work at SWC?</h3>
      <ul>
        <li>➡️Competitive salary and benefits</li>
        <li>➡️Professional development & cert support</li>
        <li>➡️Flexible/hybrid working arrangements</li>
      </ul>
    </section>
  </main>

  <?php include('footer.inc'); ?>
</body>
</html>
