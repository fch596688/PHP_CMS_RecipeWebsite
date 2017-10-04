<?php include "includes/admin_header.php"?>

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Recipe Go CMS!
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else {
                            $source = '';
                        }
                        if($_SESSION['user_role'] === 'admin'){
                            switch($source){
                                case 'add_user':
                                    include "includes/add_user.php";
                                    break;
                                case 'edit_user':
                                    include "includes/edit_user.php";
                                    break;
                                default:
                                    include "includes/view_all_users.php";
                                    break;
                            }
                        }else{
                            echo "<h3>Sorry, you are not an administrator!</h3>";
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
