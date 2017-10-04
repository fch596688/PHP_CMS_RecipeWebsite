<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
   
   
   
   
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Recipe Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">Recipe</h1>
    <?php 
        if(isset($_GET['cat_id'])){
            $cat_id = $_GET['cat_id'];
        }
        $query = "select r.recipe_id, r.recipe_title, u.username, r.recipe_date, r.recipe_description, r.recipe_image from recipe r, users u WHERE recipe_cat_id = $cat_id and r.recipe_user_id = u.user_id";
        $selectAllRecipe = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectAllRecipe)){
            $recipe_id = $row['recipe_id'];
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['username'];
            $recipe_date = $row['recipe_date'];
            $recipe_description = substr($row['recipe_description'], 0, 200);
            $recipe_image = $row['recipe_image'];
    ?>
                <!-- Recipe Post -->
                <h2>
                    <a href="view_recipe.php?recipe_id=<?php echo $recipe_id;?>"><?php echo $recipe_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $recipe_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $recipe_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $recipe_image?>" alt="">
                <hr>
                <p><?php echo $recipe_description;?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>  
       <?php }?>
                <hr>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
        </div><!-- /.row -->
        <hr>
<?php include "includes/footer.php";?>
