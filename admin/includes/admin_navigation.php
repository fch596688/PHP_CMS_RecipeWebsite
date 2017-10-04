<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php">Recipe Go Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index.php">Home</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php if(isset($_SESSION['username'])){
                            echo $_SESSION['username'];
                            }?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="">
                <a href="./index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#recipe"><i class="fa fa-fw fa-arrows-v"></i> Recipe <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="recipe" class="collapse">
                    <li>
                        <a href="./recipe.php">View All Recipes</a>
                    </li>
                    <li>
                        <a href="recipe.php?source=add_recipe">New Recipe</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./category.php"><i class="fa fa-fw fa-table"></i> Category</a>
            </li>
            <li>
                <a href="comments.php"><i class="fa fa-fw fa-edit"></i> Comments</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-arrows-v"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="user" class="collapse">
                    <li>
                        <a href="./users.php">View All Users</a>
                    </li>
                    <li>
                        <a href="./users.php?source=add_user">New Users</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="profile.php"><i class="fa fa-fw fa-wrench"></i> Profile</a>
            </li>


        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>