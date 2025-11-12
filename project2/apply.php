<?php
    $pageTitle = "Job Application";
    include 'header.inc';
    include 'nav.inc';
?>

<body>
    <form method="post" action="https://mercury.swin.edu.au/it000000/formtest.php">
    <div>
        <div>
            <p>
                <label for="job-ref">Job Reference Number</label></br>
                <input class="form-input" type="text" id="job-ref" name="job-ref" pattern="[A-Za-z0-9]{5}" placeholder="5 alpha characters" title="Must be exactly 5 alphanumeric characters" required>
            </p>
        </div>
        <div>
            <p>
                <label for="first-name">First Name</label></br>
                <input class="form-input" type="text" id="first-name" name="first-name" maxlength="20" placeholder="20 alpha characters max" required>
            </p>
        </div>
        <div>
            <p>
                <label for="last-name">Last Name</label></br>
                <input class="form-input" type="text" id="last-name" name="last-name" maxlength="20" placeholder="20 alpha characters max" required>
            </p>
        </div>
        <div>
            <p>
                <label for="dob">Date of Birth</label></br>
                <input class="form-input" type="date" id="dob" name="dob" required>
            </p>
        </div>
        <div>
            <p>
                <label for="gender">Gender</label></br>
                <input class="form-select" type="radio" id="male" name="gender" value="male" checked>
                <label for="male">Male</label>
                <input class="form-select" type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <input class="form-select" type="radio" id="other" name="gender" value="other">
                <label for="other">Other</label>
            </p>
        </div>
    </div>
    <div>
        <p>
            <label for="address">Street Address</label></br>
            <input class="form-input" type="text" id="address" name="address" maxlength="40" placeholder="40 characters max" required>
        </p>
    </div>
    <div>
        <p>
            <label for="suburb">Suburb Town</label></br>
            <input class="form-input" type="text" id="suburb" name="suburb" maxlength="40" placeholder="40 characters max" required>
        </p>
    </div>
    <div>
        <p>
            <label for="state">State</label></br>
            <select class="form-input" id="state" name="state" required>
                <option value="" disabled selected>Select your state</option>
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
            </select>
        </p>
    </div>
    <div>
        <p>
            <label for="postcode">Postcode</label></br>
            <input class="form-input" type="text" id="postcode" name="postcode" pattern="\d{4}" placeholder="4 digit number" title="Exactly 4 digits based on States" required>
        </p>
    </div>
    <div>
        <p>
            <label for="email">Email</label></br>
            <input class="form-input" type="email" id="email" name="email" placeholder="103847381@student.swin.edu.au" required>
        </p>
    </div>
    <div>
        <p>
            <label for="phone">Phone Number</label></br>
            <input class="form-input" type="tel" id="phone" name="phone" pattern="[0-9]{8,12}" placeholder="8-12 digits" title="8 to 12 digits, or spaces" required>
        </p>
    </div>
    <div>
        <p>
            <label for="skills">Skills</label></br>
            <input type="checkbox" id="skill1" name="skills[]" value="machine-learning" checked>
            <label for="skill1">Machine Learning</label>
            <input type="checkbox" id="skill2" name="skills[]" value="mysql">
            <label for="skill2">MySQL</label>
            <input type="checkbox" id="skill3" name="skills[]" value="aws">
            <label for="skill3">AWS Services</label>
        </p>
    </div>
    <div>
        <p>
            <label for="other-skills">Other skills</label></br>
            <textarea class="form-input" id="other-skills" name="other-skills" rows="4" cols="35"></textarea>
        </p>
    </div>
    <div>
        <div>
            <input class="button" type="submit" value="Apply">
            <input class="button" type="reset" value="Reset Form">
        </div>
    </div>
    </form>

    <?php include 'footer.inc'; ?>
</body>
</html>