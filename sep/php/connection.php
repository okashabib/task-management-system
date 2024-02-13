<?php

$conn = mysqli_connect('localhost', 'root', '', 'tms');
if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">Connection failed: ' . $conn->connect_error . '</div>');
}
// echo '<div class="alert alert-primary mb-10" role="alert">DataBase Connected successfully</div>';