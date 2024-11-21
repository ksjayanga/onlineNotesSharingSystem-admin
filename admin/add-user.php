<?php 
ob_start();
session_start();
include('partials/navbar.php'); 

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add New User</h1>

        <br><br>

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
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Full Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" placeholder="Enter Your Email" required>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </td>
                </tr>
                </tr>
                    <tr>
                    <td>User Type: </td>
                    <td>
                        <input type="radio" name="role" value="user"> User 
                        <input type="radio" name="role" value="admin"> Admin
                    </td>
                    </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Save" class="btn btn-secondary" required>
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
     

    if(isset($_POST['submit']))
    {
        

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5
        $email = $_POST['email'];
        $role = $_POST['role'];
        
        $sql = "INSERT INTO tbl_accounts SET 
            full_name='$full_name',
            username='$username',
            password='$password',
            email='$email',
            role='$role'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die();

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
             
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:manage-user.php");
            ob_end_flush();
        }
        else
        {
            
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:manage-user.php");
        }

    }
    
?>