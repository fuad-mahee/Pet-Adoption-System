<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Pet Adoption System</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="index.php">Pet Adoption System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_approval.php">Manage Adoption Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_pet_shelter.php">Manage Pet Shelter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_view_pets.php"> Pets Available for Adoption</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_adopted_pets.php">Adopted Pets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_lost_pets.php">Lost Pets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
