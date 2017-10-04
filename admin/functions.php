<?php

//adding recipe category
function addCategory(){
    global $connection;
    if(isset($_POST['add_cat'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){    
            echo "This field should not be blank!";
        }else{
            $query = "INSERT INTO category(cat_title) VALUES ('{$cat_title}')";
            $create_cat_query = mysqli_query($connection, $query);

            if(!$create_cat_query){
                die('Query Failed'. mysqli_error($connection));
            }
        }
    }   
}

//update recipe category
function updateCategory(){
    global $connection;
    if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
        if(isset($_POST['update_cat'])){
            $update_cat_title = $_POST['cat_title'];
            if($update_cat_title == "" || empty($update_cat_title)){
               echo "This field should not be empty!"; 
            }else{
                $query = "UPDATE category SET cat_title = '{$update_cat_title}' WHERE cat_id = {$cat_id}";
                $update_cat_query = mysqli_query($connection, $query);
                if(!$update_cat_query){
                    die("Query failed". mysqli_error($connection));
                }
            }
        }   
    }
}

//delete recipe category
function deleteCategory(){
    global $connection;
    if(isset($_GET['delete'])){
        $delete_cat_id = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id = {$delete_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: category.php");//refresh category.php
    }
}





// delete recipe
function deleteRecipe(){
        global $connection;
        if(isset($_GET['delete'])){
        $delete_recipe_id = $_GET['delete'];
        $query = "DELETE FROM Recipe WHERE recipe_id = {$delete_recipe_id}";
        $delete_recipe_query = mysqli_query($connection, $query);
        queryConfirm($delete_recipe_query);
        header("Location: recipe.php");
    }
}

//display all categories 
function displayCategory(){
    global $connection;
        $query  = "SELECT * FROM category";
        $category_query = mysqli_query($connection, $query);
        queryConfirm($category_query);
        while($row = mysqli_fetch_assoc($category_query)){
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
}

//display the category of one recipe

function displayEditCategory(){
    global $connection;
    global $recipe_cat_id;
    $query  = "SELECT * FROM category where cat_id = '{$recipe_cat_id}'";
    $category_query = mysqli_query($connection, $query);
    queryConfirm($category_query);
    while($row = mysqli_fetch_assoc($category_query)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
}
//query confirmation
function queryConfirm($result){
    global $connection;
    if(!$result){
        die("Query failed". mysqli_error($connection));
    }
}



?>