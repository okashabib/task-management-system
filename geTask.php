<?php

include('sep/php/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM `create_task` WHERE `id`= $id");
    $taskData = $select->fetch_assoc();

    echo json_encode($taskData);
}

?>