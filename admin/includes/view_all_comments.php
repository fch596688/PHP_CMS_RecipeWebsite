<table class="table table-hover table-bordered">
   <?php if($_SESSION['user_role'] === 'admin'){?>
    <thead>
        <tr>
            <th>Comment ID</th>
            <th>Comment Recipe ID</th>
            <th>Author ID</th>
            <th>Date</th>
            <th>Content</th>
            <th>Status</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
           $query = "SELECT c.comment_id, c.comment_recipe_id, c.comment_date, c.comment_status, c.comment_content, u.username FROM comments c, users u where c.comment_user_id = u.user_id";
            $selectAllComments = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectAllComments)){
                $comment_id = $row['comment_id'];
                $comment_recipe_id = $row['comment_recipe_id'];
                $comment_author = $row['username'];
                $comment_date = $row['comment_date'];
                $comment_status = $row['comment_status'];
                $comment_content = substr($row['comment_content'], 0, 100);
                echo"<tr>";
                echo"<td>$comment_id</td>";
                echo"<td><a href = '../view_recipe.php?recipe_id=$comment_recipe_id'>{$comment_recipe_id}</a></td>";
                echo"<td>{$comment_author}</td>";
                echo"<td>{$comment_date}</td>";
                echo"<td>{$comment_content}</td>";
                echo"<td>{$comment_status}</td>";
                echo"<td><a href='comments.php?approved={$comment_id}'>Approved</a></td>";
                echo"<td><a href='comments.php?unapproved={$comment_id}'>Unapproved</a></td>";
                echo"<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo"</tr>"; 
            }
        ?>
        <?php }else{ ?>
               <thead>
                    <tr>
                        <th>Comment ID</th>
                        <th>Comment Recipe ID</th>
                        <th>Author ID</th>
                        <th>Date</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
           <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT c.comment_id, c.comment_recipe_id, c.comment_date, c.comment_status, c.comment_content, u.username FROM comments c, users u where c.comment_user_id = u.user_id and u.user_id = $user_id";
            $selectAllComments = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($selectAllComments)){
                $comment_id = $row['comment_id'];
                $comment_recipe_id = $row['comment_recipe_id'];
                $comment_author = $row['username'];
                $comment_date = $row['comment_date'];
                $comment_status = $row['comment_status'];
                $comment_content = substr($row['comment_content'], 0, 100);
                echo"<tr>";
                echo"<td>$comment_id</td>";
                echo"<td><a href = '../view_recipe.php?recipe_id=$comment_recipe_id'>{$comment_recipe_id}</a></td>";
                echo"<td>{$comment_author}</td>";
                echo"<td>{$comment_date}</td>";
                echo"<td>{$comment_content}</td>";
                echo"<td>{$comment_status}</td>";
                echo"<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo"</tr>";
            }
        }
        ?>    
    </tbody>
</table>


<?php

if(isset($_GET['approved'])){
        $approved_comment_id = $_GET['approved'];
        $query = "UPDATE comments SET comment_status  = 'approved' WHERE comment_id = {$approved_comment_id}";
        $approved_query = mysqli_query($connection, $query);
        header("Location: comments.php");//refresh comments.php
    }

if(isset($_GET['unapproved'])){
        $unapproved_comment_id = $_GET['unapproved'];
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapproved_comment_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");//refresh comments.php
    }

if(isset($_GET['delete'])){
        $delete_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");//refresh comments.php
    }
?>