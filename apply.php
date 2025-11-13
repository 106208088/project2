<?php
$pageTitle = "SWC IT - Apply";
include_once 'header.inc';
?>
    <h1>Apply for a Position</h1>

    <form action="process_eoi.php" method="post" class="apply-form" novalidate>
      <label for="jobref">Job reference number</label>
      <select id="jobref" name="jobref" required>
        <option value="">--Select job--</option>
        <option value="NA12B">NA12B - Network Administrator</option>
        <option value="ITSM7">ITSM7 - IT Service Management Analyst</option>
      </select>

      <label for="fname">First name</label>
      <input id="fname" name="firstname" type="text" maxlength="20" pattern="[A-Za-z\-']{1,20}" title="Letters, hyphen or apostrophe only." required>

      <label for="lname">Last name</label>
      <input id="lname" name="lastname" type="text" maxlength="20" pattern="[A-Za-z\-']{1,20}" required>

      <label for="dob">Date of birth</label>
      <input id="dob" name="dob" type="date" required aria-describedby="dobHelp">
      <small id="dobHelp">Use the date picker (dd/mm/yyyy may be displayed according to browser locale).</small>

      <fieldset>
        <legend>Gender</legend>
        <label><input type="radio" name="gender" value="female" required> Female</label>
        <label><input type="radio" name="gender" value="male" required> Male</label>
        <label><input type="radio" name="gender" value="other" required> Other</label>
      </fieldset>

      <label for="address">Street address</label>
      <input id="address" name="street" type="text" maxlength="40" required>

      <label for="suburb">Suburb/town</label>
      <input id="suburb" name="suburb" type="text" maxlength="40" required>

      <label for="state">State</label>
      <select id="state" name="state" required>
        <option value="">--Select--</option>
        <option value="VIC">VIC</option>
        <option value="NSW">NSW</option>
        <option value="QLD">QLD</option>
        <option value="NT">NT</option>
        <option value="WA">WA</option>
        <option value="SA">SA</option>
        <option value="TAS">TAS</option>
        <option value="ACT">ACT</option>
      </select>

      <label for="postcode">Postcode</label>
      <input id="postcode" name="postcode" type="text" pattern="\d{4}" maxlength="4" title="Enter exactly 4 digits." required>

      <label for="email">Email address</label>
      <input id="email" name="email" type="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">

      <label for="phone">Phone number</label>
      <input id="phone" name="phone" type="tel" pattern="[\d\s]{8,12}" title="8 to 12 digits or spaces." required>

      <fieldset>
        <legend>Required technical skills</legend>
        <label><input type="checkbox" name="skills[]" value="Networking" checked> Networking</label>
        <label><input type="checkbox" name="skills[]" value="Security"> Security</label>
        <label><input type="checkbox" name="skills[]" value="Cloud"> Cloud</label>
        <label><input type="checkbox" name="skills[]" value="ITSM"> ITSM/ITIL</label>
        <label><input type="checkbox" name="skills[]" value="Automation"> Automation/Scripting</label>
      </fieldset>

      <label for="others">Other skills</label>
      <textarea id="others" name="others" rows="5" maxlength="1000" placeholder="Optional - list additional skills"></textarea>

      <button type="submit">Apply</button>
    </form>

<?php
include_once 'footer.inc';
?>