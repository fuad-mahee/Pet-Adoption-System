<?php
session_start();
require('db.php');
include 'user_header.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
$user_id = $user['User_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Adopted Pets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">My Adopted Pets</h1>

        <div class="row">
            <?php
            $myPetsSql = "SELECT Pet.Pet_id, Pet.Name, Pet.Breed, Pet.Age, Pet.Type,Pet.Image_url, OwnedPets.ApprovalDate 
                        FROM Pet 
                        INNER JOIN OwnedPets ON Pet.Pet_id = OwnedPets.Pet_id 
                        WHERE OwnedPets.User_id = $user_id";
            $myPetsResult = $conn->query($myPetsSql);

            if ($myPetsResult->num_rows > 0) {
                while ($myPet = $myPetsResult->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card shadow-sm">';
                    echo '<div class="card-body">';
                    echo '<img src="http://localhost/pet3' . $myPet['Image_url'] . '" alt="Picture of ' . $myPet['Name'] . '" class="img-fluid mb-3" style="height: 200px; object-fit: cover;">';

                    echo '<h4 class="card-title">' . $myPet['Name'] . '</h4>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">Pet ID: ' . $myPet['Pet_id'] . '</h6>';
                    echo '<p class="card-text"><strong>Breed:</strong> ' . $myPet['Breed'] . '</p>';
                    echo '<p class="card-text"><strong>Age:</strong> ' . $myPet['Age'] . '</p>';
                    echo '<p class="card-text"><strong>Type:</strong> ' . $myPet['Type'] . '</p>';
                    echo '<p class="card-text"><strong>Adopted On:</strong> ' . $myPet['ApprovalDate'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-info" role="alert">You haven\'t adopted any pets yet.</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
