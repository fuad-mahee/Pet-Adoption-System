<?php
session_start();
require('db.php');
include 'admin_header.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$sql = "SELECT adoptionapplication.Application_id, adoptionapplication.ApplicationDate, adoptionapplication.Status, 
               user.Name AS userName, pet.Name AS petName
        FROM adoptionapplication 
        LEFT JOIN user ON adoptionapplication.User_id = user.User_id 
        LEFT JOIN pet ON adoptionapplication.Pet_id = pet.Pet_id
        WHERE adoptionapplication.Status = 'Pending'
        ORDER BY adoptionapplication.Application_id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Adoption Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text mb-4">Pending Adoption Applications</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>User Name</th>
                    <th>Pet Name</th>
                    <th>Application Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Application_id']; ?></td>
                    <td><?php echo $row['userName']; ?></td>
                    <td><?php echo $row['petName']; ?></td>
                    <td><?php echo $row['ApplicationDate']; ?></td>
                    <td>
                        <form method="POST" action="admin_action.php" class="d-inline">
                            <input type="hidden" name="application_id" value="<?php echo $row['Application_id']; ?>">
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
