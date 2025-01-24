<?php
session_start();
require('db.php');
include 'admin_header.php';
$sql = "
    SELECT 
        pet.Name AS PetName,
        pet.Type AS PetType,
        pet.Breed AS PetBreed,
        user.Name AS OwnerName,
        user.Email AS OwnerEmail,
        user.ContactNumber AS OwnerContact,
        ownedpets.ApprovalDate AS AdoptionDate
    FROM ownedpets
    JOIN pet ON ownedpets.Pet_id = pet.Pet_id
    JOIN user ON ownedpets.User_id = user.User_id
    WHERE pet.AdoptionStatus = 1
    ORDER BY ownedpets.ApprovalDate DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopted Pets - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Adopted Pets List</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Pet Name</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Owner Name</th>
                    <th>Owner Email</th>
                    <th>Owner Contact</th>
                    <th>Adoption Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['PetName']; ?></td>
                            <td><?php echo $row['PetType']; ?></td>
                            <td><?php echo $row['PetBreed']; ?></td>
                            <td><?php echo $row['OwnerName']; ?></td>
                            <td><?php echo $row['OwnerEmail']; ?></td>
                            <td><?php echo $row['OwnerContact']; ?></td>
                            <td><?php echo $row['AdoptionDate']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No adopted pets found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php $conn->close(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
