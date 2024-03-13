<?php 
    session_start();
    include('./partials/menu.php');
?>


<div class="main-content">
    <div class="managemenu text-center">
        <h1>Add Admin</h1>
        <link rel="stylesheet" type="text/css" href="./css/add-admin.css">
        <br>
        <br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Full name:
                    </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter name">
                    </td>
                </tr>

                <tr>
                    <td>
                        Username:
                    </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username">
                    </td>
                </tr>

                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Enter Email">
                    </td>
                </tr>

                <tr>
                    <td>
                        Phonenumber:
                    </td>
                    <td>
                        <input type="text" name="phonenumber" placeholder="Enter Phonenumber">
                    </td>
                </tr>

                <tr>
                    <td>
                        Password:
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Role:
                    </td>
                    <td>
                        <input type="text" name="role" placeholder="Enter role">
                    </td>
                </tr>

            </table>

            <br>

            <div class="text-center">
                <input type="submit" name="submit" value="Add admin" class="btn-admin text-center">
                <a href="manage-admin.php" class="btn-secondary">Back to Manage Admin</a>
            </div>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $full_name =  $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $password = sha1($_POST['password']);
        $role = $_POST['role'];
        
        $sql = "INSERT INTO admins SET 
    full_name = '$full_name',
    username = '$username',
    email = '$email',
    phonenumber = '$phonenumber',
    password = '$password',
    role = '$role'
";
        
        include_once('database.php');
        include_once('config/constants.php');
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
        
        if($res == TRUE)
{
    $_SESSION['add'] = "<div class='success'>Successfully added Admin</div>";
    // header("location: ".SITEURL. 'admin/manage-admin.php'  );
    header("Location: manage-admin.php?message=add_success");
    
}
else
{
    $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
    header("location: ".SITEURL. 'admin/add-admin.php'  );
}
        mysqli_close($conn);
    }
    include('partials/footer.php');
?>
