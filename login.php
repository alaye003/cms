<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php session_start(); ?>
<?php if(isset($_SESSION['user_email'])){ header("Location: admin"); } ?>

<body>

<!-- Navigation -->
<?php include 'includes/navbar.php'; ?>

<!-- Page Content -->
  <div class="container">
    <div class="row">

      <!-- Blog Entries Column -->
      <div class="">
      <div class="col-sm-4"></div>
      <div class="col-md-4">
        <?php
        
          if(isset($_POST['login'])){
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            
            $user_email = mysqli_real_escape_string($connection, $user_email);
            $user_password = mysqli_real_escape_string($connection, $user_password);          
                     
            $select_query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
            $send_query = mysqli_query($connection, $select_query);
           
            if(!$send_query){
              die("QUERY FAILED ". mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($send_query)){
              $db_username = $row['username'];              
              $db_user_email = $row['user_email'];
              $db_user_password = $row['user_password'];            
              $db_user_firstname = $row['user_firstname'];
              $db_user_lastname = $row['user_lastname'];
              $db_user_role = $row['user_role'];
            }

            if(password_verify($user_password, $db_user_password)){
              $_SESSION['username'] = $db_username;
              $_SESSION['user_email'] = $db_user_email;
              $_SESSION['user_firstname'] = $db_user_firstname;
              $_SESSION['user_lastname'] = $db_user_lastname;
              $_SESSION['user_role'] = $db_user_role;
              
              header("Location: admin");
            } else{
              header("Location: index.php");
            }
          }
        ?>
        <form action="" method="post">        
          <div class="form-group">
            <label for="user_email">Email</label>
            <input type="text" class="form-control" name="user_email">          
          </div>
          <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" name="user_password">          
          </div>
          <div class="form-group">        
            <input type="submit" class="btn btn-primary" name="login" value="Login">
          </div>
        </form>
      </div>
      <div class="col-md-4"></div>
        
      <!-- Blog Sidebar Widgets Column -->
      <?php //include 'includes/sidebar.php' ?>

  </div>
  <!-- /.row -->

  <!-- <hr> -->

  <!-- Footer -->
  <?php include 'includes/footer.php' ?>