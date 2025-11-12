<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SWC IT - Position Descriptions</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  <?php include('header.inc'); ?>

  <main class="container">
    <h2>Position Descriptions</h2>

    <section id="pos-NA">
      <h2>Position: Network Administrator</h2>
      <p><span class="job-ref">NA12B</span></p>
      <p><strong>Brief description:</strong> The Network Administrator manages corporate LAN/WAN, ensures uptime,
        configures enterprise switches/routers, performs monitoring, and implements security controls.
      </p>

      <h3>Salary & Reporting</h3>
      <p>Salary range: AU$85,000 - AU$105,000 per annum (dependent on experience).</p>
      <p>Reports to: Senior Network Engineer</p>

      <h3>Key responsibilities</h3>
      <ol>
        <li>Deploy and maintain network switches, routers, firewalls and wireless systems.</li>
        <li>Monitor network health and respond to incidents to achieve SLA targets.</li>
        <li>Carry out network configuration changes, backups and documentation.</li>
        <li>Collaborate with security team to apply patches and firewall rules.</li>
      </ol>

      <h3>Required qualifications, skills and knowledge</h3>
      <h4>Essential</h4>
      <ul>
        <li>Bachelor's degree in IT or equivalent experience.</li>
        <li>3+ years in network administration (Cisco/Juniper experience preferred).</li>
        <li>Knowledge of TCP/IP, VLANs, OSPF/BGP, DHCP, DNS, and network monitoring tools.</li>
        <li>CCNA or equivalent certification.</li>
      </ul>

      <h4>Preferable</h4>
      <ul>
        <li>Experience with automation (Ansible) and scripting (Python, Bash).</li>
        <li>Experience in cloud networking (AWS VPC / Azure VNets).</li>
      </ul>
    </section>

    <aside aria-label="Other job summary">
      <h3>Apply</h3>
      <p>To apply, use the Apply page and select the job reference from the dropdown.</p>
      <p>See also: benefits, training & certification support.</p>
    </aside>

    <section id="pos-ITSM">
      <h2>Position: IT Service Management Analyst</h2>
      <p><strong>Ref:</strong> <span class="job-ref">ITSM7</span></p>
      <p><strong>Brief description:</strong> The ITSM Analyst focuses on ITIL-based incident, problem and change processes,
         drives service improvements and coordinates between stakeholders to ensure high-quality IT service delivery.
      </p>

      <h3>Salary & Reporting</h3>
      <p>Salary range: AU$70,000 - AU$90,000 per annum.</p>
      <p>Reports to: IT Operations Manager</p>

      <h3>Key responsibilities</h3>
      <ol>
        <li>Manage incident lifecycle and ensure first response SLAs are met.</li>
        <li>Run problem investigations and document root causes.</li>
        <li>Coordinate change approvals and release windows with stakeholders.</li>
      </ol>

      <h3>Required qualifications, skills and knowledge</h3>
      <h4>Essential</h4>
      <ul>
        <li>2+ years in IT support or service management.</li>
        <li>Familiarity with ITIL foundations and ticketing systems (Jira Service Management preferred).</li>
      </ul>

      <h4>Preferable</h4>
      <ul>
        <li>Experience with service automation and reporting (Power BI/Excel).</li>
      </ul>
    </section>

    <footer class="page-footer">
      <p>References: job templates adapted and paraphrased from sample job descriptions found online.
         Source links are included as code comments in project files.</p>
    </footer>
  </main>

  <?php include('footer.inc'); ?>
</body>
</html>

<?php
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if ($conn) {
  $query = "SELECT * FROM jobs";
  $result = mysqli_query($conn, $query);
}
include('header.inc');
include('nav.inc');
?>

<h2>Available Jobs</h2>
<div class="jobs-container">
<?php
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='job'>
            <h3>{$row['title']} ({$row['job_ref']})</h3>
            <p>{$row['description']}</p>
            <p><strong>Salary:</strong> {$row['salary']}</p>
            <p><strong>Closing Date:</strong> {$row['closing_date']}</p>
            <a href='apply.php?job_ref={$row['job_ref']}'>Apply Now</a>
          </div>";
  }
}
mysqli_close($conn);
?>
</div>

<?php include('footer.inc'); ?>

