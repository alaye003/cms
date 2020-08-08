<?php
  if(isset($_POST['add_post'])){
    $post_user = $_POST['post_user'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];    

    // check for error
    foreach($_POST as $value){
      if(empty($value)){
        $error =  "<h4 class='text-danger bg-info'>Fields cannot be empty</h4>";
        break;
      }
    }

    // get the image extension
    $extension = ['jpeg', 'jpg', 'png'];
    $image_file_type = strtolower(pathinfo($post_image, PATHINFO_EXTENSION));
    

    if(!isset($error)){
      if(in_array($image_file_type, $extension) === false){
        $error = "File must be JPEG, JPG or PNG";
      }
    }
      
    if(!isset($error)){
      move_uploaded_file($post_image_tmp, '../images/'.$post_image);
      
      // insert into db
      $insert_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status, post_user) ";
      $insert_query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}', '{$post_user}')";
      $send_query = mysqli_query($connection, $insert_query);

      if(!$send_query){ 
        die("QUERY FAILED " . mysqli_error($connection));
      }

      $success =  "<h4 class='text-primary bg-info'>Post Added</h4>";
    }
  }

?>

<div class="col-xs-12">
  <form action="" method="post" enctype="multipart/form-data">
  <?php if(isset($error)){ echo $error; }  ?>
  <?php if(isset($success)){ echo $success; }  ?>
    <div class="form-group">
      <label for="Post Title">Post Title</label>
      <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
      <label for="Post Category">Post Category</label>
      <select name="post_category" class="form-control">
        <?php
          $select_query = "SELECT * FROM categories";
          $send_query = mysqli_query($connection, $select_query);

          while($row = mysqli_fetch_assoc($send_query)){
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            echo "<option value='{$category_id}'>$category_title</option>";
          }
        ?>
        
      </select>      
    </div>
    <div class="form-group">
      <label for="Post Author">Post Author</label>
      <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
      <label for="Post User">Post User</label>
      <input type="text" class="form-control" name="post_user">
    </div>
    <div class="form-group">
      <label for="Post Status">Post Status</label>
      <select class="form-control" name="post_status" id="">
          <option value="draft">Draft</option>
          <option value="published">Publish</option>
      </select>
    </div>
    <div class="form-group">
      <label for="Post Image">Post Image</label>
      <input type="file" name="post_image">
    </div>
    <div class="form-group">
      <label for="Post Tags">Post Tags</label>
      <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
      <label for="Post title">Post Content</label>
      <textarea class="form-control" name="post_content" id="" cols="30" rows="8"></textarea>      
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="add_post" value="Add Post">
    </div>
  </form>
</div>