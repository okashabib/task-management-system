<?php

include('sep/php/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $username = $_POST['username'];
    $id = $_POST['id'];

    $existing_username_query = "SELECT * FROM users WHERE username ='$username' AND id != '$id'";
    $existing_username_result = mysqli_query($conn, $existing_username_query);

    $message = empty($id) ? 'User inserted successfully' : 'User updated succesfully';

    if (mysqli_num_rows($existing_username_result) > 0) {
        echo json_encode(array('error' => 'Username already exists. Please choose a different one!'));
    } else {
        $query = empty($id) ? "INSERT INTO `users` (`name`, `username`) VALUES ('$user', '$username')" : "UPDATE `users` SET `name`='$user', `username`='$username' WHERE `id`='$id'";
        if (mysqli_query($conn, $query)) {
            echo json_encode(array('success' => true, 'message' => $message));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error :' . mysqli_error($conn)));
        }
    }
}

?>