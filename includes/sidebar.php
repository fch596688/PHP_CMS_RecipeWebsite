
<div class="col-md-4">

    <div class="well">
       <?php
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $user_role = $_SESSION['user_role'];
            echo "<h4>Welcome To Recipe Go!</h4>";
            echo "<p>Username: {$username}</p>";
            echo "<p>User Role: {$user_role}</p>";
            echo "<a href='./admin/'>Recipe Go CMS</a>";
            echo "<p></p>";
            echo "<a href='./includes/logout.php'>Sign Out</a>";
        }else{
            
        ?>
        <h4>Sign In</h4>
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter Username"> 
        </div>
          <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
               <button class="btn btn-primary" name="login" type="submit">Submit</button>
            </span>
            
        </div>
        </form><!--login form-->
        <br>
        <div>
            <p>Don't have an account?  <a href="./registration.php">Sign Up</a></p>
        </div>
        <?php
        }
        ?>  
    </div><!-- /.input-group -->
    <hr>
   
    <!-- Recipe Search Well -->
    <div class="well">
        <h4>Recipe Search</h4>
        <form action="searchResult.php" method="post">
        <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>    
        </div>
        <!-- /.input-group -->
        </form><!-- search form -->
    </div>
    <?php 
    $query = "SELECT * FROM category";
    $query_category_name = mysqli_query($connection, $query);
    ?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Recipe Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                   <?php
                    while($row = mysqli_fetch_assoc($query_category_name)){
                        $category_name = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                    ?>   
                        <li><a href="view_category.php?cat_id=<?php echo $cat_id;?>"><?php echo $category_name;?></a></li>
                   <?php } ?>
                </ul>
            </div>
        <!-- /.row -->
        </div>
    </div>
    

     <!-- Side Widget Well -->
    <?php include "includes/widget.php"?>
</div>