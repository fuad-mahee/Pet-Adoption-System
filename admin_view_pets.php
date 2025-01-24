<?php
session_start();
require('db.php');
include 'admin_header.php';

if (!isset($_SESSION['admin'])) { 
    header('Location: login.php');
    exit;
}

$sql = "
    SELECT DISTINCT p.Pet_id, p.Name, p.Type, p.Breed, p.Age,p.Image_url,
        aa_last.Status AS Last_Status
    FROM pet p
    LEFT JOIN (
        SELECT Pet_id, Status
        FROM adoptionapplication
        WHERE Application_id = (
            SELECT MAX(Application_id)
            FROM adoptionapplication aa2
            WHERE aa2.Pet_id = adoptionapplication.Pet_id
        )
    ) aa_last ON p.Pet_id = aa_last.Pet_id
    WHERE p.AdoptionStatus = 0
    AND (aa_last.Status IS NULL OR aa_last.Status != 'Pending');
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Available Pets for Adoption</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Available Pets for Adoption</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="http://localhost/pet3<?php echo $row['Image_url']; ?>" 
                             alt="Picture of <?php echo $row['Name']; ?>" 
                             class="img-fluid mb-3" style="height: 200px; object-fit: cover;">
                        <h4 class="card-title mb-3"><?php echo $row['Name']; ?></h4>
                        <p class="card-subtitle mb-2"><strong>Type:</strong> <?php echo $row['Type']; ?></p>
                        <p class="card-text mb-2"><strong>Breed:</strong> <?php echo $row['Breed']; ?></p>
                        <p class="card-text mb-2"><strong>Age:</strong> <?php echo $row['Age']; ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
