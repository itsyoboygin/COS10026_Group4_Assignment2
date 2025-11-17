<?php
$host = 'localhost';
$user = 'root';
$pwd = '';
$sql_db = 'assignment2';

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!mysqli_connect($host, $user, $pwd, $sql_db)) {
    die("<p style='color:red;'>Database connection failed: </p>" . mysqli_connect_error());
}

{/* Creating EOI table and inserting data */}
$sql = "CREATE TABLE IF NOT EXISTS EOI (
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

if (!mysqli_query($conn, $sql)) {
    echo '<p>Error creating table: ' . mysqli_error($conn) . '</p>';
    exit();
}

$cntRes = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM EOI");
if ($cntRes) {
    $cntRow = mysqli_fetch_assoc($cntRes);
    if (isset($cntRow['cnt']) && intval($cntRow['cnt']) === 0) {
        $sql = "INSERT INTO EOI (job_reference_number, first_name, last_name, dob, gender, street_address, suburb_town, state, postcode, email_address, phone_number, skills, other_skills_description) VALUES
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

        if (!mysqli_query($conn, $sql)) {
            // non-fatal: show warning but continue
            error_log('Failed inserting seed EOI records: ' . mysqli_error($conn));
        }
    }
    mysqli_free_result($cntRes);
}

{/* Creating Jobs table and inserting data */}
$sql = "CREATE TABLE IF NOT EXISTS jobs (
    job_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(10) NOT NULL UNIQUE,
    title VARCHAR(100) NOT NULL,
    salary_min DECIMAL(10,2) NOT NULL,
    salary_max DECIMAL(10,2) NOT NULL,
    reports_to VARCHAR(100) DEFAULT NULL,
    summary TEXT DEFAULT NULL,
    responsibilities TEXT DEFAULT NULL,
    essential_requirements TEXT DEFAULT NULL,
    preferable_requirements TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (!mysqli_query($conn, $sql)) {
    echo "Error creating jobs table: " . mysqli_error($conn);
    exit();
}

$cntRes = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM jobs");
if ($cntRes) {
    $cntRow = mysqli_fetch_assoc($cntRes);
    if (isset($cntRow['cnt']) && intval($cntRow['cnt']) === 0) {
        $sql = "INSERT INTO jobs (job_ref, title, salary_min, salary_max, reports_to, summary, responsibilities, essential_requirements, preferable_requirements)
        VALUES
        ('SDV01', 'Software Developer', 80000.00, 110000.00, 'Engineering Manager',
        'Responsible for full software development lifecycle in Agile environment.',
        '- Design, build, and maintain efficient code using Python and Java.\n- Perform testing and debugging.\n- Collaborate with cross-functional teams.',
        '- Bachelor\'s in CS or related field.\n- 3+ years experience in backend development.\n- Strong OOP and REST API skills.',
        '- Experience with Django/Flask or Spring Boot.\n- Familiarity with Docker/Kubernetes.\n- Knowledge of accessibility standards.'),
        ('CLE06', 'Cloud Engineer', 95000.00, 130000.00, 'Infrastructure Director',
        'Responsible for designing and managing secure, scalable cloud infrastructure.',
        '- Design and manage GCP resources.\n- Implement IaC using Terraform.\n- Develop CI/CD pipelines.',
        '- 2+ years experience with major cloud provider.\n- Strong Terraform and containerization skills.',
        '- Professional Cloud certification.\n- Experience with monitoring tools.\n- Familiarity with Ansible or Puppet.')";
        
        if (!mysqli_query($conn, $sql)) {
            error_log('Failed inserting seed jobs records: ' . mysqli_error($conn));
        }
    }
    mysqli_free_result($cntRes);
}

{/* User table */}
$sql = "CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(100) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (!mysqli_query($conn, $sql)) {
    echo "Error creating user table: " . mysqli_error($conn);
    exit();
}

$cntRes = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM user");
if ($cntRes) {
    $cntRow = mysqli_fetch_assoc($cntRes);
    if (isset($cntRow['cnt']) && intval($cntRow['cnt']) === 0) {
        $sql = "INSERT INTO user (username, password, email)
                VALUES ('Phuc', '103847381', 'phucdoox@gmail.com')";
        if (!mysqli_query($conn, $sql)) {
            error_log('Failed inserting seed user record: ' . mysqli_error($conn));
        }
    }
    mysqli_free_result($cntRes);
}
?>