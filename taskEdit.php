<?php
include('sep/php/connection.php');
$select = $conn->query("SELECT * FROM `create_task` WHERE `id`=1");
$users = $conn->query("SELECT * FROM `users`");
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'sep/header.html'; ?>

<body class="sb-nav-fixed">
    <?php include 'sep/navBar.html'; ?>

    <div id="layoutSidenav">
        <?php include 'sep/sideBar.html'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Modal</h1>
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item active">Modal</li>
                    </ol>

                    <div class="d-flex justify-content-end p-1 mb-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" data-bs-whatever="@mdo">Add task</button>
                    </div>

                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Task</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form class="modal-body" method="POST" id="taskForm">
                                    <?php
                                    if ($select) {
                                        while ($row = $select->fetch_assoc()) {
                                            $title = $row['title'];
                                            $description = $row['description'];
                                            $start_date = $row['start_date'];
                                            $end_date = $row['end_date'];
                                            $status = $row['status'];
                                            $assign = $row['assign'];
                                            ?>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="enter title" name="title" required
                                                    value="<?php echo $title; ?>">
                                                <label for="floatingInput">Title</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" placeholder="Leave a comment here"
                                                    id="floatingTextarea" name='description'
                                                    required><?php echo $description; ?></textarea>
                                                <label for="floatingTextarea">Description</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="startDate"
                                                            placeholder="Start Date" name="start_date" required
                                                            value="<?php echo $start_date; ?>">
                                                        <label for="startDate">Start Date</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="endDate"
                                                            placeholder="End Date" name="end_date" required
                                                            value="<?php echo $end_date; ?>">
                                                        <label for="endDate">End Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelect"
                                                            aria-label="Floating label select example" name='status' required>
                                                            <option value="<?php echo $status; ?>">
                                                                <?php echo $status; ?>
                                                            </option>
                                                            <option value="Todo">Todo</option>
                                                            <option value="Progress">Progress</option>
                                                            <option value="UAT">UAT</option>
                                                            <option value="Done">Done</option>
                                                        </select>
                                                        <label for="floatingSelect">Status</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelectAssign"
                                                            aria-label="Floating label select example" name='assign' required>
                                                            <!-- <option value="" disabled selected>Select user</option> -->
                                                            <option value='<?php echo $assign; ?>'>
                                                                <?php echo $assign; ?>
                                                            </option>
                                                            <?php
                                                            if ($users) {
                                                                while ($row = $users->fetch_assoc()) {
                                                                    $name = $row['name'];
                                                                    ?>
                                                                    <option value='<?php echo $name; ?>'>
                                                                        <?php echo $name; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "error Assign";
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="floatingSelectAssign">Assign</label>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php }
                                    } else {
                                        echo 'Data not found';
                                    }
                                    ?>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="submit"
                                            name='submit'>Update</button>
                                        <div class="spinner-border" id="loader" style="display: none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('sep/footer.html'); ?>
        </div>
    </div>
</body>

</html>