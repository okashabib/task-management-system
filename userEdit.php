<?php
include('sep/php/connection.php');
$select = $conn->query("SELECT * FROM `users` WHERE `id`=1");
$users = $conn->query("SELECT * FROM `users`");
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

                                <?php

                                if ($select) {
                                    while ($row = $select->fetch_assoc()) {
                                        $name = $row['name'];
                                        $username = $row['username'];
                                        ?>
                                        <form class="modal-body" method="POST" id="userForm">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="Enter user" name="user" required value="<?php echo $name; ?>">
                                                <label for="floatingInput">Enter user</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input type="text" class="form-control" name="username" placeholder="Username"
                                                    aria-label="Username" aria-describedby="basic-addon1" required
                                                    value="<?php echo $username; ?>">
                                            </div>

                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="submit"
                                                    name='submit'>Submit</button>
                                                <div class="spinner-border" id="loader" style="display: none;" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    if ($users) {
                                        while ($row = $users->fetch_assoc()) {
                                            $name = $row['name'];
                                            $username = $row['username'];

                                            ?>
                                            <tr class="user-data">
                                                <td>
                                                    <?php echo $i++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $username; ?>
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
                    $('#loader').hide();
                    $('#submit').show();
                    console.log('user added successfully');
                    $('#res').html(response);

                    $('#userForm')[0].reset();
                    $('#staticBackdrop').modal('hide');
                }
            });
        });
    </script>

    <script>
        $('table').click(function (e) {
            e.preventDefault();

            $('#staticBackdrop').modal('show');
        })
    </script>
</body>

</html>