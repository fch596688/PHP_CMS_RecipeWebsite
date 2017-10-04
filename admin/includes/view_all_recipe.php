<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Recipe ID</th>
            <th>Category ID</th>
            <th>Title</th>
            <th>Author ID</th>
            <th>Date</th>
            <th>Image</th>
            <th>Description</th>
            <th>Directions</th>
            <th>Ingredients</th>
            <th>Nutrition Facts</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($_SESSION['user_role'] === 'admin'){
           $query = "SELECT * FROM RECIPE";
            $selectAllRecipe = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectAllRecipe)){
                $recipe_id = $row['recipe_id'];
                $recipe_cat_id = $row['recipe_cat_id'];
                $recipe_title = $row['recipe_title'];
                $recipe_user_id = $row['recipe_user_id'];
                $recipe_date = $row['recipe_date'];
                $recipe_image = $row['recipe_image'];
                $recipe_description = substr($row['recipe_description'], 0, 100);
                $recipe_ingredients = substr($row['recipe_ingredients'], 0, 100);
                $recipe_directions = substr($row['recipe_directions'], 0, 100);
                $recipe_nutrition_facts = substr($row['recipe_nutrition_facts'], 0, 100);
                $recipe_status = $row['recipe_status'];

                echo"<tr>";
                echo"<td>{$recipe_id}</td>";
                echo"<td>{$recipe_cat_id}</td>";
                echo"<td>{$recipe_title}</td>";
                echo"<td>{$recipe_user_id}</td>";
                echo"<td>{$recipe_date}</td>";
                echo"<td><img width='100px' src='../images/{$recipe_image}' alt='image'></td>";
                echo"<td>{$recipe_description}</td>";
                echo"<td>{$recipe_directions}</td>";
                echo"<td>{$recipe_ingredients}</td>";
                echo"<td>{$recipe_nutrition_facts}</td>";
                echo"<td>{$recipe_status}</td>";
                echo"<td><a href='recipe.php?source=edit_recipe&recipe_id={$recipe_id}'>Edit</a></td>";
                echo"<td><a href='recipe.php?delete={$recipe_id}'>Delete</a></td>";
                echo"</tr>";
            } 
        }else {
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM recipe where recipe_user_id = $user_id";
            $selectAllRecipe = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectAllRecipe)){
                $recipe_id = $row['recipe_id'];
                $recipe_cat_id = $row['recipe_cat_id'];
                $recipe_title = $row['recipe_title'];
                $recipe_user_id = $row['recipe_user_id'];
                $recipe_date = $row['recipe_date'];
                $recipe_image = $row['recipe_image'];
                $recipe_description = substr($row['recipe_description'], 0, 100);
                $recipe_ingredients = substr($row['recipe_ingredients'], 0, 100);
                $recipe_directions = substr($row['recipe_directions'], 0, 100);
                $recipe_nutrition_facts = substr($row['recipe_nutrition_facts'], 0, 100);
                $recipe_status = $row['recipe_status'];

                echo"<tr>";
                echo"<td>{$recipe_id}</td>";
                echo"<td>{$recipe_cat_id}</td>";
                echo"<td>{$recipe_title}</td>";
                echo"<td>{$recipe_user_id}</td>";
                echo"<td>{$recipe_date}</td>";
                echo"<td><img width='100px' src='../images/{$recipe_image}' alt='image'></td>";
                echo"<td>{$recipe_description}</td>";
                echo"<td>{$recipe_directions}</td>";
                echo"<td>{$recipe_ingredients}</td>";
                echo"<td>{$recipe_nutrition_facts}</td>";
                echo"<td>{$recipe_status}</td>";
                echo"<td><a href='recipe.php?source=edit_recipe&recipe_id={$recipe_id}'>Edit</a></td>";
                echo"<td><a href='recipe.php?delete={$recipe_id}'>Delete</a></td>";
                echo"</tr>"; 
            }
        }
        ?>    
    </tbody>
    <a href=""></a>
</table>


<?php deleteRecipe();?>