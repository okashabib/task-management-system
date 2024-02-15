<?php
@include('sep/php/connection.php');

$select = $conn->query("SELECT * FROM `users`");
?>

<!DOCTYPE html>
<html lang="en">

<?php @include 'sep/header.html'; ?>

<body class="sb-nav-fixed">
    <?php @include 'sep/navBar.html'; ?>

    <div id="layoutSidenav">
        <?php @include 'sep/sideBar.html'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>

                    <div class="d-flex justify-content-end p-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" data-bs-whatever="@mdo">Add User</button>
                    </div>

                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create user</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form class="modal-body" method="POST" id="userForm">

                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="id" id="userId">
                                        <input type="text" class="form-control" id="floatingInputName"
                                            placeholder="Enter user" name="user" required>
                                        <label for="floatingInput">Enter Name</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                        <input type="text" class="form-control" name="username" id="userName"
                                            placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"
                                            required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="submit"
                                            name='submit'>Submit</button>
                                        <div class="spinner-border" id="loader" style="display: none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4" id="dataTable">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Users List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="userData">
                                    <?php

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
                                                    <button onclick="deleteRow(this, <?= $id ?>)" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                    <button onclick="editRow(<?= $id ?>)" class="btn btn-primary editRow"><i
                                                            class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php @include 'sep/footer.html'; ?>
        </div>
    </div>

    <script>

        $('#userForm').submit(function (e) {
            e.preventDefault();

            $('#submit').hide();
            $('#loader').show();

            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: 'userData.php',
                data: formData,
                success: function (response) {
                    let responseObj = JSON.parse(response);
                    let result = responseObj.error || responseObj.message;
                    let resEmoji = responseObj.error ? '✗ ' : '✓ ';
                    let toastColor = responseObj.error ? 'linear-gradient(to right, red, orangered)' : 'linear-gradient(to right, #04364A, black)';

                    Toastify({
                        text: resEmoji + result,
                        duration: 4000,
                        stopOnFocus: true,
                        position: "center",
                        style: {
                            background: toastColor,
                            borderRadius: "10px",
                        },
                        offset: {
                            y: 50
                        },
                    }).showToast();

                    $('#loader').hide();
                    $('#submit').show();
                    $('#userForm')[0].reset();
                    $('#userId').val('');
                    $('#staticBackdrop').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#dataTable').load(location.href + ' #dataTable');
                }
            });
        });

        function editRow(id) {
            $.ajax({
                method: 'GET',
                url: './getUser.php',
                data: { id: id },
                success: function (res) {
                    let userModal = JSON.parse(res);
                    console.log(userModal);

                    $('#userId').val(userModal.id);
                    $('#floatingInputName').val(userModal.name);
                    $('#userName').val(userModal.username);

                    $('#staticBackdrop').modal('show');
                },
            });
        }

        function deleteRow(button, id) {
            $.ajax({
                method: 'GET',
                url: './deleteUser.php',
                data: { id: id },
                success: function (res) {
                    console.log(res);
                    let message = JSON.parse(res).message;

                    Toastify({
                        text: message,
                        duration: 4000,
                        stopOnFocus: true,
                        position: 'center',
                        style: {
                            background: "linear-gradient(to right, red, orangered)",
                            borderRadius: "10px",
                        },
                        offset: {
                            y: 50
                        },
                    }).showToast();
                    $(button).closest('tr').remove();
                }
            })
        }

        $('#staticBackdrop').on('hidden.bs.modal', function () {
            $('#userForm')[0].reset();
            $('#userId').val('');
        });

    </script>

</body>

</html>
