<?php
session_start();
require('db.php');
include 'user_header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;  
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pet_id = $_POST['pet_id'];
    $user_id = $_SESSION['user']['User_id'];
    $applicationDate = date('Y-m-d');

    $sql = "INSERT INTO adoptionapplication (ApplicationDate, User_id, Pet_id, Status) VALUES ('$applicationDate', $user_id, $pet_id, 'Pending')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Application submitted successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> " . $conn->error . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}

$sql = "
    SELECT DISTINCT p.Pet_id, p.Name, p.Type, p.Breed, p.Age, p.Image_url, 
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

if (!$result) {
    die("Query failed: " . $conn->error); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Pet Adoption</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 5rem;
        }
        .btn-apply {
            background: #2e3236;
            color: white;
            border: none;
            border-radius: 0.5rem;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .btn-apply:hover {
            background: #009b77;
            transform: scale(1.05);
        }
        .alert {
            margin-top: 2rem;
        }
        .btn-close {
            filter: invert(1);
        }
        h2 {
            color: rgb(33, 37, 41);
            font-weight: bold;
        }
        .pet-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .card-body {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Available Pets for Adoption</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="http://localhost/pet3<?php echo $row['Image_url']; ?>" 
                             alt="Picture of <?php echo $row['Name']; ?>" 
                             class="pet-image mb-3">
                        <h4 class="card-title mb-3"><?php echo $row['Name']; ?></h4>
                        <p class="card-subtitle mb-2"><strong>Type:</strong> <?php echo $row['Type']; ?></p>
                        <p class="card-text mb-2"><strong>Breed:</strong> <?php echo $row['Breed']; ?></p>
                        <p class="card-text mb-2"><strong>Age:</strong> <?php echo $row['Age']; ?></p>
                        <form method="POST" action="adopt_pet.php">
                            <input type="hidden" name="pet_id" value="<?php echo $row['Pet_id']; ?>">
                            <button type="submit" class="btn btn-dark">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

