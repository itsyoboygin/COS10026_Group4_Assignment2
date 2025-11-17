<?php
require_once '../settings.php';

function clean($v) {
    return trim(strip_tags((string)$v));
}

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p style='color:red;'>Database connection failed: </p>" . mysqli_connect_error());
}

include 'header.inc';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Portal</title>
    <meta name="description" content="Manager Portal">

</head>
<body>
    <main>
        <h1>Manage EOIs</h1>
        <form method="post">
            <h3>List All EOIs</h3>
            <button name="list_all">Show All</button>

            <h3>Search by Job Reference</h3>
            <input type="text" name="job_ref" placeholder="Enter Job Reference">
            <button name="search_job">Search</button>

            <h3>Search by Applicant Name</h3>
            <input type="text" name="first_name" placeholder="First Name">
            <input type="text" name="last_name" placeholder="Last Name">
            <button name="search_name">Search</button>
            
            <h3>Delete EOIs by Job Reference</h3>
            <input type="text" name="delete_job_ref" placeholder="Job Reference">
            <button name="delete_job">Delete</button>

            <h3>Change Status</h3>
            <input type="text" name="status_job_ref" placeholder="Job Reference">
            <select name="new_status">
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>
            <button name="update_status">Update</button>
        </form>

        <?php
        // Display results in a table
        function displayResults($result) {
            if ($result->num_rows > 0) {
                echo "<table border='1' cellpadding='5'><tr>
                    <th>EOI#</th><th>Job Ref</th><th>Name</th><th>Email</th><th>Status</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['EOInumber']}</td>
                        <td>{$row['job_reference_number']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['email_address']}</td>
                        <td>{$row['status']}</td>
                        </tr>";
                }
                echo "</table>";
                echo "<br>";
            } else {
                echo "<p>No records found.</p>";
            }
        }

        // List all EOIs
        if (isset($_POST['list_all'])) {
            $result = $conn->query("SELECT EOInumber, job_reference_number, first_name, last_name, email_address, status FROM EOI");
            displayResults($result);
        }

        // Search by Job Reference
        if (isset($_POST['search_job'])) {
            $job_ref = clean($_POST['job_ref']);
            $stmt = $conn->prepare("SELECT EOInumber, job_reference_number, first_name, last_name, email_address, status FROM EOI WHERE job_reference_number=?");
            $stmt->bind_param("s", $job_ref);
            $stmt->execute();
            $result = $stmt->get_result();
            displayResults($result);
            $stmt->close();
        }

        // Search by Name
        if (isset($_POST['search_name'])) {
            $first = clean($_POST['first_name']);
            $last = clean($_POST['last_name']);
            $query = "SELECT EOInumber, job_reference_number, first_name, last_name, email_address, status FROM EOI WHERE 1=1";
            $params = [];
            $types = "";
            if ($first !== "") { $query .= " AND first_name=?"; $params[] = $first; $types .= "s"; }
            if ($last !== "") { $query .= " AND last_name=?"; $params[] = $last; $types .= "s"; }
            $stmt = $conn->prepare($query);
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            displayResults($result);
            $stmt->close();
        }

        // Delete EOIs by Job Reference
        if (isset($_POST['delete_job'])) {
            $job_ref = clean($_POST['delete_job_ref']);
            $stmt = $conn->prepare("DELETE FROM EOI WHERE job_reference_number=?");
            $stmt->bind_param("s", $job_ref);
            $stmt->execute();
            echo "<p>Deleted EOIs for job reference: $job_ref</p>";
            $stmt->close();
        }

        // Update Status
        if (isset($_POST['update_status'])) {
            $job_ref = clean($_POST['status_job_ref']);
            $status = clean($_POST['new_status']);
            $stmt = $conn->prepare("UPDATE EOI SET status=? WHERE job_reference_number=?");
            $stmt->bind_param("ss", $status, $job_ref);
            $stmt->execute();
            echo "<p>Status updated for job reference: $job_ref</p>";
            $stmt->close();
        }

        $conn->close();
        ?>
        
        <a href="logout.php">Logout</a>
    </main>

    <footer>
        <?php include "footer.inc"; ?>
    </footer>
</body>
</html>