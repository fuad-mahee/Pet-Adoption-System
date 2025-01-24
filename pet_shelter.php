<?php
session_start();
require('db.php');
include 'user_header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = [];
}

$user = $_SESSION['user'];
$user_id = $user['User_id'];

$ownedPetsSql = "SELECT p.Pet_id, p.Name FROM ownedpets op JOIN pet p ON op.Pet_id = p.Pet_id WHERE op.User_id = $user_id";
$ownedPetsResult = $conn->query($ownedPetsSql);

$sql = "SELECT * FROM petshelter";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_to_shelter'])) {
    $shelter_id = $_POST['shelter_id'];
    $pet_id = $_POST['pet_id'];

    $sql0 = "SELECT * FROM ownedpets WHERE Pet_id = $pet_id AND User_id = $user_id";
    $result0 = $conn->query($sql0);

    if ($result0->num_rows > 0) {
        $checkQuery = "SELECT * FROM shelters WHERE Pet_id = $pet_id";
        $result1 = $conn->query($checkQuery);

        if ($result1->num_rows > 0) {
            $_SESSION['message']['error'] = "Pet already in shelter.";
        } else {

            $pet_type_query = "SELECT Type FROM pet WHERE Pet_id = $pet_id";
            $pet_type_result = $conn->query($pet_type_query);
            $pet_type_row = $pet_type_result->fetch_assoc();
            $pet_type = $pet_type_row['Type'];

            $shelter_query = "SELECT ShelterSeat, ShelterType FROM petshelter WHERE Listing_id = $shelter_id";
            $shelter_result = $conn->query($shelter_query);
            $shelter_row = $shelter_result->fetch_assoc();

            if ($shelter_row) {
                $shelter_seat = $shelter_row['ShelterSeat'];
                $shelter_type = $shelter_row['ShelterType'];

                if ($shelter_seat > 0 && $shelter_type === $pet_type) {

                    $insert_query = "INSERT INTO shelters (Listing_id, Pet_id) VALUES ($shelter_id, $pet_id)";
                    $conn->query($insert_query);

                    $update_seat_query = "UPDATE petshelter SET ShelterSeat = ShelterSeat - 1 WHERE Listing_id = $shelter_id";
                    $conn->query($update_seat_query);

                    $_SESSION['message']['success'] = "Pet successfully added to the shelter and seat count updated.";
                } else {
                    $_SESSION['message']['error'] = "Shelter seat is not available or shelter type does not match pet type.";
                }
            } else {
                $_SESSION['message']['error'] = "Shelter not found.";
            }
        }
    } else {
        $_SESSION['message']['error'] = "Pet ID $pet_id is not owned by you.";
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $pet_id = $_POST['pet_id'];
    $sql299 = "SELECT Listing_id FROM shelters WHERE Pet_id = $pet_id";
    $result299 = $conn->query($sql299);
    $row = $result299->fetch_assoc();
    $shelter_id = $row['Listing_id'];
    $sql213 = "DELETE FROM shelters WHERE Pet_id = $pet_id AND Listing_id = $shelter_id";

    if ($conn->query($sql213) === TRUE) {
        $_SESSION['message']['success'] = "Pet removed from the shelter.";
        $sql314 = "UPDATE petshelter SET ShelterSeat = ShelterSeat + 1 WHERE Listing_id = $shelter_id";
        $conn->query($sql314);
    } else {
        $_SESSION['message']['error'] = "Error: " . $sql213 . "<br>" . $conn->error;   
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

$sql133 = "SELECT p.Pet_id, p.Name, s.Listing_id AS Shelter_id
           FROM ownedpets op
           JOIN pet p ON op.Pet_id = p.Pet_id
           JOIN shelters s ON s.Pet_id = p.Pet_id
           WHERE op.User_id = $user_id";
$result133 = $conn->query($sql133);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shelters</title>
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

        <?php if (isset($_SESSION['message']['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
        unset($_SESSION['message']['success']);
        endif; ?>
        
        <?php if (isset($_SESSION['message']['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
        unset($_SESSION['message']['error']); 
        endif; ?>

        <h2 class="mb-4">Pet Shelters</h2>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Shelter ID</th>
                        <th>Property Name</th>
                        <th>Address</th>
                        <th>Pet Policy</th>
                        <th>Shelter Type</th>
                        <th>Seats Available</th>
                        <th>Contact Information</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Listing_id']; ?></td>
                        <td><?php echo $row['PropertyName']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['PetPolicy']; ?></td>
                        <td><?php echo $row['ShelterType']; ?></td>
                        <td><?php echo $row['ShelterSeat']; ?></td>
                        <td><?php echo $row['ContactInformation']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <h2>Send to Shelter</h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="shelter_id" class="form-label">Shelter ID:</label>
                    <input type="number" id="shelter_id" name="shelter_id" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pet_id" class="form-label">Select Pet:</label>
                    <select name="pet_id" id="pet_id" class="form-select" required>
                        <option value="">Choose your pet</option>
                        <?php while ($pet = $ownedPetsResult->fetch_assoc()): ?>
                            <option value="<?php echo $pet['Pet_id']; ?>"><?php echo $pet['Name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" name="send_to_shelter" class="btn btn-primary">Send</button>
            </form>
        </div>
        
        <div>
            <h2>Get From Shelter</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Pet Name</th>
                            <th>Pet ID</th>
                            <th>Shelter ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result133->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Pet_id']; ?></td>
                            <td><?php echo $row['Shelter_id']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9BAMuZFt4L9jJ3TOdV9H87FMRIMe0VB8ne78FqF4E2AflA4auD0C" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pprnO/0f8zU1jHYo5LtVd8F2C4smFQ3tQY/4gygQ6U9A3/M7/Tz7E9w0f2dMzX+j" crossorigin="anonymous"></script>
</body>
</html>
