<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
   
   
   
   
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Recipe Entries Column -->
            <div class="col-md-8">
    <?php 
    
        if(isset($_GET['recipe_id'])){
            $recipe_id = $_GET['recipe_id'];
        }
        $query = "select r.recipe_title, r.recipe_date, r.recipe_description, r.recipe_image,  r.recipe_ingredients, r.recipe_directions, r.recipe_nutrition_facts, u.username from recipe r, users u WHERE recipe_id = $recipe_id and r.recipe_user_id = u.user_id";
        $selectAllRecipe = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectAllRecipe)){
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['username'];
            $recipe_date = $row['recipe_date'];
            $recipe_description = $row['recipe_description'];
            $recipe_image = $row['recipe_image'];
            $recipe_ingredients = $row['recipe_ingredients'];
            $recipe_directions = $row['recipe_directions'];
            $recipe_nutrition_facts = $row['recipe_nutrition_facts'];
    ?>
        <?php 
            if(isset($_GET['like'])){
                $like_recipe_id = $_GET['like'];
                $like_user_id = $_SESSION['user_id'];
                $query_like = "insert into likelist (like_user_id, like_recipe_id, rating) values ($like_user_id, $like_recipe_id, 'like')";
                $like_query = mysqli_query($connection, $query_like);
                //queryConfirm($like_query);
                header("Location: view_recipe.php?recipe_id=$recipe_id");
            }
        ?>
        <?php
            if(isset($_GET['dislike'])){
                $dislike_recipe_id = $_GET['dislike'];
                $dislike_user_id = $_SESSION['user_id'];
                $query_dislike = "delete from likelist where like_user_id = $dislike_user_id and like_recipe_id = $dislike_recipe_id";
                $dislike_query = mysqli_query($connection, $query_dislike);
                //queryConfirm($dislike_query);
                //header("Location: view_recipe.php?recipe_id=$recipe_id");
            }
        ?>
                <!-- Recipe Post -->
                <h2>
                    <span><?php echo $recipe_title; ?></span> 
                    <small>
                    
                    <?php
                    if(isset($_SESSION['username'])){
                        $user_id = $_SESSION['user_id'];
                        $recipe_id_now = $_GET['recipe_id'];
                        $query_like_status = "select * from likelist where like_recipe_id = {$recipe_id_now} and like_user_id = {$user_id} ";
                        $like_status_query = mysqli_query($connection, $query_like_status);

                        if(!$like_status_query){
                            die("Query Failed". mysqli_error($connection));
                        }

                        if(mysqli_num_rows($like_status_query) != 0){
                            echo "<a href='view_recipe.php?recipe_id={$recipe_id}&dislike={$recipe_id}'>Dislike</a>";
                        } else {
                            echo "<a href='view_recipe.php?recipe_id={$recipe_id}&like={$recipe_id}'>Like</a>";
                        }
                    }  
                    ?>
                    
                    
                    </small>
                </h2>
                <p class="lead">
                    by <span><?php echo $recipe_author;?></span>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $recipe_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $recipe_image?>" alt="">
                <hr>
                <h3>Description</h3>
                <p><?php echo $recipe_description;?></p>
                <h3>Ingredients</h3>  
                <p><?php echo $recipe_ingredients;?></p>
                <h3>Directions</h3>  
                <p><?php echo $recipe_directions;?></p>
                <h3>Nutrition Facts</h3>
                <p><?php echo $recipe_nutrition_facts;?></p>  
       <?php }?>
                <hr>
                
                <!-- Blog Comments -->
            <?php
                if(isset($_SESSION['username'])){
                    if(isset($_POST['create_comment'])){
                        $recipe_id = $_GET['recipe_id'];
                        $comment_user_id = $_SESSION['user_id'];
                        $comment_content = $_POST['comment_content'];
                        $comment_date = date('d-m-y');
                        if(!empty($comment_user_id) && !empty($comment_content)){
                            $query_create_comment = "INSERT INTO comments (comment_recipe_id, comment_user_id, comment_content, comment_status, comment_date) VALUES ($recipe_id, $comment_user_id,'{$comment_content}', 'unapproved', now())";
                            $create_comment_query = mysqli_query($connection, $query_create_comment);
                            if(!$create_comment_query){
                               die('QUERY FAILED '. mysqli_error($connection)); 
                            }
                        }else {
                            echo "<p>Empty Comment Is Not Allowed!</p>";
                        }
                    }
                }else {
                    echo "<h5>login first before adding comments!</h5>";
                }

            ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="#" method = "post">
                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    $query_select_comment = "SELECT c.comment_date, c.comment_content, u.username FROM comments c, users u WHERE c.comment_recipe_id = {$recipe_id} AND c.comment_status = 'approved' AND c.comment_user_id = u.user_id ORDER BY c.comment_date DESC";
                    $select_comment_query = mysqli_query($connection, $query_select_comment);
                    if(!$select_comment_query){
                        die('SELECT Query Failed'. mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($select_comment_query)){
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['username'];
                ?>
                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author;?>
                                <small><?php echo $comment_date;?></small>
                            </h4>
                            <?php echo $comment_content;?>
                        </div>
                    </div>
                <?php
                    }
                        
                ?>

            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
        </div><!-- /.row -->
        <hr>
<?php include "includes/footer.php";?>
