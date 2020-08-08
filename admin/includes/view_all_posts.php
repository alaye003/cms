
                    <div class="col-xs-12">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Tags</th>
                            <th>Comment</th>
                            <th>View Post</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $select_query = "SELECT * FROM posts ORDER BY post_id DESC";
                            $send_query = mysqli_query($connection, $select_query);

                            if(!$send_query){
                              die("QUERY FAILED " . mysqli_error($connection));
                            }

                            while($row = mysqli_fetch_assoc($send_query)){
                              $post_id = $row['post_id'];
                              $post_user = $row['post_user'];
                              $post_category_id = $row['post_category_id'];
                              $post_title = $row['post_title'];
                              $post_image = $row['post_image'];
                              $post_date = $row['post_date'];
                              $post_status = $row['post_status'];
                              $post_tags = $row['post_tags'];
                              // $post_comment = $row['post_comment'];
                              
                              $category_query = "SELECT * FROM categories WHERE category_id = $post_category_id ";
                              $send_category_query = mysqli_query($connection, $category_query);

                              while($cat_row = mysqli_fetch_assoc($send_category_query)){
                                $the_category_title = $cat_row['category_title'];
                              }
                              echo "<tr>
                                <td>$post_id</td>
                                <td>$post_user</td>
                                <td>$post_title</td>
                                <td>$the_category_title</td>
                                <td><img src='../images/$post_image' width='150' alt='image'/></td>
                                <td>$post_date</td>                                
                                <td>$post_status</td>
                                <td>$post_tags</td>
                                <td>comment</td>
                                <td><a href='../posts.php?post_id={$post_id}' class='btn btn-primary' target='__'>View Post</a></td>
                                <td><a href='posts.php?source=edit_post&post_id={$post_id}' class='btn btn-info'>Edit Post</a></td>
                                <td><a href='#' class='btn btn-danger'>Delete Post</a></td>
                              </tr>";
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>