<?php 
    include('./partials/menu.php');
?>
<div id="main" class="main-content">
    <div class="managemenu text-center">
        <h2>Manage Admin</h2>
        <link rel="stylesheet" type="text/css" href="./css/manage-admin.css">

        <?php 
            session_start();

            // Kiểm tra nếu có thông điệp thành công trong URL
            if(isset($_GET['message']) && $_GET['message'] == 'add_success') {
                echo "<div class='success'>Successfully added Admin</div>";
                unset($_SESSION['add']); // Xóa session sau khi đã hiển thị thông báo
            }
            
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete']; 
                unset($_SESSION['delete']); 
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update']; 
                unset($_SESSION['update']); 
            }
            if(isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found']; 
                unset($_SESSION['user-not-found']); 
            }
            if(isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match']; 
                unset($_SESSION['pwd-not-match']); 
            }
            if(isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd']; 
                unset($_SESSION['change-pwd']); 
            }
        ?>
        <br><br>
        <!-- Button add Admin -->
        <a href="add-admin.php" class="btn-primary" id="add-prd">Add Admin</a>
        <br>
        <a href="admin.php" class="btn-primary">Admin</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phonenumber</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php 
                // Query to Get all Admin
                include('database.php');
                include_once('config/constants.php');
                $sql = "SELECT * FROM admins";
                $res = mysqli_query($conn, $sql);

                // Check whether the Query is executed or not
                if($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1; // Create a Variable 
                    if ($count > 0) {
                        // We have data in database
                        while($rows = mysqli_fetch_assoc($res)) {
                            // Using While loop to get all the data form database
                            // Add while loop will run as long as we have data in database

                            // Get individual Data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $email = $rows['email'];
                            $phonenumber = $rows['phonenumber'];
                            $role =  $rows['role'];

                            // Display the value in our table
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username;?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $phonenumber;?></td>
                                <td><?php echo $role ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>
        </table>
    </div>
</div>
<?php 
    include('partials/footer.php');
?>
