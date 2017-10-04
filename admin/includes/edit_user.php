<?php // update user
if(isset($_POST['edit_user'])){
    $user_id = $_GET['edit_user'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query_select_randSalt = "select randSalt from users";
    $select_randSalt_query = mysqli_query($connection, $query_select_randSalt);

    if(!$select_randSalt_query){
        die("Query Failed. mysqli_error($connection)");
    }
    
    $row = mysqli_fetch_assoc($select_randSalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt);
    
    if(!empty($user_firstname) && !empty($user_lastname) && !empty($user_role) && !empty($username) && !empty($user_email) && !empty($user_password)){
        
    $create_user_query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username}', user_email = '{$user_email}', user_password = '{$hashed_password}' WHERE user_id = $user_id";
        
    $query_create_user = mysqli_query($connection, $create_user_query);

    queryConfirm($query_create_user);
    
    header("Location: users.php");
        
    }else{// if the user id is not present in the URL, redirect to the home page.
        header("Location: index.php");
    }
}  

if(isset($_GET['edit_user'])){
    $user_id = $_GET['edit_user'];
    
    $select_user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $query_select_user = mysqli_query($connection, $select_user_query);
    while($row = mysqli_fetch_assoc($query_select_user)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
    }
}
?>


<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
    <label for="">Firstname</label>
    <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    
    <div class="form-group">
    <label for="">Lastname</label>
    <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    
    <div class="form-group">
    <label for="">User Role</label>
    <select class="form-control" name="user_role">
        <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
        <?php
        if($user_role == "admin"){
            echo "<option value='subscriber'>subscriber</option>"; 
        }else {
            echo " <option value='admin'>Admin</option>";
        }
        ?> 
    </select>
    </div>
    
    <div class="form-group">
    <label for="">Username</label>
    <input class="form-control" type="text" name="username" value="<?php echo $username;?>">
    </div>
    
    <div class="form-group">
    <label for="">Email</label>
    <input class="form-control" type="email" name="user_email" value="<?php echo $user_email;?>">
    </div>
    
    <div class="form-group">
    <label for="">Password</label>
    <input class="form-control" type="password" name="user_password" value="<?php echo $user_password?>">
    </div>
    
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="update user">
    </div>
</form>