<?php
$pageTitle = "SWC IT - HR Manager Interface";
include_once 'header.inc';
include_once 'settings.php';
?>
    <h2>HR Manager Portal</h2>
    <p>This page provides access to Expressions of Interest (EOI) data from applicants.</p>

    <section>
        <h3>Search & Display Expressions of Interest</h3>
        <form action="manage.php" method="GET">
            <label for="search_ref">Search by Job Reference Number:</label>
            <input type="text" id="search_ref" name="job_ref" maxlength="5">
            <button type="submit">Search by Ref</button>
        </form>

        <form action="manage.php" method="GET">
            <label for="search_name">Search by Applicant Name (First or Last):</label>
            <input type="text" id="search_name" name="applicant_name" maxlength="40">
            <button type="submit">Search by Name</button>
        </form>

        <form action="manage.php" method="GET">
             <input type="hidden" name="action" value="list_all">
             <button type="submit">List All EOIs</button>
        </form>

        </section>

    <hr>

    <section>
        <h3>Delete EOI Records</h3>
        <p>This action will permanently **delete all** Expressions of Interest for the specified job reference number.</p>
        <form action="manage.php" method="POST">
            <label for="delete_ref">Job Reference to Delete ALL records:</label>
            <input type="text" id="delete_ref" name="delete_job_ref" maxlength="5" required>
            <button type="submit" name="action" value="delete_ref">Delete All Matching EOIs</button>
        </form>
    </section>

    <hr>

    <section>
        <h3>Update EOI Status</h3>
        <p>Change the status of a specific Expression of Interest (e.g., New, Current, Final).</p>
        <form action="manage.php" method="POST">
            <label for="eoi_num">EOI Number to Update:</label>
            <input type="text" id="eoi_num" name="eoi_number" required>

            <label for="new_status">New Status:</label>
            <select id="new_status" name="new_status" required>
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>
            <button type="submit" name="action" value="update_status">Update Status</button>
        </form>
    </section>

<?php
include_once 'footer.inc';
?>