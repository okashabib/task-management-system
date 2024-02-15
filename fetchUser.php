<?php
@include('sep/php/connection.php');

$select = $conn->query("SELECT * FROM `users`");
$i = 1;
if ($select) {
    while ($row = $select->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $username = $row['username'];

        ?>
        <tr class="data-tr" id="<?php echo $id ?>">
            <td>
                <?php echo $i++; ?>
            </td>
            <td>
                <?php echo $name; ?>
            </td>
            <td>
                <?php echo $username; ?>
            </td>
            <td>
                <button onclick="deleteRow(this, <?= $id ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                <button onclick="editRow(<?= $id ?>)" class="btn btn-primary editRow"><i class="fas fa-edit"></i></button>
            </td>
        </tr>

        <?php
    }
}
?>