<?php
session_start();
require('db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}

if (isset($_POST['application_id'])) {
    $application_id = $_POST['application_id'];
} else {
    $application_id = '';
}

if ($action == 'approve') {
    $new_status = 'Approved';
    $sql1 = "SELECT User_id, Pet_id FROM adoptionapplication WHERE Application_id = $application_id";
    $result = $conn->query($sql1);
    $row = $result->fetch_assoc();
    $user_id = $row['User_id'];
    $pet_id = $row['Pet_id'];
    $sql2 = "INSERT INTO ownedpets (User_id, Pet_id, ApprovalDate) VALUES ($user_id, $pet_id, CURDATE())";
    $sql3 = "UPDATE pet SET AdoptionStatus = 1 WHERE Pet_id = $pet_id";
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);


} elseif ($action == 'reject') {
    $new_status = 'Rejected';
} else {
    echo "Invalid action.";
    exit;
}

$sql = "UPDATE adoptionapplication SET Status = '$new_status' WHERE Application_id = $application_id";

if ($conn->query($sql) === TRUE) {
    echo "Application status updated successfully.";
} else {
    echo "Error updating status: " . $conn->error;
}
header('Location: admin_approval.php');
exit;
?>
