<?php include('header.inc'); include('nav.inc'); ?>

<h2>Apply for a Job</h2>

<form action="process_eoi.php" method="post" novalidate>
  <label>Job Reference Number:</label>
  <input type="text" name="job_ref" value="<?php echo $_GET['job_ref'] ?? ''; ?>" required><br>

  <label>First Name:</label>
  <input type="text" name="first_name" maxlength="20" required><br>

  <label>Last Name:</label>
  <input type="text" name="last_name" maxlength="20" required><br>

  <label>Street:</label>
  <input type="text" name="street" maxlength="40"><br>

  <label>Suburb/Town:</label>
  <input type="text" name="suburb" maxlength="40"><br>

  <label>State:</label>
  <select name="state">
    <option>VIC</option><option>NSW</option><option>QLD</option>
    <option>NT</option><option>WA</option><option>SA</option>
    <option>TAS</option><option>ACT</option>
  </select><br>

  <label>Postcode:</label>
  <input type="text" name="postcode" pattern="\d{4}"><br>

  <label>Email:</label>
  <input type="email" name="email"><br>

  <label>Phone:</label>
  <input type="text" name="phone"><br>

  <fieldset>
    <legend>Skills</legend>
    <label><input type="checkbox" name="skill1"> HTML</label>
    <label><input type="checkbox" name="skill2"> CSS</label>
    <label><input type="checkbox" name="skill3"> PHP</label>
  </fieldset>

  <label>Other Skills:</label>
  <textarea name="other_skills"></textarea><br>

  <input type="submit" value="Submit Application">
</form>

<?php include('footer.inc'); ?>
<?php