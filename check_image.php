<?php
$directory = 'images/'; 

if (is_dir($directory)) {
    echo "Directory '$directory' exists.<br>";
    $files = scandir($directory);
    
    echo "Files in '$directory':<br>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<img src='$directory$file' alt='$file' style='width:100px;'><br>";
        }
    }
} else {
    echo "Directory '$directory' does not exist.";
}
?>
