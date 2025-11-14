<?php
$pageTitle = "SWC IT - About";
include_once 'header.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SWC IT - Group</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
 
  <main class="container">

    <section>
      <figure class="group-photo">
        <img src="images/group_photo.jpg" alt="Group photo" width="300">
        <figcaption>Our team - SWC IT</figcaption>
      </figure>
    </section>
    <section>
      <h2>Group Details</h2>
      <p>Class time: Friday 14:00 - 17:00</p>

      <h3>Members & Student IDs</h3>
      <ul class="nested">
        <li>Nhat Minh Hoang Vo - Student ID: SWH03431</li>
        <li>Nguyen Minh Quang - Student ID: SWH02960</li>
        <li>Vu Huu Nhat Minh - Student ID: SWH03022</li>
      </ul>

      <h3>Tutor</h3>
      <p>Tutor: Mr. Binh Vu Ngoc</p>

      <h3>Member contributions</h3>
      <dl class="list"> 
        <dt>- Hoang Vo</dt>
        <dd>Site design, styles.css, enhancements.php, header.inc, footer.inc, nav.inc, privacy.php, management.php, deployment</dd>
        <dt>- Quang Nguyen</dt>
        <dd>index.php, about.php, process_eoi.php, settings.php, process_eoi validation</dd>
        <dt>- Minh Vu</dt>
        <dd>jobs.php, apply.php, create_tables.sql, implement PHP/MySQL queries</dd>
      </dl>
    </section>

    <section>
      <h3>Interests</h3>
      <table class="members-table">
        <caption>Skills and Interests</caption>
        <thead>
          <tr><th>Member</th><th>Primary Skill</th><th>Other Interests</th></tr>
        </thead>
        <tbody>
          <tr><td>Hoang Vo</td><td>Networking</td><td>Security, AI</td></tr>
          <tr><td>Quang Nguyen</td><td>Front-end</td><td>Design</td></tr>
          <tr><td>Minh Vu</td><td>DevOps</td><td>Cloud</td></tr>
        </tbody>
      </table>
    </section>
  </main>

  <?php include('footer.inc'); ?>
</body>
</html>

