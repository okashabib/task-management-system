<?php

include('sep/php/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $assign = mysqli_real_escape_string($conn, $_POST['assign']);

    if (empty($id)) {
        $query = "INSERT INTO `create_task` (title, description, status_id, start_date, end_date, user_id) VALUES ('$title', '$description', '$status', '$start_date', '$end_date', '$assign')";
        $message = 'Task added successfully';
    } else {
        $query = "UPDATE `create_task` SET `title`='$title', `description`='$description', `start_date`='$start_date', `end_date`='$end_date', `status_id`='$status', `user_id`='$assign' WHERE `id`='$id'";
        $message = 'Task updated successfully';
    }

    if (mysqli_query($conn, $query)) {
        $response['message'] = $message;
    } else {
        $response['message'] = 'Error: ' . mysqli_error($conn);
    }
    echo json_encode($response);
}
