<?php
include 'homeheader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pet Adoption System</title>
    <style>
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .background-box {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="position-relative overflow-hidden">
        <div class="d-flex min-vh-100" lc-helper="video-bg">
            <video style="z-index:1; object-fit: cover; object-position: 50% 50%;" class="position-absolute w-100 min-vh-100" autoplay="" preload="" muted="" loop="" playsinline="">
                <source src="Sequence.mp4" type="video/mp4">
            </video>
            <div style="z-index:2" class="align-self-center text-center text-light col-md-8 offset-md-2">
                <div class="background-box mb-4">
                    <div class="lc-block">
                        <div editable="rich">
                            <h1 class="display-1 fw-bolder text-shadow">A Loving Home Awaits</h1>
                        </div>
                    </div>
                    <div class="lc-block">
                        <div editable="rich">
                            <p class="lead text-shadow">Here, we’re dedicated to finding loving families for pets in need.</p>
                            <p class="lead text-shadow">Together, let’s create a brighter future for these wonderful pets!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
