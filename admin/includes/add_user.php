<?php
  if(isset($_POST['add_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    // check for error
    foreach($_POST as $value){
      if(empty($value)){
        $error =  "<h4 class='text-danger bg-info'>Fields cannot be empty</h4>";
        break;
      }
    }    
        
    // validate email
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
      $error = "<h4 class='text-danger bg-info'>Invalid Email Format</h4>";
    }
           
    if(!isset($error)){
      // encrypt password
      $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

      // insert into db
      $insert_query = "INSERT INTO users (user_firstname, user_lastname, username, user_role, user_email, user_password) ";
      $insert_query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$username}', '{$user_role}', '{$user_email}', '{$user_password}')";
      $send_query = mysqli_query($connection, $insert_query);

      if(!$send_query){ 
        die("QUERY FAILED " . mysqli_error($connection));
      }

      $success =  "<h4 class='text-primary bg-success'>User Added: <a href='users.php'>View Users</a></h4>";
    }
  }

?>

<div class="col-xs-12">
  <form action="" method="post" enctype="multipart/form-data">
  <?php if(isset($error)){ echo $error; }  ?>
  <?php if(isset($success)){ echo $success; }  ?>
    <div class="form-group">
      <label for="user_firstname">Firstname</label>
      <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
      <label for="user_lastname">Lastname</label>
      <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
      <label for="user_role">User Role</label>
      <select name="user_role" class="form-control">
        <option value="subscriber">Subscriber</option>  
        <option value="admin">Admin</option>  
      </select>      
    </div>
    <div class="form-group">
      <label for="user_email">Email</label>
      <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
      <label for="user_password">Password</label>
      <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
  </form>
</div>