<?php
$pageTitle = "SWC IT - Enhancements";
include_once 'header.inc';
?>
    <h2>Project Part 2 Enhancements</h2>
    <p>This page documents the voluntary enhancements implemented beyond the specified core requirements.</p>

    <section>
      <h3>Enhancement 1: Dynamic EOI Table Sorting</h3>
      <p>
        The <code>manage.php</code> page was enhanced to allow the HR manager to **sort** the displayed EOI records
        by Applicant Last Name and EOI Number in ascending or descending order by clicking on column headers.
      </p>
      <h4>Implementation Details:</h4>
      <ul>
        <li>Added logic to handle <code>$_GET['sort_by']</code> and <code>$_GET['order']</code> parameters.</li>
        <li>The script dynamically constructs the SQL <code>ORDER BY</code> clause based on these URL parameters.</li>
      </ul>
    </section>

    <section>
      <h3>Enhancement 2: Manager Login Security</h3>
      <p>
        The <code>manage.php</code> page is protected by a simple login form, controlling access to the EOI data.
      </p>
      <h4>Implementation Details:</h4>
      <ul>
        <li>A new table named <code>managers</code> was created to store a single username/hashed password.</li>
        <li>A simple session-based login check is performed at the top of <code>manage.php</code>. If the user is not logged in, they are redirected to a login page.</li>
      </ul>
    </section>

<?php
include_once 'footer.inc';
?>