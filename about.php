<?php
// about.php
// SWC IT - Group Page
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
  <?php include('header.inc'); ?>

  <main class="container">
    <section>
      <h2>Group Details</h2>
      <p>Class time: Friday 14:00 - 17:00</p>

      <h3>Members & Student IDs</h3>
      <ul class="nested">
        <li>John Smith - Student ID: SWH03431</li>
        <li>Jane Doe - Student ID: SWH</li>
        <li>Alex Lee - Student ID: SWH</li>
      </ul>

      <h3>Tutor</h3>
      <p>Tutor: Mr. Binh Vu Ngoc</p>

      <h3>Member contributions</h3>
      <dl class="list"> 
        <dt>- John Smith</dt>
        <dd>Site design, privacy.php, about.php, styles.css</dd>
        <dt>- Jane Doe</dt>
        <dd>apply.php, jobs.php, form validation</dd>
        <dt>- Alex Lee</dt>
        <dd>index.php images, deployment, styles.css</dd>
      </dl>

      <figure class="group-photo">
        <img src="images/group_photo.jpg" alt="Group photo" width="300">
        <figcaption>Our team - SWC IT</figcaption>`
      </figure>
    </section>

    <section>
      <h3>Interests</h3>
      <table class="members-table">
        <caption>Skills and Interests</caption>
        <thead>
          <tr><th>Member</th><th>Primary Skill</th><th>Other Interests</th></tr>
        </thead>
        <tbody>
          <tr><td>John Smith</td><td>Networking</td><td>Security, AI</td></tr>
          <tr><td>Jane Doe</td><td>Front-end</td><td>Design</td></tr>
          <tr><td>Alex Lee</td><td>DevOps</td><td>Cloud</td></tr>
        </tbody>
      </table>
    </section>
  </main>

  <?php include('footer.inc'); ?>
</body>
</html>

