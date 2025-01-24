<?php
session_start();
require('db.php');
include 'user_header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$sql_retrieve = "SELECT LostAndFound.Report_id, LostAndFound.Status, LostAndFound.ReportDate, 
                 LostAndFound.Description, Reports.Pet_id, Pet.Name 
                 FROM LostAndFound 
                 JOIN Reports ON LostAndFound.Report_id = Reports.Report_id
                 JOIN Pet ON Reports.Pet_id = Pet.Pet_id
                 WHERE LostAndFound.Status = 'Lost'";
$result = $conn->query($sql_retrieve);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 3rem;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Lost Reports</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Pet Name</th> 
                        <th>Report Date</th>
                        <th>Description</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['Name'] . "</td>  
                                    <td>" . $row['ReportDate'] . "</td>
                                    <td>" . $row['Description'] . "</td>

                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No reports found</td></tr>"; 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9BAMuZFt4L9jJ3TOdV9H87FMRIMe0VB8ne78FqF4E2AflA4auD0C" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pprnO/0f8zU1jHYo5LtVd8F2C4smFQ3tQY/4gygQ6U9A3/M7/Tz7E9w0f2dMzX+j" crossorigin="anonymous"></script>
</body>
</html>
