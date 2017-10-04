<?php 
if(isset($_POST['create_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    //$user_password = password_hash($user_password, PASSWORD_BCRYRT, array('cost' => 10));
    
    if(!empty($user_firstname) && !empty($user_lastname) && !empty($user_role) && !empty($username) && !empty($user_email) && !empty($user_password)){
        
    $create_user_query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}')";
    
    $query_create_user = mysqli_query($connection, $create_user_query);

    queryConfirm($query_create_user);
    
    header("Location: users.php");
        
    }else{
        echo "all field should be filled!";
    }

}
    

?>


<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
    <label for="">Firstname</label>
    <input class="form-control" type="text" name="user_firstname">
    </div>
    
    <div class="form-group">
    <label for="">Lastname</label>
    <input class="form-control" type="text" name="user_lastname">
    </div>
    
    <div class="form-group">
    <label for="">User Role</label>
    <select class="form-control" name="user_role">
        <option value="subscriber">Select Opitions</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>
    </div>
    
    <div class="form-group">
    <label for="">Username</label>
    <input class="form-control" type="text" name="username">
    </div>
    
    <div class="form-group">
    <label for="">Email</label>
    <input class="form-control" type="email" name="user_email">
    </div>
    
    <div class="form-group">
    <label for="">Password</label>
    <input class="form-control" type="password" name="user_password">
    </div>
    
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="new user">
    </div>
</form>