<?php include "includes/admin_header.php"?>

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Category
                        </h1>
                        <?php if($_SESSION['user_role'] === 'admin'){
                        
                        ?>
                        <div class="col-xs-6">
                            
                            <?php addCategory();?>
                            
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Add Category</label>
                                    <input type="text"  class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" name="add_cat" type="submit" value="add category">
                                </div>
                            </form><!--add category form-->
                            
                            
                            <?php updateCategory();?>
                            
                               
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Update Category</label>
                                <?php 
                                        if(isset($_GET['edit'])){
                                            $edit_cat_id = $_GET['edit'];
                                            $query = "SELECT * FROM category WHERE cat_id = $edit_cat_id";
                                            $select_edit_cat = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($select_edit_cat)){
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];
                                            ?>
                                        <input type="text" class="form-control" name="cat_title" value="<?php if(isset($cat_title)){echo $cat_title;}?>">
                                        <?php        
                                            }
                                        }
                                        ?>    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" name="update_cat" type="submit" value="update category">
                                </div>
                            </form><!--update category form-->
                        </div><!--form panel-->
                        
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                               <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>   
                               </thead>
                                <tbody>
   
                                   <?php
                                    $query = "SELECT * FROM category";
                                    $selectAllCategory = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($selectAllCategory)){
                                        echo "<tr>";
                                        echo "<td>{$row['cat_id']}</td>";
                                        echo "<td>{$row['cat_title']}</td>";
                                        echo "<td><a href='category.php?delete={$row['cat_id']}'>DELETE</a></td>";
                                        echo "<td><a href='category.php?edit={$row['cat_id']}'>EDIT</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            
                            <?php deleteCategory();?>    
                        
                        
                        </div><!--table form-->
                        <?php 
                        }else{
                            echo "<h3>Sorry, you are not  an administrator!</h3>";
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>
