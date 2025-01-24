<?php
session_start();
require('db.php');
include 'admin_header.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$sql_retrieve = "SELECT LostAndFound.Report_id, LostAndFound.Status, LostAndFound.ReportDate, LostAndFound.Description, Reports.Pet_id 
                 FROM LostAndFound 
                 JOIN Reports ON LostAndFound.Report_id = Reports.Report_id
                 WHERE LostAndFound.Status = 'Lost'";
$result = $conn->query($sql_retrieve);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lost Pets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Lost Pets</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Status</th>
                        <th>Report Date</th>
                        <th>Description</th>
                        <th>Report ID</th>
                        <th>Pet ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['Status'] . "</td>
                                    <td>" . $row['ReportDate'] . "</td>
                                    <td>" . $row['Description'] . "</td>
                                    <td>" . $row['Report_id'] . "</td>
                                    <td>" . $row['Pet_id'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No lost pet reports found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
