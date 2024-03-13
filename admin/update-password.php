<?php 
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br/>
        <br/>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id']; 
            }
        ?>

        <form action="" method="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password"> 
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    require('./database.php');
    include_once('./config/constants.php');
    // Check the submit button click or not
    if(isset($_POST['submit']))
    {
        // Get data from form 
        $id = $_POST['id'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Prepare and execute SQL query to check if user exists and current password is correct
        // $stmt = $conn->prepare("SELECT * FROM admins WHERE id = ? AND password = ?");
        // $stmt->bind_param("ss", $id, sha1($current_password));
        // $stmt->execute();
        // $result = $stmt->get_result();
        $result = get_admin_by_id_and_password($id, sha1($current_password));
        if(isset($result))
        {
            // User exists and current password is correct
            if($new_password == $confirm_password)
            {
                // New passwords match - update password
                $is_success = update($id, "admins", "`password` = '".sha1($new_password)."'");

                // Check for successful update and display appropriate message
                if ($is_success == 1)
                {
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                } 
                else 
                {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";   
                }

                // Redirect user
                header('location: ' . SITEURL . 'admin/manage-admin.php');
                exit();
            }
            else
            {
                // New passwords do not match - display error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Passwords do not match</div>";
                header('location: ' . SITEURL . 'admin/manage-admin.php');
                exit();
            }
        }
        else
        {
            // User does not exist or current password is incorrect - display error message
            // throw new Error("Password is invalid");
            $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
            header('location: ' . SITEURL . 'admin/manage-admin.php');
            exit();
        }
    }
?>

<?php include('partials/footer.php'); ?>
