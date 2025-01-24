<?php
session_start();
require('db.php');

// Check if user is logged in and is an admin
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

// Fetch all adoption applications with user and pet details
$sql = "SELECT adoptionapplication.Application_id, adoptionapplication.ApplicationDate, adoptionapplication.Status, 
               user.Name AS userName, pet.Name AS petName
        FROM adoptionapplication 
        LEFT JOIN user ON adoptionapplication.User_id = user.User_id 
        LEFT JOIN pet ON adoptionapplication.Pet_id = pet.Pet_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-dashboard {
            max-width: 1200px;
            margin: 2% auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .admin-dashboard h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
        }
        .table tbody tr {
            transition: background-color 0.3s;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <h2>Adoption Applications</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>User Name</th>
                    <th>Pet Name</th>
                    <th>Application Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Application_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['userName']); ?></td>
                    <td><?php echo htmlspecialchars($row['petName']); ?></td>
                    <td><?php echo htmlspecialchars($row['ApplicationDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['Status']); ?></td>
                    <td>
                        <?php if ($row['Status'] == 'Pending'): ?>
                        <!-- Form to approve or reject the application -->
                        <form method="POST" action="admin_action.php" class="d-inline">
                            <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($row['Application_id']); ?>">
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
