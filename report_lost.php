<?php
session_start();
require('db.php');
include 'user_header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user']['User_id'];

$petSql = "SELECT p.Pet_id, p.Name FROM OwnedPets op 
           JOIN Pet p ON op.Pet_id = p.Pet_id 
           LEFT JOIN Reports r ON p.Pet_id = r.Pet_id 
           LEFT JOIN LostAndFound lf ON r.Report_id = lf.Report_id AND lf.Status = 'Lost'
           WHERE op.User_id = '$userId' AND lf.Report_id IS NULL";
$petResult = $conn->query($petSql);

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $reportDate = date('Y-m-d');
    $status = 'Lost'; 
    $petId = $_POST['pet_id']; 

    $checkLostSql = "SELECT * FROM LostAndFound lf 
                     JOIN Reports r ON lf.Report_id = r.Report_id 
                     WHERE r.Pet_id = '$petId' AND lf.Status = 'Lost'";
    $lostResult = $conn->query($checkLostSql);

    if ($lostResult->num_rows > 0) {
        $message = "<div class='alert alert-warning'>This pet is already registered as lost.</div>";
    } else {
        $checkPetSql = "SELECT * FROM OwnedPets WHERE Pet_id = '$petId' AND User_id = '$userId'";
        $result = $conn->query($checkPetSql);

        if ($result->num_rows == 0) {
            $message = "<div class='alert alert-danger'>Error: The pet is not in your adopted pet list.</div>";
        } else {
            $sql = "INSERT INTO LostAndFound (Status, ReportDate, Description) VALUES ('$status', '$reportDate', '$description')";

            if ($conn->query($sql) === TRUE) {
                $reportId = $conn->insert_id;
                $sql_report = "INSERT INTO Reports (User_id, Report_id, Pet_id) VALUES ('$userId', '$reportId', '$petId')";
                if ($conn->query($sql_report) === TRUE) {
                    $message = "<div class='alert alert-success'>Report submitted successfully</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Error: " . $sql_report . "<br>" . $conn->error . "</div>";
                }
            } else {
                $message = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
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
    <title>Report Lost Pet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Report Lost Pet</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <?php echo $message; ?>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="pet_id" class="form-label">Select Pet</label>
                                <select class="form-control" id="pet_id" name="pet_id" required>
                                    <option value="" disabled selected>Select your pet</option>
                                    <?php
                                    if ($petResult->num_rows > 0) {
                                        while ($petRow = $petResult->fetch_assoc()) {
                                            echo "<option value='" . $petRow['Pet_id'] . "'>" . $petRow['Name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No pets found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark">Submit Report</button>
                        </form>
                        <div class="mt-4">
                            <label class="form-label">Did you find your pet?</label><a href="foundpet.php" class="btn btn-link">Click here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9BAMuZFt4L9jJ3TOdV9H87FMRIMe0VB8ne78FqF4E2AflA4auD0C" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pprnO/0f8zU1jHYo5LtVd8F2C4smFQ3tQY/4gygQ6U9A3/M7/Tz7E9w0f2dMzX+j" crossorigin="anonymous"></script>
</body>
</html>
