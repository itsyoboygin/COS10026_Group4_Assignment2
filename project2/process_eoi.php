<?php
// process_eoi.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit();
}

require_once 'settings.php'; 

function clean($v) {
    return trim(strip_tags((string)$v));
}

// Read inputs 
$job_ref = isset($_POST['job-ref']) ? clean($_POST['job-ref']) : '';
$first_name = isset($_POST['first-name']) ? clean($_POST['first-name']) : '';
$last_name = isset($_POST['last-name']) ? clean($_POST['last-name']) : '';
$dob = isset($_POST['dob']) ? clean($_POST['dob']) : '';
$gender = isset($_POST['gender']) ? clean($_POST['gender']) : '';
$address = isset($_POST['address']) ? clean($_POST['address']) : '';
$suburb = isset($_POST['suburb']) ? clean($_POST['suburb']) : '';
$state = isset($_POST['state']) ? clean($_POST['state']) : '';
$postcode = isset($_POST['postcode']) ? clean($_POST['postcode']) : '';
$email = isset($_POST['email']) ? clean($_POST['email']) : '';
$phone = isset($_POST['phone']) ? clean($_POST['phone']) : '';
$skills = isset($_POST['skills']) && is_array($_POST['skills']) ? $_POST['skills'] : [];
$other_skills = isset($_POST['other-skills']) ? clean($_POST['other-skills']) : '';

$errors = [];

// Allowed job references
$allowed_jobs = ['SDV01','CLE06'];
if (!in_array($job_ref, $allowed_jobs, true)) {
    $errors[] = 'Invalid job reference selected.';
}

// Names: alpha up to 20
if (!preg_match('/^[A-Za-z]{1,20}$/', $first_name)) {
    $errors[] = 'First name must be 1-20 alphabetic characters.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $last_name)) {
    $errors[] = 'Last name must be 1-20 alphabetic characters.';
}

// DOB: expect YYYY-MM-DD
$d = DateTime::createFromFormat('Y-m-d', $dob);
if (!$d || $d->format('Y-m-d') !== $dob) {
    $errors[] = 'Date of birth is invalid.';
}

// Gender
if (!in_array($gender, ['male','female','other'], true)) {
    $errors[] = 'Invalid gender selection.';
}

// Address/suburb
if ($address === '' || mb_strlen($address) > 40) {
    $errors[] = 'Street address must be 1-40 characters.';
}
if ($suburb === '' || mb_strlen($suburb) > 40) {
    $errors[] = 'Suburb/Town must be 1-40 characters.';
}

// State
if (!in_array($state, ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'], true)) {
    $errors[] = 'Please select a valid state.';
}

// Postcode: 4 digits
if (!preg_match('/^\d{4}$/', $postcode)) {
    $errors[] = 'Postcode must be exactly 4 digits.';
}

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address.';
}

// Phone: 8-12 characters
if (!preg_match('/^[\d\s()+-]{8,12}$/', $phone)) {
    $errors[] = 'Phone number must be 8-12 characters (digits, spaces, +, (), -).';
}

// Skills: require at least one
if (count($skills) === 0) {
    $errors[] = 'Please select at least one technical skill.';
}

// If "other" skill checkbox selected then other_skills must not be empty
if (in_array('other', $skills, true) && trim($other_skills) === '') {
    $errors[] = 'Please describe your other skills when "Other" is selected.';
}

// If errors, show list and stop
if (!empty($errors)) {
    echo '<h2>There were validation errors</h2><ul>';
    foreach ($errors as $e) {
        echo '<li>' . htmlspecialchars($e) . '</li>';
    }
    echo '</ul><p><a href="apply.php">Go back to the form</a></p>';
    exit();
}

// Create table if not exists
$create_sql = "CREATE TABLE IF NOT EXISTS EOI (
    EOInumber INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(10) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('male','female','other') NOT NULL,
    street_address VARCHAR(40) NOT NULL,
    suburb_town VARCHAR(40) NOT NULL,
    state VARCHAR(5) NOT NULL,
    postcode VARCHAR(4) NOT NULL,
    email_address VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    skills VARCHAR(255),
    other_skills_description TEXT,
    status ENUM('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (!mysqli_query($conn, $create_sql)) {
    echo '<p>Error creating table: ' . mysqli_error($conn) . '</p>';
    exit();
}

