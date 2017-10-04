<?php 

if(isset($_GET['recipe_id'])){
    $edit_recipe_id = $_GET['recipe_id'];
    $query = "SELECT * FROM Recipe WHERE recipe_id = $edit_recipe_id";
    $edit_recipe_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($edit_recipe_query)){
                $recipe_id = $row['recipe_id'];
                $recipe_cat_id = $row['recipe_cat_id'];
                $recipe_title = $row['recipe_title'];
                $recipe_date = $row['recipe_date'];
                $recipe_image = $row['recipe_image'];
                $recipe_description = $row['recipe_description'];
                $recipe_ingredients = $row['recipe_ingredients'];
                $recipe_directions = $row['recipe_directions'];
                $recipe_nutrition_facts = $row['recipe_nutrition_facts'];
                $recipe_status = $row['recipe_status'];
    }
}

if(isset($_POST['update_recipe'])){
    $recipe_title = $_POST['recipe_title'];
    $recipe_cat_id = $_POST['recipe_cat_id'];
    $recipe_date = date("Y-m-d H:i:s");
    
    $recipe_image = $_FILES['image']['name'];
    $recipe_image_temp = $_FILES['image']['tmp_name'];
    
    $recipe_description = $_POST['recipe_description'];
    $recipe_ingredients = $_POST['recipe_ingredients'];
    $recipe_directions = $_POST['recipe_directions'];
    $recipe_nutrition_facts = $_POST['recipe_nutrition_facts'];
    $recipe_status = $_POST['recipe_status'];
    
    move_uploaded_file($recipe_image_temp, "../images/$recipe_image");
    
    if(empty($recipe_image)){
        $query = "SELECT * FROM Recipe WHERE recipe_id = $edit_recipe_id";
        $image_query = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_array($image_query)){
            $recipe_image = $row['recipe_image'];
        }
    }
    
    $query = "UPDATE Recipe SET recipe_title = '{$recipe_title}', recipe_cat_id = '{$recipe_cat_id}', recipe_date = now(), recipe_image = '{$recipe_image}', recipe_description = '{$recipe_description}', recipe_ingredients = '{$recipe_ingredients}', recipe_directions = '{$recipe_directions}', recipe_nutrition_facts = '{$recipe_nutrition_facts}', recipe_status = '{$recipe_status}' WHERE recipe_id = {$edit_recipe_id}";
    
    $update_recipe = mysqli_query($connection, $query);
    
    queryConfirm($update_recipe);
    
    header("Location: recipe.php");
    
}

?>
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
    <label for="">Recipe Title</label>
    <input class="form-control" type="text" name="recipe_title" value="<?php echo $recipe_title;?>">
    </div>
    
    <div class="form-group">
    <label for="">Category</label>
    <select class="form-control" name="recipe_cat_id">
    <?php displayCategory();?>
    </select>
    </div>
    
    
    <div class="form-group">
    <label for="">Recipe Image</label>
    <img width="100px" height="100px" src="../images/<?php echo $recipe_image; ?>" alt="">
    <input class="form-control" type="file" name="image">
    </div>
    
    <div class="form-group">
    <label for="recipe_description">Recipe Description</label>
    <textarea class="form-control" name="recipe_description"><?php echo $recipe_description;?></textarea>
    </div>
    
    <div class="form-group">
    <label for="">Recipe Ingredients</label>
    <textarea class="form-control" name="recipe_ingredients"><?php echo $recipe_ingredients;?></textarea>
    </div>
    
    <div class="form-group">
    <label for="recipe_directions">Recipe Directions</label>
    <textarea class="form-control" name="recipe_directions"><?php echo $recipe_directions;?></textarea>
    </div>
    
    <div class="form-group">
    <label for="recipe_nutrition_facts">Recipe Nutrition Facts</label>
    <textarea class="form-control" name="recipe_nutrition_facts"><?php echo $recipe_nutrition_facts;?></textarea>
    </div>
    
    <div class="form-group">
    <label for="">RecipeStatus</label>
    <select class="form-control" name="recipe_status">
        <option value="published">Published</option>
        <option value="draft">Draft</option>
    </select>
    </div>
    
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_recipe" value="update recipe">
    </div>
</form>