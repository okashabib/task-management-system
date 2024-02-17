<?php

@include('sep/php/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $username = $_POST['username'];
    $id = $_POST['id'];

    $existing_username_query = "SELECT * FROM users WHERE username ='$username' AND id != '$id'";
    $existing_username_result = mysqli_query($conn, $existing_username_query);

    if (mysqli_num_rows($existing_username_result) > 0) {
        echo json_encode(array('error' => 'Username already exists. Please choose a different one!'));
    } else {
        $query = empty($_POST['id']) ? "INSERT INTO `users` (`name`, `username`) VALUES ('$user', '$username')" : "UPDATE `users` SET `name`='$user', `username`='$username' WHERE `id`='$id'";
        $message = mysqli_query($conn, $query) ? 'User ' . (empty($_POST['id']) ? 'inserted' : 'updated') . ' successfully.' : null;
        echo json_encode(array('message' => $message));
    }
}
