<?php 
ob_start();
session_start();
include('partials/navbar.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php 
        
            if(isset($_SESSION['no-subject-found']))
            {
                echo $_SESSION['no-subject-found'];
                unset($_SESSION['no-subject-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        
        ?>

        <?php 
        
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_subjects WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-subject-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:manage-subject.php');
                }

            }
            else
            {
                //redirect to Manage CAtegory
                header('location:manage-subject.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Display the Image
                                ?>
                                <img src="../images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Save" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $active = $_POST['active'];

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if (isset($_FILES['image']['name'])) {
                    // Get the Image Details
                    $image_name = $_FILES['image']['name'];
                
                    // Check whether the image is available or not
                    if ($image_name != "") {
                        // Image Available
                
                        // A. Upload the New Image
                        $extArray = explode('.', $image_name); // Fixed here
                        $ext = end($extArray); // Fixed here
                
                        // Rename the Image
                        $image_name = "Note_Category_" . rand(000, 999) . '.' . $ext; // e.g. Note_Category_834.jpg
                
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;
                
                        // Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);
                
                        // Check whether the image is uploaded or not
                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('location:manage-subject.php');
                            exit();
                        }
                
                        // B. Remove the Current Image if available
                        if ($current_image != "") {
                            $remove_path = "../images/category/" . $current_image;
                            if (file_exists($remove_path)) { // Check if file exists
                                $remove = unlink($remove_path);
                            } else {
                                $_SESSION['failed-remove'] = "<div class='error'>Current Image file does not exist.</div>";
                            }
                        }
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }
                

                //3. Update the Database
                $sql2 = "UPDATE tbl_subjects SET 
                    title = '$title',
                    image_name = '$image_name',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage Category with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //Category Updated
                    $_SESSION['update'] = "<div class='success'>Subject Updated Successfully.</div>";
                    header('location:manage-subject.php');
                    
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Subject.</div>";
                    header('location:manage-subject.php');
                }

                ob_end_flush();
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>