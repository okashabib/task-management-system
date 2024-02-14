<?php

include('sep/php/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = $conn->query("DELETE FROM `users` WHERE `id`= $id");

    if ($select === TRUE) {
        echo json_encode(array("message" => "User deleted successfully"));
    } else {
        echo json_encode(array("error" => $conn->error));
    }
}

?>