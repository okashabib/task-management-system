<?php

@include('sep/php/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $assign = $_POST['assign'];

    if (empty($_POST['id'])) {
        $insert_query = "INSERT INTO `create_task` (title, description, status, start_date, end_date, assign) VALUES ('$title', '$description', '$status', '$start_date', '$end_date', '$assign')";
        if (mysqli_query($conn, $insert_query)) {
            echo 'Task added successfully.';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {

        $id = $_POST['id'];
        $update_query = "UPDATE `create_task` SET `title`='$title', `description`='$description', `start_date`='$start_date',`end_date`='$end_date',`status`='$status',`assign`='$assign' WHERE `id`='$id'";
        if (mysqli_query($conn, $update_query)) {
            echo 'Task updated successfully.';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}