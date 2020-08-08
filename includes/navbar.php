<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Home</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <!-- Categories from database -->
            <?php
                $category_query = "SELECT * FROM categories";
                $send_query = mysqli_query($connection, $category_query);

                while($row = mysqli_fetch_assoc($send_query)){
                  $category_id = $row['category_id'];
                  $category_title = $row['category_title'];
                
                  echo "<li><a href='categories.php?category={$category_id}'>{$category_title}</a></li>";
            ?>
                  
          <?php } ?>
            
            <!-- <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li> -->
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>