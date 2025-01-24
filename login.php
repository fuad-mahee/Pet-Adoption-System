<?php
session_start();
require('db.php');
include 'homeheader.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $adminSql = "SELECT * FROM admin WHERE Email = '$email' AND Password = '$password'";
    $adminResult = $conn->query($adminSql);
    if ($adminResult->num_rows > 0) {
        $_SESSION['admin'] = $adminResult->fetch_assoc();
        header('Location: admin_approval.php');
        exit;
    }

    $userSql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password'";
    $userResult = $conn->query($userSql);
    if ($userResult->num_rows > 0) {
        $_SESSION['user'] = $userResult->fetch_assoc();
        header('Location: my_pets.php');
        exit;
    }
    
    $error = "Invalid login credentials";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card" style="width: 400px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Login</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                </form>
                <a href="register.php" class="d-block text-center mt-3">Don't have an account? Register here</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
