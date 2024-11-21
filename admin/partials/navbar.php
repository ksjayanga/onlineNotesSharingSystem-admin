<?php 

    include('../config/constants.php'); 
  //  include('login-check.php');

?>

<head>
  
    <link rel="stylesheet" href="../plugin/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../plugin/jquery.min.js"></script>    
    <script src="../plugin/bootstrap.min.js"></script>   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Student Notes Sharing System</title>

</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><i class="fa-solid fa-book"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="add-note.php">Upload <span class="sr-only">(current)</span></a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="notes.php">Notes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="subjects.php">Subjects</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myprofile.php">My Profile</a>
      </li>
       

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="myprofile-change.php">Manage Profile</a>
          <a class="dropdown-item" href="manage-user.php">Manage Users</a>
          <a class="dropdown-item" href="manage-subject.php">Manage Subjects</a>
          <a class="dropdown-item" href="manage-note.php">Manage Notes</a>
          <div class="dropdown-divider"></div>
         <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>
    <!--  <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="form-control mr-sm-2" href="../login.php">Login</a>

      <a class="form-control mr-sm-2" href="../signup.php">Signup</a>
      
    </form> 
  </div>
</nav>