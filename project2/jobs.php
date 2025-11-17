<?php 
$pageTitle = "Career Opportunities";
include 'header.inc';
include 'nav.inc';

require_once 'settings.php';
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<body>
    <main id="job-listing">
        <?php 
        $sql = "SELECT * FROM jobs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1>Current Job Vacancies at AlgoWeave</h1>";
            while ($row = $result->fetch_assoc()) {
                echo "<section id='our-values' style='margin-bottom:2em;'>";
                echo "<h3>{$row['title']}</h3>";
                echo "<p><strong>Position Reference Number:</strong> {$row['job_ref']}</p>";
                echo "<p><strong>Salary Range:</strong> \${$row['salary_min']} - \${$row['salary_max']}</p>";
                echo "<p><strong>Reports To:</strong> {$row['reports_to']}</p>";
                echo "<h4>Position Summary</h4><p>{$row['summary']}</p>";
                echo "<h4>Key Responsibilities</h4><pre>{$row['responsibilities']}</pre>";
                echo "<h4>Essential Requirements</h4><pre>{$row['essential_requirements']}</pre>";
                echo "<h4>Preferable Requirements</h4><pre>{$row['preferable_requirements']}</pre>";
                echo "<a href='apply.php'><button class='job-button'>Apply</button></a>";
                echo "</section>";

            }
        } else {
            echo "<p>No job vacancies available.</p>";
        }
        $conn->close();
        ?>
    </main>
    <?php include 'footer.inc'; ?>
</body>