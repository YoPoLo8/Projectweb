<?php 
    include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./css/update-admin.css">
        <br /><br />

        <?php
        require('./database.php');
        // Get the ID of Selected Admin
        $id = $_GET['id'];  
        // Get admin details
        $res = get_from_table("admins", "id=$id");
        $rows = mysqli_fetch_assoc($res);
        ?>

        <form action="" method="POST">
            <table class="table">
                <tr>
                    <td>Full name:</td>
                    <td>
                        <input type="text" name="full_name" class="form-control" value="<?php echo $rows['full_name']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" class="form-control" value="<?php echo $rows['username']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" class="form-control" value="<?php echo $rows['email']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Phonenumber:</td>
                    <td>
                        <input type="number" name="phonenumber" class="form-control" value="<?php echo $rows['phonenumber']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" class="form-control" value="<?php echo $rows['password']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <input type="text" name="role" class="form-control" value="<?php echo $rows['role']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn btn-primary">
                        <a href="manage-admin.php" class="btn btn-secondary">Back to Manage Admin</a>
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the Submit button has been clicked or not
        include('./config/constants.php');
        if (isset($_POST['submit'])) {
            // Get all values from form to update
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $password = sha1($_POST['password']);
            $role = $_POST['role'];

            // Create a SQL to Update Admin
            $sql = "UPDATE admins SET 
            full_name = '$full_name',
            username = '$username',
            email='$email',
            phonenumber = $phonenumber,
            password = '$password',
            role= '$role'
            WHERE id=$id
            ";
            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Check whether the query executed successfully or not
            if ($res == true) {
                // Query executed and Admin updated
                $_SESSION['update'] = "<div class='alert alert-success'>Admin updated successfully</div>";
                header('location: ' . SITEURL . 'admin/manage-admin.php');
            } else {
                $_SESSION['update'] = "<div class='alert alert-danger'>Admin update failed</div>";
                header('location: ' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>

    </div>
</div>

<?php
include('partials/footer.php');
?>
