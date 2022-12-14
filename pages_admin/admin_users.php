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
                            registered users
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Creation date</th>
                                            <th>Profile</th>
                                            <th>Operations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                                require_once("../connections/connection.php"); // We need the function!

                                                        $link = new_db_connection(); // Create a new DB connection

                                                        $stmt = mysqli_stmt_init($link); // create a prepared statement

                                                        $query = "SELECT id_users, username, email, date_creation, ref_id_roles, active 
                                                        FROM mp_users"; // Define the query
                                                        
                                                        // falta criar o campo active
                                                        // CREATE TABLE users (active BOOLEAN NOT NULL default 1); isto podera criar uma tabela e vez de a alterar 
                                                        // ALTER TABLE users ADD active BOOLEAN NOT NULL default 1;
                                                        // commit;
                                                        // $active = true;

                                                        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                                            if (mysqli_stmt_execute($stmt)) {

                                                                mysqli_stmt_bind_result($stmt, $id_users, $username, $email, $date_creation, $id_roles, $active); // Bind variables by type to each parameter

                                                                while (mysqli_stmt_fetch($stmt)) { 
                                                                    //var_dump($active);
                                                                    echo '<tr>';
                                                                    echo '<td>'.$id_users.'</td>';
                                                                    if ($active == true){
                                                                        echo '<td></i>'.htmlspecialchars($username).'</td>';
                                                                    } else {
                                                                        echo '<td><i class="fa fa-ban fa-fw"></i>'.htmlspecialchars($username).'</td>';
                                                                    }
                                                                    echo '<td>'.htmlspecialchars($email).'</td>';
                                                                    echo '<td>'.$date_creation.'</td>';
                                                                    echo '<td>'.$id_roles.'</td>';                                                                
                                                                    echo '<td><a href="admin_users_edit.php?id='.$id_users.'"><i class="fa fa-edit fa-fw"></a></td>';
                                                                    echo '</tr>';                                                                
                                                                }
                                                            }  else {
                                                                // Ac????o de erro
                                                                echo "Error:" . mysqli_stmt_error($stmt);
                                                            }
                                                        } else {
                                                            echo "Error: " . mysqli_error($link); // Errors related with the query
                                                        }
                                                        mysqli_stmt_close($stmt); // Close statement
                                                        mysqli_close($link); // Close connection

                                                ?>
                                        </tbody>
                                    </table>
                                </div>
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

