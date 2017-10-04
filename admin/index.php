<?php include "includes/admin_header.php"?>

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Recipe Go CMS 
                            <small>
                            <?php if(isset($_SESSION['username'])){
                            echo $_SESSION['username'];
                            }?>
                            </small>
                        </h1>
                           <?php
                            if($_SESSION['user_role'] === 'admin'){
                                  
                            ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            
                                            <?php
                                                
                                            $query_select_all_recipe = "select * from recipe";
                                            $select_all_recipe_query = mysqli_query($connection, $query_select_all_recipe);
                                            $recipe_counts = mysqli_num_rows($select_all_recipe_query);
                                            echo "<div class='huge'>{$recipe_counts}</div>";
                                                
                                            ?>
                                          
                                                <div>Recipes</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="recipe.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            
                                            <?php
                                                
                                            $query_select_all_comments = "select * from comments";
                                            $select_all_comments_query = mysqli_query($connection, $query_select_all_comments);
                                            $comments_counts = mysqli_num_rows($select_all_comments_query);
                                            echo "<div class='huge'>{$comments_counts}</div>";
                                                
                                            ?>
                                              <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                
                                            $query_select_all_users = "select * from users";
                                            $select_all_comments_query = mysqli_query($connection, $query_select_all_users);
                                            $users_counts = mysqli_num_rows($select_all_comments_query);
                                            echo "<div class='huge'>{$users_counts}</div>";
                                                
                                            ?>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                
                                            $query_select_all_categories = "select * from category";
                                            $select_all_categories_query = mysqli_query($connection, $query_select_all_categories);
                                            $categories_counts = mysqli_num_rows($select_all_categories_query);
                                            echo "<div class='huge'>{$categories_counts}</div>";
                                                
                                            ?>
                                                 <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="category.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php    
                            }
                            ?>

                    </div>
                </div>
                <!-- /.row -->
                <br>
                <div>
                   <h2 class="text-center">Recipe Rank Top 10</h2>
                    <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                            <th>Rank</th>
                            <th>Recipe</th>
                            <th>Category</th>
                            <th>Like</th> 
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                            $query_rank = "select r.recipe_id, r.recipe_title, c.cat_title, count(*) from recipe r, category c, likelist l where r.recipe_cat_id = c.cat_id and r.recipe_id = l.like_recipe_id group by recipe_id order by count(*) desc limit 10";
                            $rank_query = mysqli_query($connection, $query_rank);
                            if(!$rank_query){
                                die("Query Failed" . mysqli_error($connection));
                            }
                            $rank = 1;
                            while($row = mysqli_fetch_array($rank_query)){
                                $recipe_id = $row['recipe_id'];
                                $recipe_title = $row['recipe_title'];
                                $category_title = $row['cat_title'];
                                $like_count = $row['count(*)'];
                                echo "<tr>";
                                echo "<td>{$rank}</td>";
                                echo "<td><a href='../view_recipe.php?recipe_id=$recipe_id'>{$recipe_title}</a></td>";
                                echo "<td>{$category_title}</td>";
                                echo "<td>{$like_count}</td>";
                                echo "</tr>";
                                $rank = $rank + 1;
                            }
                           ?>
                       </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        
<?php include "includes/admin_footer.php" ?>
