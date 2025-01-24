<?php
session_start();
require('db.php');
include 'admin_header.php';

if (!isset($_SESSION['admin'])) { 
    header('Location: login.php');
    exit;
}

$sql = "SELECT s.Listing_id, p.Pet_id, p.Name, ps.ShelterType, ps.ShelterSeat, ps.PropertyName, ps.ContactInformation
        FROM shelters s
        JOIN pet p ON s.Pet_id = p.Pet_id
        JOIN petshelter ps ON s.Listing_id = ps.Listing_id";

$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retrieve_pet'])) {
    $pet_id = $_POST['pet_id'];
    $shelter_id = $_POST['shelter_id'];


    $sql_remove = "DELETE FROM shelters WHERE Pet_id = $pet_id";
    if ($conn->query($sql_remove) === TRUE) {
        $sql_update = "UPDATE petshelter SET ShelterSeat = ShelterSeat + 1 WHERE Listing_id = $shelter_id";
        $conn->query($sql_update);
        $_SESSION['message'] = "Pet successfully retrieved from shelter.";
    } else {
        $_SESSION['error'] = "Failed to retrieve pet.";
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Pet Shelter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Manage Pet Shelter</h2>

        <?php if (isset($_SESSION['message'])): ?>
         <?php if (isset($_SESSION['message']) && is_string($_SESSION['message'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
<?php endif; ?>

        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Shelter ID</th>
                    <th>Pet ID</th>
                    <th>Pet Name</th>
                    <th>Shelter Type</th>
                    <th>Seats Available</th>
                    <th>Property Name</th>
                    <th>Contact Information</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Listing_id']; ?></td>
                    <td><?php echo $row['Pet_id']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['ShelterType']; ?></td>
                    <td><?php echo $row['ShelterSeat']; ?></td>
                    <td><?php echo $row['PropertyName']; ?></td>
                    <td><?php echo $row['ContactInformation']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="pet_id" value="<?php echo $row['Pet_id']; ?>">
                            <input type="hidden" name="shelter_id" value="<?php echo $row['Listing_id']; ?>">
                            <button type="submit" name="retrieve_pet" class="btn btn-primary">Retrieve Pet</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>