// Seed table with default records if it's empty
$cntRes = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM EOI");
if ($cntRes) {
    $cntRow = mysqli_fetch_assoc($cntRes);
    if (isset($cntRow['cnt']) && intval($cntRow['cnt']) === 0) {
        $seed_sql = "INSERT INTO EOI (job_reference_number, first_name, last_name, dob, gender, street_address, suburb_town, state, postcode, email_address, phone_number, skills, other_skills_description) VALUES
        ('SDV01','Alice','Smith','1990-05-12','female','1 Example St','Melbourne','VIC','3000','alice.smith@example.com','0400123001','machine-learning',''),
        ('CLE06','Bob','Jones','1985-03-22','male','2 Example Rd','Sydney','NSW','2000','bob.jones@example.com','0400123002','aws',''),
        ('SDV01','Carol','Nguyen','1992-07-08','female','3 Sample Ave','Brisbane','QLD','4000','carol.nguyen@example.com','0400123003','mysql',''),
        ('CLE06','Daniel','Brown','1988-11-30','male','4 Test Blvd','Darwin','NT','0800','daniel.brown@example.com','0400123004','aws',''),
        ('SDV01','Emma','Wilson','1995-01-17','female','5 Demo Ln','Perth','WA','6000','emma.wilson@example.com','0400123005','machine-learning,mysql',''),
        ('CLE06','Frank','Taylor','1983-09-05','male','6 Trial St','Adelaide','SA','5000','frank.taylor@example.com','0400123006','aws',''),
        ('SDV01','Grace','Lee','1991-06-21','female','7 Mock Rd','Hobart','TAS','7000','grace.lee@example.com','0400123007','mysql',''),
        ('CLE06','Henry','Martin','1979-12-10','male','8 Fake Ave','Canberra','ACT','2600','henry.martin@example.com','0400123008','aws,machine-learning',''),
        ('SDV01','Ivy','Patel','1993-04-02','female','9 Example Pl','Melbourne','VIC','3001','ivy.patel@example.com','0400123009','mysql',''),
        ('CLE06','Jack','Olsen','1987-08-14','male','10 Demo Dr','Sydney','NSW','2001','jack.olsen@example.com','0400123010','machine-learning','')";

        if (!mysqli_query($conn, $seed_sql)) {
            // non-fatal: show warning but continue
            error_log('Failed inserting seed EOI records: ' . mysqli_error($conn));
        }
    }
    mysqli_free_result($cntRes);
}

// Prepare insert
$skills_str = implode(',', array_map('clean', $skills));
$insert_sql = "INSERT INTO EOI
    (job_reference_number, first_name, last_name, dob, gender, street_address, suburb_town, state, postcode, email_address, phone_number, skills, other_skills_description)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insert_sql);
if (!$stmt) {
    echo '<p>Prepare failed: ' . mysqli_error($conn) . '</p>';
    exit();
}

mysqli_stmt_bind_param($stmt, 'sssssssssssss',
    $job_ref, $first_name, $last_name, $dob, $gender, $address, $suburb, $state, $postcode, $email, $phone, $skills_str, $other_skills);

$ok = mysqli_stmt_execute($stmt);
if (!$ok) {
    echo '<p>Error inserting record: ' . mysqli_stmt_error($stmt) . '</p>';
    exit();
}

$eoi_number = mysqli_insert_id($conn);

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Confirmation page
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EOI Submitted</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>
    <main style="max-width:800px;margin:2em auto;padding:1em;">
        <h1>Thank you</h1>
        <p>Your Expression Of Interest has been received.</p>
        <p>Your EOI number is: <strong><?php echo htmlspecialchars($eoi_number); ?></strong></p>
        <p><a href="index.php">Return to home</a></p>
    </main>
    <?php include 'footer.inc'; ?>
</body>
</html>