<?php
session_start();
require('db.php');
include 'user_header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user']['User_id'];

$petSql = "SELECT p.Pet_id, p.Name FROM LostAndFound lf 
           JOIN Reports r ON lf.Report_id = r.Report_id 
           JOIN Pet p ON r.Pet_id = p.Pet_id 
           WHERE r.User_id = '$userId' AND lf.Status = 'Lost'";
$petResult = $conn->query($petSql);

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $petId = $_POST['pet_id'];

    $retrieveReportIdSql = "SELECT Report_id FROM Reports WHERE Pet_id = '$petId' AND User_id = '$userId'";
    $reportResult = $conn->query($retrieveReportIdSql);

    if ($reportResult->num_rows > 0) {
        $reportRow = $reportResult->fetch_assoc();
        $reportId = $reportRow['Report_id'];

        $updateFoundSql = "UPDATE LostAndFound SET Status = 'Found' WHERE Report_id = '$reportId'";
        if ($conn->query($updateFoundSql) === TRUE) {

            $deleteReportSql = "DELETE FROM Reports WHERE Report_id = '$reportId'";
            if ($conn->query($deleteReportSql) === TRUE) {
                $message = "<div class='alert alert-success'>The pet has been marked as found, and the report has been closed.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Error deleting report: " . $conn->error . "</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Error updating lost pet status: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Error: No matching report found or you do not have permission to update this report.</div>";
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
    <title>Report Found Pet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Report Found Pet</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <?php echo $message; ?>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="pet_id" class="form-label">Select Pet</label>
                                <select class="form-control" id="pet_id" name="pet_id" required>
                                    <option value="" disabled selected>Select your lost pet</option>
                                    <?php
                                    if ($petResult->num_rows > 0) {
                                        while ($petRow = $petResult->fetch_assoc()) {
                                            echo "<option value='" . $petRow['Pet_id'] . "'>" . $petRow['Name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No lost pets found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9BAMuZFt4L9jJ3TOdV9H87FMRIMe0VB8ne78FqF4E2AflA4auD0C" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pprnO/0f8zU1jHYo5LtVd8F2C4smFQ3tQY/4gygQ6U9A3/M7/Tz7E9w0f2dMzX+j" crossorigin="anonymous"></script>
</body>
</html>
