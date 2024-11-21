<?php 
ob_start();
session_start();
include('partials/navbar.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_accounts WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $email = $row['email'];
                    $username = $row['username'];
                    $role = $row['role'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    header('location:manage-user.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td>User Type: </td>
                    <td>
                        <input <?php if ($role == "user") {echo "checked";} ?> type="radio" name="role" value="user"> User
                        <input <?php if ($role == "admin") {echo "checked";} ?> type="radio" name="role" value="admin"> Admin
                    </td>
                </tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $role = $_POST['role'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_accounts SET
        full_name = '$full_name',
        email = '$email',
        username = '$username',
        role = '$role' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:manage-user.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Update User.</div>";
            //Redirect to Manage Admin Page
            header('location:manage-user.php');
        }

        ob_end_flush();
    }

?>


<?php include('partials/footer.php'); ?>