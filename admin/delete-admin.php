<?php 
    // Start session
    // session_start();

    // Include constants.php file
    include('database.php');
    require_once('./config/constants.php');

    $admin = get_admin_by_id($_GET['id']);
    
    $id = $admin["id"];
    if(!isset($id) && empty($id)){
        $_SESSION['delete'] = "<div class='error'>Invalid request. Please Try again.</div>";
        header('location: ' .SITEURL. 'admin/manage-admin.php');
        exit();
    }
    // echo serialize( $temp);
    // // Get the ID of Admin to be deleted
    // if(isset($_GET['id']) && !empty($_GET['id'])){
    //     $id = $_GET['id'];
    // } else {
    //     $_SESSION['delete'] = "<div class='error'>Invalid request. Please Try again.</div>";
    //     // header('location: ' .SITEURL. 'admin/add-admin.php');
    //     exit();
    // }

    // Prepare SQL Query to Delete Admin
    $sql = "DELETE FROM admins WHERE id=?";

    // Prepare statement with a parameterized query
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the Query
    if(mysqli_stmt_execute($stmt))
    {
        // Query Successfully Executed and Admin deleted
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('location: ' .SITEURL. 'admin/manage-admin.php');
        exit();
    }
    else
    {
        // Failed to delete Admin
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Please try again.</div>";
        header('location: ' .SITEURL. 'admin/manage-admin.php');
        exit();
    }
?>
