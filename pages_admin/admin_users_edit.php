<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta-->
<?php include_once '../helpers/help_admin_meta.php';?>

    <title>THERELABS ADMIN PAGE</title>

<!-- CSS Fonts-->
<?php include_once '../helpers/help_admin_css.php';?>

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once "../components_admin/cp_navbars_side.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once "../components_admin/cp_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">User management</h1>
<!--                     <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                User edit
                            </div>
                            </br>
                            <!-- /.panel-heading -->
                            <?php
                            if(isset($_GET["id"])){    
                                $id_users = $_GET["id"];

                                require_once("../connections/connection.php"); // We need the function!

                                        $link = new_db_connection(); // Create a new DB connection

                                        $stmt = mysqli_stmt_init($link); // create a prepared statement

                                        $query = "SELECT date_creation, username, email, active, ref_id_roles 
                                        FROM mp_users 
                                        WHERE id_users 
                                        LIKE ? "; // Define the query


                                        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                            mysqli_stmt_bind_param($stmt, "i", $id_users); // foi acrescentado na query (WHERE id_users LIKE ?) para ir buscar os que são iguais ao id_user

                                            if (mysqli_stmt_execute($stmt)) {
                                    
                                                mysqli_stmt_bind_result($stmt, $date_creation, $username, $email, $active, $user_role); // Bind variables by type to each parameter

                                                if (!mysqli_stmt_fetch($stmt)) { 
                                                    //echo "não há resultado da query";                                                                
                                                }
                                                // session_start(); tem de ser colocado no inicio do script depois do DOCTYPE senão dá erro                            
                                                $_SESSION["id"] = $id_users;

                                            }  else {
                                                // Acção de erro
                                                echo "Error:" . mysqli_stmt_error($stmt);
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link); // Errors related with the query
                                        }

                                        mysqli_stmt_close($stmt); // Close statement
                                        
                                        mysqli_close($link); // Close connection

                                        if($active == 1 ){    
                                            $check = "checked";
                                        } else {
                                            $check = "unchecked";
                                        }
                                        //var_dump($active);
                            }
                            ?>
                            <div class="panel-body">
                                            <form role="form" method="post" action="../scripts_admin/sc_users_update.php">
                                                <!-- <input type="hidden" name="id_users" value="<?= $id_users?>"> -->
                                                <div class="form-group">
                                                    <label>User id</label>
                                                    <p class="form-control-static"><?= $id_users?></p> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Criation date</label>
                                                    <p class="form-control-static"><?= $date_creation?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" name="username" value="<?= $username?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" value="<?= $email?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <div class="checkbox">
                                                        <label>
                                                        <input value="1" type="checkbox" name="active" <?= $check?>>Activo
                                                            
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Profile</label>
                                                    <select class="form-control" name="id_roles">
                                                <?php
                                                    require_once("../connections/connection.php"); // We need the function!

                                                            $link = new_db_connection(); // Create a new DB connection

                                                            $stmt = mysqli_stmt_init($link); // create a prepared statement

                                                            $query1 = "SELECT id_roles, roles_description FROM mp_roles ORDER BY roles_description"; // Define the query ORDER BY roles.id_roles DESC

                                                            mysqli_stmt_prepare($stmt, $query1);

                                                            mysqli_stmt_execute($stmt);

                                                            mysqli_stmt_bind_result($stmt, $id_roles, $roles_description); // Bind results

                                                            while (mysqli_stmt_fetch($stmt)){
                                                            
                                                                echo '<option value="'.$id_roles.'"';
                                                                if($user_role==$id_roles)
                                                                {
                                                                    echo " SELECTED ";
                                                                }
                                                                echo '>'.$id_roles.' - '.$roles_description.'</option>';
                                                            }
                                                            
                                                            mysqli_stmt_close($stmt); // Close statement
                                
                                                            mysqli_close($link); // Close connection

                                                ?>
                                                </select>
                                                </div>
                                                <button type="submit" class="btn btn-info">Submit changes
                                                </button>
                                            </form>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer-->
        <?php include_once '../components_admin/cp_footer.php';?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- JS-->       
<?php include_once '../helpers/help_admin_js.php';?>

</body>

</html>