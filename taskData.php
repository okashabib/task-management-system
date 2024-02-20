<?php

@include('sep/php/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $assign = mysqli_real_escape_string($conn, $_POST['assign']);

    $query = empty($id) ? "INSERT INTO `create_task` (title, description, status_id, start_date, end_date, user_id) VALUES ('$title', '$description', '$status', '$start_date', '$end_date', '$assign')" : "UPDATE `create_task` SET `title`='$title', `description`='$description', `start_date`='$start_date', `end_date`='$end_date', `status_id`='$status', `user_id`='$assign' WHERE `id`='$id'";
    $message = empty($id) ? 'Task added successfully' : 'Task updated succesfully';

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => $message]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
    }
}
