
<?php 
if(isset($_POST['create_recipe'])){
    $recipe_title = $_POST['recipe_title'];
    $recipe_cat_id = $_POST['recipe_cat_id'];
    $recipe_user_id = $_SESSION['user_id'];
    $recipe_date = date('d-m-y');
    
    $recipe_image = $_FILES['image']['name'];
    $recipe_image_temp = $_FILES['image']['tmp_name'];
    
    $recipe_description = $_POST['recipe_description'];
    $recipe_ingredients = $_POST['recipe_ingredients'];
    $recipe_directions = $_POST['recipe_directions'];
    $recipe_nutrition_facts = $_POST['recipe_nutrition_facts'];
    $recipe_status = $_POST['recipe_status'];
    
    move_uploaded_file($recipe_image_temp, "../images/$recipe_image");
    
    $query_create_recipe  = "INSERT INTO recipe (recipe_title, recipe_cat_id, recipe_user_id, recipe_date, recipe_image, recipe_description, recipe_ingredients, recipe_directions, recipe_nutrition_facts, recipe_status) VALUES ('{$recipe_title}', $recipe_cat_id, $recipe_user_id, now(), '{$recipe_image}', '{$recipe_description}', '{$recipe_ingredients}', '{$recipe_directions}', '{$recipe_nutrition_facts}', '{$recipe_status}')";
    
    $add_recipe_query = mysqli_query($connection, $query_create_recipe);

    queryConfirm($add_recipe_query);
    
    
    
}
    



?>
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
    <label for="">Recipe Title</label>
    <input class="form-control" type="text" name="recipe_title">
    </div>
    
    <div class="form-group">
    <label for="">Category</label>
    <select class="form-control" name="recipe_cat_id">
        <?php displayCategory();?>
    </select>
    </div>
    
    <div class="form-group">
    <label for="">Recipe Image</label>
    <input class="form-control" type="file" name="image">
    </div>
    
    <div class="form-group">
    <label for="recipe_description">Recipe Description</label>
    <textarea class="form-control" name="recipe_description"></textarea>
    </div>
    
    <div class="form-group">
    <label for="">Recipe Ingredients</label>
    <textarea class="form-control" name="recipe_ingredients"></textarea>
    </div>
    
    <div class="form-group">
    <label for="recipe_directions">Recipe Directions</label>
    <textarea class="form-control" name="recipe_directions"></textarea>
    </div>
    
    <div class="form-group">
    <label for="recipe_nutrition_facts">Recipe Nutrition Facts</label>
    <textarea class="form-control" name="recipe_nutrition_facts"></textarea>
    </div>
    
    <div class="form-group">
    <label for="">RecipeStatus</label>
    <select class="form-control" name="recipe_status">
        <option value="published">Published</option>
        <option value="draft">Draft</option>
    </select>
    </div>
    
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_recipe" value="new recipe">
    </div>
</form>