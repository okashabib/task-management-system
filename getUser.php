<?php

include('sep/php/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM `users` WHERE `id`= $id");
    $userData = $select->fetch_assoc();

    echo json_encode($userData);
}

?>