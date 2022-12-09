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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <?php
                require_once("../connections/connection.php"); // We need the function!

                $link = new_db_connection(); // Create a new DB connection

                $stmt = mysqli_stmt_init($link); // create a prepared statement

                $query = "SELECT mp_users_id_users, mp_article_id_articles, 
                COUNT(*)likes_total FROM mp_users_has_mp_article";

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    
                    if(mysqli_stmt_execute($stmt)) { // Execute the prepared statement

                    mysqli_stmt_bind_result($stmt, $mp_users_id_users, $mp_article_id_articles, $likes_total); // Bind results

                    mysqli_stmt_fetch($stmt);// Fetch values
                        
                        //echo '<p>total likes: '.$likes_total.'</p>';
                    }  else {
                        // Acção de erro
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "Error: " . mysqli_error($link); // Errors related with the query
                }

                $query = "SELECT COUNT( id_comments )comments_total FROM mp_comments";

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    
                    if(mysqli_stmt_execute($stmt)) { // Execute the prepared statement

                    mysqli_stmt_bind_result($stmt, $comments_total); // Bind results

                    mysqli_stmt_fetch($stmt);// Fetch values
                        
                        //echo '<p>total likes: '.$comments_total.'</p>';
                    }  else {
                        // Acção de erro
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "Error: " . mysqli_error($link); // Errors related with the query
                }

                mysqli_stmt_close($stmt); // Close statement
                mysqli_close($link); // Close connection            
            ?>


                <!-- Content Row -->
                <div class="row">
                    <!-- numero de comentarios  -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">

                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            total users comments
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$comments_total?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- numero de likes -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            Total users Likes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$likes_total?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- JS-->       
<?php include_once '../helpers/help_admin_js.php';?>

</body>

</html>
