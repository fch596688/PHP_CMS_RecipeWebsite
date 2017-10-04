<?php include "includes/admin_header.php"?>

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Recipe GO CMS <small><?php echo $_SESSION['username']?></small>
                        </h1>
                        <?php
                        
                            if(isset($_SESSION['username'])){
                                $user_id = $_SESSION['user_id'];
                            
                                $query_get_info = "select * from users where user_id = $user_id";
                                $get_info_query = mysqli_query($connection, $query_get_info);
                                
                                if(!$get_info_query){
                                    die("Query Failed". mysqli_error($connection));
                                }
                                
                                $row = mysqli_fetch_array($get_info_query);
                                $firstname = $row['user_firstname'];
                                $lastname = $row['user_lastname'];
                                $username = $row['username'];
                                $email = $row['user_email'];
                                $image = $row['user_image'];
                                $password = $row['user_password'];
                                
                            }
                        ?>
                        
                        <?php 
                              if(isset($_POST['update_user'])){
                                $user_firstname = $_POST['user_firstname'];
                                $user_lastname = $_POST['user_lastname'];
                                $username = $_POST['username'];

                                $user_image = $_FILES['image']['name'];
                                $user_image_temp = $_FILES['image']['tmp_name'];

                                $user_password = $_POST['user_password'];
                                $user_email = $_POST['user_email'];

                                move_uploaded_file($user_image_temp, "/images/$user_image");

                                if(empty($user_image)){
                                    $query = "SELECT * FROM users WHERE user_id = $user_id";
                                    $image_query = mysqli_query($connection,$query);

                                    while($row = mysqli_fetch_array($image_query)){
                                        $recipe_image = $row['user_image'];
                                    }
                                }

                                $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_image = '{$user_image}', user_lastname = '{$user_lastname}', user_password = '{$user_password}', user_email = '{$user_email}' WHERE user_id = {$user_id}";

                                $update_user = mysqli_query($connection, $query);

                                queryConfirm($update_user);

                                header("Location: profile.php");
                              }
                        ?>
                        <div class="profile_image">
                         <strong>User Image</strong>
                          <img src="../images/<?php echo $image;?>" alt="User Image">    
                        </div>
                              
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                            <label for="">Firstname</label>
                            <input class="form-control" type="text" name="user_firstname" value="<?php echo $firstname;?>">
                            </div>

                            <div class="form-group">
                            <label for="">Lastname</label>
                            <input class="form-control" type="text" name="user_lastname" value="<?php echo $lastname;?>">
                            </div>

                            <div class="form-group">
                            <label for="">Username</label>
                            <input class="form-control" type="text" name="username" value="<?php echo $username;?>">
                            </div>

                            <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" name="user_email" value="<?php echo $email;?>">
                            </div>

                            <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password" name="user_password" value="<?php echo $password;?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="">User Image</label>
                            <input class="form-control" type="file" name="image">
                            </div>
                            
                            <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="update">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php" ?>
