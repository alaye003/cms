
    <div class="col-xs-12">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>                            
          </tr>
        </thead>
        <tbody>
          <?php
            $select_query = "SELECT * FROM users ORDER BY user_id DESC";
            $send_query = mysqli_query($connection, $select_query);

            if(!$send_query){
              die("QUERY FAILED " . mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($send_query)){
              $user_id = $row['user_id'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $username = $row['username'];
              $user_role = $row['user_role'];
              $user_email = $row['user_email'];
                                                                          
              echo "<tr>
                <td>$user_id</td>
                <td>$username</td>
                <td>$user_firstname</td>
                <td>$user_lastname</td>                                
                <td>$user_email</td>                                
                <td>$user_role</td>                                
                <td><a href='users.php?change_to_admin={$user_id}' class='btn btn-primary'>Admin</a></td>
                <td><a href='users.php?change_to_subscriber={$user_id}' class='btn btn-info'>Subscriber</a></td>
                <td><a href='#' class='btn btn-warning'>Edit</a></td>
                <td><a href='users.php?delete={$user_id}' class='btn btn-danger'>Delete </a></td>
              </tr>";
            }
          ?>     
        </tbody>
      </table>
    </div>

<!-- functionalities -->
<?php
  if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];

    $user_admin_query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
    $send_user_admin_query = mysqli_query($connection, $user_admin_query);
    header("Location: users.php");    
    if(!$send_user_admin_query){
      die("QUERY FAILED " . mysqli_error($connection));
    }
  }

  if(isset($_GET['change_to_subscriber'])){
    $the_user_id = $_GET['change_to_subscriber'];

    $user_subscriber_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $send_user_subscriber_query = mysqli_query($connection, $user_subscriber_query);
    header("Location: users.php");
    if(!$send_user_subscriber_query){  
      die("QUERY FAILED " . mysqli_error($connection));
    }
  }
?>