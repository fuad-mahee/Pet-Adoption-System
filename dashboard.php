<?php
session_start();
require('db.php');

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Fetch user info
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 2rem;
        }
        .dashboard-header {
            margin-bottom: 2rem;
        }
        .dashboard-header h1 {
            margin-bottom: 1rem;
        }
        .dashboard-header a {
            display: block;
            margin-bottom: 1rem;
        }
        .btn-logout {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header text-center">
            <h1>Welcome, <?php echo htmlspecialchars($user['Name']); ?></h1>
            <h2>Dashboard</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="my_pets.php" class="btn btn-primary w-100">View My Adopted Pets</a>
                </li>
                <li class="list-group-item">
                    <a href="adopt_pet.php" class="btn btn-primary w-100">View Available Pets for Adoption</a>
                </li>
                <li class="list-group-item">
                    <a href="report_lost.php" class="btn btn-primary w-100">Report a Lost Pet</a>
                </li>
                <li class="list-group-item">
                    <a href="lostpets.php" class="btn btn-primary w-100">View Lost Pets</a>
                </li>
                <li class="list-group-item">
                    <a href="pet_shelter.php" class="btn btn-primary w-100">View Our Pet Shelters</a>
                </li>
            </ul>
            <a href="logout.php" class="btn btn-danger btn-logout w-100">Logout</a>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
