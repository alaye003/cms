<?php include 'includes/header.php'; ?>

<body>

  <!-- delete and edit functionalities -->
<?php
  if(isset($_GET['delete'])){
    $the_category_id = $_GET['delete'];
    $delete_query = "DELETE FROM categories WHERE category_id = {$the_category_id}";
    $send_delete_query = mysqli_query($connection, $delete_query);
    header("Location: categories.php");
  }

  if(isset($_GET['edit'])){
    $the_category_id = $_GET['delete'];
    
    $delete_query = "DELETE FROM categories WHERE category_id = {$the_category_id}";
    $send_delete_query = mysqli_query($connection, $delete_query);
    header("Location: categories.php");
  }
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>
    

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>user</small>
                    </h1>
                    <div class="col-xs-6">
                      <?php
                        if(isset($_POST['submit'])){
                          $category_title = $_POST['category_title'];

                          if($category_title === '' || empty($category_title)){ 
                            echo "This field cannot be empty";
                          } else {

                            $insert_query = "INSERT INTO categories (category_title) VALUES ('{$category_title}')";
                            $send_query = mysqli_query($connection, $insert_query);

                            if(!$send_query){
                              die("QUERY FAILED " . mysqli_error($connection));
                            }
                          }
                          
                        }
                      ?>
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="category_title">Add Category</label>
                          <input type="text" class="form-control" name="category_title">
                        </div>
                        <div class="form-group">                          
                          <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                        </div>
                      </form>

                      <!-- for edit category -->
                      
                    </div>
                    <div class="col-xs-6">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            // bring categories from db
                            $categories_query = "SELECT * FROM categories";
                            $send_query = mysqli_query($connection, $categories_query);

                            while($row = mysqli_fetch_assoc($send_query)){
                              $category_id = $row['category_id'];
                              $category_title = $row['category_title'];

                              echo "<tr>
                                <td>$category_id</td>
                                <td>$category_title</td>
                                <td><a href='categories.php?delete=$category_id' class='btn btn-danger'>Delete</a></td>
                                <td><a href='categories.php?edit=$category_id' class='btn btn-info'>Edit</a></td>
                              </tr>";
                            }
                          
                          ?>
                          <tr>
                            
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include 'includes/footer.php'; ?>
