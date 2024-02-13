<?php

@include('sep/php/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $username = $_POST['username'];

    $existing_username = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $existing_username);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">Username already exists. Please choose a different one.</div>';
    } else {
        if (empty($_POST['id'])) {
            $query = "INSERT INTO `users` (`name`, `username`) VALUES ('$user', '$username')";
            if (mysqli_query($conn, $query)) {
                echo '<div class="alert alert-primary" role="alert">User inserted successfully.</div>';
            }
        } else {
            $id = $_POST['id'];
            $query = "UPDATE `users` SET `name`='$user', `username`='$username' WHERE `id`='$id'";
            if (mysqli_query($conn, $query)) {
                echo '<div class="alert alert-primary" role="alert">User updated successfully.</div>';
            }
        }
    }
}


