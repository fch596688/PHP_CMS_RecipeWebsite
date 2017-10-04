<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>User Email</th>
            <th>User Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM users";
        $selectAllUsers = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectAllUsers)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            
            
            echo"<tr>";
            echo"<td>{$user_id}</td>";
            echo"<td>{$username}</td>";
            echo"<td>{$user_firstname}</td>";
            echo"<td>{$user_lastname}</td>";
            echo"<td>$user_email</td>";
            echo"<td>{$user_role}</td>";
            echo"<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo"<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo"<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo"<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo"</tr>";
        }
        ?>    
    </tbody>
</table>


<?php

if(isset($_GET['change_to_admin'])){
        $admin_user_id = $_GET['change_to_admin'];
        $set_admin_query = "UPDATE users SET user_role  = 'admin' WHERE user_id = {$admin_user_id}";
        $admin_query = mysqli_query($connection, $set_admin_query);
        header("Location: users.php");//refresh users.php
    }

if(isset($_GET['change_to_sub'])){
        $sub_user_id = $_GET['change_to_sub'];
        $set_sub_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$sub_user_id}";
        $sub_query = mysqli_query($connection, $set_sub_query);
        header("Location: users.php");//refresh users.php
    }

if(isset($_GET['delete'])){
        $delete_user_id = $_GET['delete'];
        $delete_user_query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
        $delete_query = mysqli_query($connection, $delete_user_query);
        header("Location: users.php");//refresh users.php
    }
?>